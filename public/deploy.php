<?php
/**
 * Deployment script for cPanel when SSH is disabled.
 *
 * This script handles the complete deployment process:
 * 1. Extracting deployment archives uploaded by GitHub Actions
 * 2. Setting up .env file from env.production.example if needed
 * 3. Creating necessary directories with proper permissions
 * 4. Creating storage symlink
 * 5. Running Laravel Artisan commands (migrate, cache, etc.)
 *
 * Usage:
 *   https://your-domain/deploy.php?token=YOUR_TOKEN&action=deploy
 *
 * Actions:
 *   - extract: Only extract archives
 *   - commands: Only run artisan commands (assumes archives already extracted)
 *   - deploy: Extract archives AND run artisan commands (full deployment)
 */

// ==== CONFIGURATION =========================================================

// Secret token – MUST be configured before use (via DEPLOY_TOKEN in the
// server environment, not committed to GitHub).
$secretToken = getenv('DEPLOY_TOKEN') ?: 'CHANGE_ME_DEPLOY_TOKEN';

// PHP binary – usually just "php" on cPanel.
$phpBinary = getenv('DEPLOY_PHP_BIN') ?: 'php';

// Paths - cPanel structure
$laravelRoot = realpath(__DIR__ . '/../laravel') ?: __DIR__ . '/../laravel';
$publicHtml = __DIR__;
$coreArchive = $laravelRoot . '/laravel-core.tar.gz';
$publicArchive = $publicHtml . '/public-assets.tar.gz';

// ==== SECURITY CHECK ========================================================

$providedToken = $_GET['token'] ?? $_SERVER['HTTP_X_DEPLOY_TOKEN'] ?? '';
$action = $_GET['action'] ?? 'deploy';

if (!$secretToken || $secretToken === 'CHANGE_ME_DEPLOY_TOKEN') {
    http_response_code(500);
    echo "Deployment script not configured: please set DEPLOY_TOKEN in your environment or update \$secretToken in deploy.php.\n";
    exit(1);
}

if (!hash_equals($secretToken, (string) $providedToken)) {
    http_response_code(403);
    echo "Forbidden: invalid deployment token.\n";
    exit(1);
}

// ==== HELPER FUNCTIONS ======================================================

header('Content-Type: text/plain; charset=utf-8');

/**
 * Run a command and handle errors
 */
function runCommand(string $title, string $command, string $cwd, bool $allowFailure = false): bool
{
    echo "============================================================\n";
    echo $title . "\n";
    echo "------------------------------------------------------------\n";
    echo "Command: {$command}\n\n";

    $output = [];
    $exitCode = 0;

    $previousCwd = getcwd();
    if ($cwd && is_dir($cwd)) {
        chdir($cwd);
    }

    exec($command . ' 2>&1', $output, $exitCode);

    if ($previousCwd) {
        chdir($previousCwd);
    }

    echo implode("\n", $output) . "\n\n";
    echo "Exit code: {$exitCode}\n\n";

    if ($exitCode !== 0) {
        if ($allowFailure) {
            echo "⚠ WARNING: Command failed but continuing...\n\n";
            return false;
        } else {
            echo "!!! ERROR: Command failed. Stopping deployment.\n";
            exit($exitCode);
        }
    }

    return true;
}

/**
 * Run an artisan command with Redis fallback for cPanel compatibility
 */
function runArtisanWithRedisFallback(string $title, string $artisanCommand, string $phpBinary, string $cwd, bool $allowFailure = false): bool
{
    $command = "{$phpBinary} artisan {$artisanCommand}";

    // If Redis extension isn't available and this command is likely to touch cache/queue,
    // run with safe fallbacks so the command can complete.
    $redisExtensionMissing = !extension_loaded('redis') && !class_exists('Redis');
    $needsFallback = $redisExtensionMissing && preg_match('/^(cache:clear|cache:forget|queue:.*)$/', $artisanCommand);

    if ($needsFallback) {
        echo "------------------------------------------------------------\n";
        echo "⚠ Redis PHP extension not found. Running with safe fallbacks:\n";
        echo "  CACHE_STORE=file, QUEUE_CONNECTION=sync, SESSION_DRIVER=file\n";
        echo "  (Fix permanently by updating your server .env to not use redis.)\n";
        echo "------------------------------------------------------------\n\n";

        $command = "CACHE_STORE=file QUEUE_CONNECTION=sync SESSION_DRIVER=file {$command}";
    }

    return runCommand($title, $command, $cwd, $allowFailure);
}

/**
 * Ensure directory exists with proper permissions
 */
