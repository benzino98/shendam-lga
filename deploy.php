<?php
/**
 * Deployment script for cPanel when SSH is disabled.
 *
 * This script handles:
 * 1. Extracting deployment archives uploaded by GitHub Actions
 * 2. Running Laravel Artisan commands (migrate, cache, etc.)
 *
 * IMPORTANT SECURITY NOTES
 * ------------------------
 * 1. Protect this script with a strong secret token.
 * 2. Do NOT leave it publicly accessible long‑term; delete or rename it
 *    once everything is stable, or restrict access via .htaccess / IP allowlist.
 * 3. Never commit your real token to GitHub – set it via the environment.
 */

// ==== CONFIGURATION =========================================================

// 1) Secret token – MUST be configured before use.
//    Best option: set DEPLOY_TOKEN in your .env on the server, e.g.:
//      DEPLOY_TOKEN="very-long-random-string"
//    Then this script will read it via getenv('DEPLOY_TOKEN').
//
//    As a fallback (not recommended), you can hard‑code a token here,
//    but DO NOT commit that value to GitHub.
$secretToken = getenv('DEPLOY_TOKEN') ?: 'CHANGE_ME_DEPLOY_TOKEN';

// 2) PHP binary – usually just "php" on cPanel. If your host requires a
//    specific path, set DEPLOY_PHP_BIN in .env or change this default.
$phpBinary = getenv('DEPLOY_PHP_BIN') ?: 'php';

// 3) Paths
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

// ==== HELPER TO RUN COMMANDS ===============================================

header('Content-Type: text/plain; charset=utf-8');

// In production we keep Laravel core in /home/shendam/laravel
// and only expose public_html. From this script (placed in public_html),
// the project root is one level up in a folder named "laravel".
// Adjust this if you use a different folder name.
$projectRoot = realpath(__DIR__ . '/../laravel') ?: __DIR__;

/**
 * Run a shell command and stream the output.
 *
 * @param string $title  Human‑readable description of the step.
 * @param string $command Actual shell command to run.
 * @param string $cwd    Working directory.
 */
function runCommand(string $title, string $command, string $cwd): void
{
    echo "============================================================\n";
    echo $title . "\n";
    echo "------------------------------------------------------------\n";
    echo "Command: {$command}\n\n";

    $output = [];
    $exitCode = 0;

    // Change directory for the command.
    $previousCwd = getcwd();
    if ($cwd && is_dir($cwd)) {
        chdir($cwd);
    }

    exec($command . ' 2>&1', $output, $exitCode);

    // Restore previous working directory.
    if ($previousCwd) {
        chdir($previousCwd);
    }

    echo implode("\n", $output) . "\n\n";
    echo "Exit code: {$exitCode}\n\n";

    if ($exitCode !== 0) {
        echo "!!! ERROR: Command failed. Stopping deployment.\n";
        exit($exitCode);
    }
}

echo "Laravel deployment helper\n";
echo "Started at: " . date('Y-m-d H:i:s') . "\n";
echo "Laravel root: {$laravelRoot}\n";
echo "Public HTML: {$publicHtml}\n\n";

// ==== EXTRACT ARCHIVES (if action is 'extract' or 'deploy') ===============

if ($action === 'extract' || $action === 'deploy') {
    echo "============================================================\n";
    echo "STEP 1: Extracting deployment archives\n";
    echo "============================================================\n\n";
    
    // Extract Laravel core
    if (file_exists($coreArchive)) {
        echo "Extracting Laravel core archive...\n";
        if (!is_dir($laravelRoot)) {
            mkdir($laravelRoot, 0755, true);
        }
        
        $cmd = "cd " . escapeshellarg($laravelRoot) . " && tar -xzf " . escapeshellarg($coreArchive) . " 2>&1";
        $output = [];
        $exitCode = 0;
        exec($cmd, $output, $exitCode);
        
        if ($exitCode === 0) {
            echo "✓ Laravel core extracted to: {$laravelRoot}\n";
            echo implode("\n", $output) . "\n\n";
            
            // Clean up archive
            unlink($coreArchive);
            echo "✓ Cleaned up core archive\n\n";
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
            echo implode("\n", $output) . "\n\n";
            
            // Clean up archive
            unlink($publicArchive);
            echo "✓ Cleaned up public archive\n\n";
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

// ==== RUN ARTISAN COMMANDS ==================================================

if ($action === 'deploy' || $action === 'commands') {
    $projectRoot = $laravelRoot;
    
    if (!is_dir($projectRoot) || !file_exists($projectRoot . '/artisan')) {
        echo "!!! ERROR: Laravel root not found at: {$projectRoot}\n";
        echo "   Please ensure the core archive has been extracted first.\n";
        exit(1);
    }

    /**
     * Ensure APP_KEY is set in the production .env.
     *
     * We only call `php artisan key:generate` if APP_KEY is missing or empty
     * to avoid regenerating the key on every deploy.
     */
    $envPath = $projectRoot . '/.env';
    if (is_readable($envPath)) {
        $envContents = file_get_contents($envPath);
        if ($envContents !== false) {
            // Find the APP_KEY line if it exists
            if (preg_match('/^APP_KEY\s*=\s*(.*)$/m', $envContents, $matches)) {
                $rawValue = trim($matches[1], " \t\n\r\"'");
                // Treat empty, "null", or "NULL" as missing
                if ($rawValue === '' || strtolower($rawValue) === 'null') {
                    runCommand('Generate application key', "{$phpBinary} artisan key:generate", $projectRoot);
                }
            } else {
                // No APP_KEY line at all – generate one
                runCommand('Generate application key', "{$phpBinary} artisan key:generate", $projectRoot);
            }
        }
    } else {
        echo "!!! WARNING: .env file not found at {$envPath}. Cannot auto-generate APP_KEY.\n";
        echo "    Please create a production .env file on the server (with DB settings etc.)\n";
        echo "    and leave APP_KEY empty so this script can run php artisan key:generate.\n\n";
    }
    
    // 1) Run database migrations
    runCommand('Run database migrations', "{$phpBinary} artisan migrate --force", $projectRoot);

// 2) Clear existing caches
runCommand('Clear application cache', "{$phpBinary} artisan cache:clear", $projectRoot);
runCommand('Clear config cache', "{$phpBinary} artisan config:clear", $projectRoot);
runCommand('Clear route cache', "{$phpBinary} artisan route:clear", $projectRoot);
runCommand('Clear view cache', "{$phpBinary} artisan view:clear", $projectRoot);

// 3) Rebuild caches for performance
runCommand('Cache configuration', "{$phpBinary} artisan config:cache", $projectRoot);
runCommand('Cache routes', "{$phpBinary} artisan route:cache", $projectRoot);
runCommand('Cache views', "{$phpBinary} artisan view:cache", $projectRoot);
runCommand('Cache events', "{$phpBinary} artisan event:cache", $projectRoot);

    echo "============================================================\n";
    echo "Deployment commands completed successfully.\n";
    echo "Finished at: " . date('Y-m-d H:i:s') . "\n";
    echo "============================================================\n";
} else {
    echo "============================================================\n";
    echo "Extraction completed.\n";
    echo "To run artisan commands, visit: ?token=YOUR_TOKEN&action=commands\n";
    echo "Or use: ?token=YOUR_TOKEN&action=deploy (extract + commands)\n";
    echo "Finished at: " . date('Y-m-d H:i:s') . "\n";
    echo "============================================================\n";
}

