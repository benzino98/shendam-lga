<?php
/**
 * Lightweight deployment helper for cPanel when SSH is disabled.
 *
 * This script is meant to be run AFTER your GitHub Actions workflow
 * has uploaded the latest code to the server via FTP/SFTP.
 *
 * It simply runs the key Laravel Artisan commands on the server:
 *  - php artisan migrate --force
 *  - php artisan config:cache
 *  - php artisan route:cache
 *  - php artisan view:cache
 *  - php artisan event:cache
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

// ==== SECURITY CHECK ========================================================

$providedToken = $_GET['token'] ?? $_SERVER['HTTP_X_DEPLOY_TOKEN'] ?? '';

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
echo "Project root: {$projectRoot}\n\n";

// Optional: uncomment this if you ever need to generate the app key on the server
// (ONLY run once, when .env is correctly configured and APP_KEY is empty).
// runCommand('Generate application key', "{$phpBinary} artisan key:generate", $projectRoot);

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