function ensureDirectory(string $path, int $permissions = 0755): bool
{
    if (!is_dir($path)) {
        if (!mkdir($path, $permissions, true)) {
            echo "!!! ERROR: Failed to create directory: {$path}\n";
            return false;
        }
        echo "✓ Created directory: {$path}\n";
    } else {
        echo "✓ Directory exists: {$path}\n";
    }

    // Try to set permissions (may fail on some hosts, but that's okay)
    @chmod($path, $permissions);
    return true;
}

/**
 * Copy .env file from template if it doesn't exist
 */
function setupEnvFile(string $laravelRoot): bool
{
    $envPath = $laravelRoot . '/.env';
    $envExamplePath = $laravelRoot . '/env.production.example';

    // If .env already exists, check if APP_KEY is set
    if (file_exists($envPath)) {
        $envContents = file_get_contents($envPath);
        if ($envContents !== false) {
            // Check if APP_KEY is empty or null
            if (preg_match('/^APP_KEY\s*=\s*(.*)$/m', $envContents, $matches)) {
                $rawValue = trim($matches[1], " \t\n\r\"'");
                if ($rawValue === '' || strtolower($rawValue) === 'null') {
                    echo "⚠ .env exists but APP_KEY is empty. Will generate after setup.\n";
                } else {
                    echo "✓ .env file exists with APP_KEY set.\n";
                    return true;
                }
            } else {
                echo "⚠ .env exists but APP_KEY not found. Will generate after setup.\n";
            }
        }
        return true; // .env exists, don't overwrite
    }

    // .env doesn't exist, copy from template
    if (!file_exists($envExamplePath)) {
        echo "!!! ERROR: env.production.example not found at: {$envExamplePath}\n";
        echo "   Cannot create .env file. Please create it manually.\n";
        return false;
    }

    if (!copy($envExamplePath, $envPath)) {
        echo "!!! ERROR: Failed to copy env.production.example to .env\n";
        return false;
    }

    echo "✓ Created .env file from env.production.example\n";
    echo "⚠ IMPORTANT: Please review and update .env with your production settings!\n";
    return true;
}

// ==== MAIN DEPLOYMENT PROCESS ==============================================

echo "============================================================\n";
echo "Laravel Deployment Script\n";
echo "============================================================\n";
echo "Started at: " . date('Y-m-d H:i:s') . "\n";
echo "Laravel root: {$laravelRoot}\n";
echo "Public HTML: {$publicHtml}\n";
echo "Action: {$action}\n\n";

// ==== STEP 1: EXTRACT ARCHIVES =============================================

if ($action === 'extract' || $action === 'deploy') {
    echo "============================================================\n";
    echo "STEP 1: Extracting deployment archives\n";
    echo "============================================================\n\n";

    // Extract Laravel core
    if (file_exists($coreArchive)) {
        echo "Extracting Laravel core archive...\n";
        
        // Ensure laravel directory exists
        if (!is_dir($laravelRoot)) {
            if (!mkdir($laravelRoot, 0755, true)) {
                echo "!!! ERROR: Failed to create Laravel root directory: {$laravelRoot}\n";
                exit(1);
            }
            echo "✓ Created Laravel root directory: {$laravelRoot}\n";
        }

        $cmd = "cd " . escapeshellarg($laravelRoot) . " && tar -xzf " . escapeshellarg($coreArchive) . " 2>&1";
        $output = [];
        $exitCode = 0;
        exec($cmd, $output, $exitCode);

        if ($exitCode === 0) {
            echo "✓ Laravel core extracted to: {$laravelRoot}\n";
            if (!empty($output)) {
                echo implode("\n", $output) . "\n";
            }
            
            // Clean up archive
            if (unlink($coreArchive)) {
                echo "✓ Cleaned up core archive\n\n";
            }
        } else {
            echo "!!! ERROR: Failed to extract core archive\n";
            echo implode("\n", $output) . "\n\n";
            exit(1);
        }
    } else {
        echo "⚠ Core archive not found: {$coreArchive}\n";
        echo "  (This is normal if archives haven't been uploaded yet)\n\n";
    }

    // Extract public assets
    if (file_exists($publicArchive)) {
        echo "Extracting public assets archive...\n";
        $cmd = "cd " . escapeshellarg($publicHtml) . " && tar -xzf " . escapeshellarg($publicArchive) . " 2>&1";
        $output = [];
        $exitCode = 0;
        exec($cmd, $output, $exitCode);

        if ($exitCode === 0) {
            echo "✓ Public assets extracted to: {$publicHtml}\n";
            if (!empty($output)) {
                echo implode("\n", $output) . "\n";
            }
            
            // Clean up archive
            if (unlink($publicArchive)) {
                echo "✓ Cleaned up public archive\n\n";
            }
        } else {
            echo "!!! ERROR: Failed to extract public archive\n";
            echo implode("\n", $output) . "\n\n";
            exit(1);
        }
    } else {
        echo "⚠ Public archive not found: {$publicArchive}\n";
        echo "  (This is normal if archives haven't been uploaded yet)\n\n";
    }
}

// ==== STEP 2: SETUP ENVIRONMENT =============================================

if ($action === 'deploy' || $action === 'commands') {
    if (!is_dir($laravelRoot) || !file_exists($laravelRoot . '/artisan')) {
        echo "!!! ERROR: Laravel root not found at: {$laravelRoot}\n";
        echo "   Please ensure the core archive has been extracted first.\n";
        echo "   Run with action=extract first, or use action=deploy.\n";
        exit(1);
    }

    echo "============================================================\n";
    echo "STEP 2: Setting up environment\n";
    echo "============================================================\n\n";

    // Setup .env file
    if (!setupEnvFile($laravelRoot)) {
        echo "!!! ERROR: Failed to setup .env file. Deployment stopped.\n";
        exit(1);
    }

    // Create necessary directories with proper permissions
    echo "\nCreating necessary directories...\n";
    $directories = [
        $laravelRoot . '/storage/app/public',
        $laravelRoot . '/storage/framework/cache/data',
        $laravelRoot . '/storage/framework/sessions',
        $laravelRoot . '/storage/framework/views',
        $laravelRoot . '/storage/framework/testing',
        $laravelRoot . '/storage/logs',
        $laravelRoot . '/bootstrap/cache',
    ];

    foreach ($directories as $dir) {
        ensureDirectory($dir, 0755);
    }

    echo "\n✓ Directory structure ready\n\n";
}

// ==== STEP 3: RUN ARTISAN COMMANDS =========================================

if ($action === 'deploy' || $action === 'commands') {
    echo "============================================================\n";
    echo "STEP 3: Running Laravel Artisan commands\n";
    echo "============================================================\n\n";

    // Generate APP_KEY if needed
    $envPath = $laravelRoot . '/.env';
    if (is_readable($envPath)) {
        $envContents = file_get_contents($envPath);
        if ($envContents !== false) {
            $needsKey = false;
            if (preg_match('/^APP_KEY\s*=\s*(.*)$/m', $envContents, $matches)) {
                $rawValue = trim($matches[1], " \t\n\r\"'");
                if ($rawValue === '' || strtolower($rawValue) === 'null') {
                    $needsKey = true;
                }
            } else {
                $needsKey = true;
            }

            if ($needsKey) {
                runCommand('Generate application key', "{$phpBinary} artisan key:generate --force", $laravelRoot);
            }
        }
    }

    // Run migrations
    runCommand('Run database migrations', "{$phpBinary} artisan migrate --force", $laravelRoot);

    // Create storage symlink
    $storageLink = $publicHtml . '/storage';
    if (!file_exists($storageLink) || !is_link($storageLink)) {
        // Remove if exists but not a symlink
        if (file_exists($storageLink)) {
            @unlink($storageLink);
        }
        runCommand('Create storage symlink', "{$phpBinary} artisan storage:link", $laravelRoot, true);
    } else {
        echo "✓ Storage symlink already exists\n\n";
    }

    // Clear caches
    runArtisanWithRedisFallback('Clear application cache', 'cache:clear', $phpBinary, $laravelRoot, true);
    runCommand('Clear config cache', "{$phpBinary} artisan config:clear", $laravelRoot, true);
    runCommand('Clear route cache', "{$phpBinary} artisan route:clear", $laravelRoot, true);
    runCommand('Clear view cache', "{$phpBinary} artisan view:clear", $laravelRoot, true);
    runCommand('Clear event cache', "{$phpBinary} artisan event:clear", $laravelRoot, true);

    // Optimize for production
    runCommand('Cache configuration', "{$phpBinary} artisan config:cache", $laravelRoot);
    runCommand('Cache routes', "{$phpBinary} artisan route:cache", $laravelRoot);
    runCommand('Cache views', "{$phpBinary} artisan view:cache", $laravelRoot);
    runCommand('Cache events', "{$phpBinary} artisan event:cache", $laravelRoot);

    // Optimize autoloader
    runCommand('Optimize autoloader', "{$phpBinary} composer dump-autoload --optimize --classmap-authoritative", $laravelRoot, true);

    echo "============================================================\n";
    echo "✓ Deployment completed successfully!\n";
    echo "Finished at: " . date('Y-m-d H:i:s') . "\n";
    echo "============================================================\n";
} else {
    echo "============================================================\n";
    echo "✓ Extraction completed.\n";
    echo "\nNext steps:\n";
    echo "  - Run artisan commands: ?token=YOUR_TOKEN&action=commands\n";
    echo "  - Full deployment: ?token=YOUR_TOKEN&action=deploy\n";
    echo "\nFinished at: " . date('Y-m-d H:i:s') . "\n";
    echo "============================================================\n";
}
