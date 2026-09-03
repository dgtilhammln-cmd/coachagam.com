<?php
/**
 * ============================================================
 * SETUP SCRIPT UNTUK DEPLOY CPANEL TANPA SSH
 * Coach Agam — coachagam.com
 * ============================================================
 *
 * CARA PAKAI:
 * 1. Upload file ini ke folder PUBLIC (public_html/)
 * 2. Akses via browser: https://domain.com/setup_deploy.php?token=GANTI_TOKEN_INI
 * 3. Setelah selesai, HAPUS file ini dari server!
 *
 * KEAMANAN: Ganti token di bawah sebelum upload!
 */

define('SECRET_TOKEN', 'coachagam-deploy-2025-abc123xyz');  // GANTI INI!

// ── Autentikasi ──────────────────────────────────────────────
if (($_GET['token'] ?? '') !== SECRET_TOKEN) {
    http_response_code(403);
    die('<h2 style="color:red; font-family:monospace">403 - Token tidak valid.</h2>');
}

$action = $_GET['action'] ?? 'menu';

// ── Path Detection ───────────────────────────────────────────
// Script ini ada di public_html/, Laravel project ada 1 level di atas
$publicPath  = __DIR__;
$laravelPath = '/home/coachaga/laravel';

// Cek apakah struktur folder benar
if (!file_exists($laravelPath . '/artisan')) {
    // Coba alternatif: project di folder lain
    $alternatives = [
        dirname($publicPath) . '/laravel',
        dirname($publicPath) . '/coachagam',
        dirname($publicPath) . '/app',
    ];
    foreach ($alternatives as $alt) {
        if (file_exists($alt . '/artisan')) {
            $laravelPath = $alt;
            break;
        }
    }
}

$artisanPath = $laravelPath . '/artisan';
$phpBin = PHP_BINARY ?: 'php';

function runArtisan($laravelPath, $phpBin, $command) {
    $artisan = $laravelPath . '/artisan';
    $cmd = escapeshellcmd($phpBin) . ' ' . escapeshellarg($artisan) . ' ' . $command . ' 2>&1';
    $output = shell_exec($cmd);
    return $output ?: '(no output)';
}

function setPermission($path, $mode) {
    if (!file_exists($path)) return "PATH NOT FOUND: $path";
    $result = chmod($path, $mode);
    // Recursive for directories
    if (is_dir($path)) {
        $iter = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );
        foreach ($iter as $item) {
            chmod($item->getRealPath(), $mode);
        }
    }
    return $result ? "OK ($path → " . decoct($mode) . ")" : "FAILED ($path)";
}

// ── HTML Output Helper ───────────────────────────────────────
function html($title, $content) {
    $token = htmlspecialchars($_GET['token']);
    echo <<<HTML
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Deploy Setup — Coach Agam</title>
    <style>
        body { font-family: 'Courier New', monospace; background:#0a0a0a; color:#e0e0e0; margin:0; padding:20px; }
        h1 { color:#ffffff; border-bottom:2px solid #333; padding-bottom:10px; }
        h2 { color:#aaa; font-size:14px; text-transform:uppercase; letter-spacing:2px; }
        pre { background:#111; border:1px solid #333; padding:16px; overflow-x:auto; color:#4CAF50; font-size:12px; white-space:pre-wrap; }
        pre.error { color:#EF5350; }
        .btn { display:inline-block; margin:8px 4px; padding:10px 20px; background:#222; color:#fff; text-decoration:none; border:1px solid #444; font-family:monospace; font-size:12px; cursor:pointer; }
        .btn:hover { background:#333; border-color:#666; }
        .btn.danger { border-color:#EF5350; color:#EF5350; }
        .btn.success { border-color:#4CAF50; color:#4CAF50; }
        .menu { display:flex; flex-wrap:wrap; gap:8px; margin:20px 0; }
        .info { background:#1a1a1a; border:1px solid #333; padding:12px 16px; margin:10px 0; font-size:12px; color:#888; }
        .warning { background:#1a0a00; border:1px solid #ff6600; padding:12px 16px; margin:10px 0; color:#ff9944; font-size:12px; }
    </style>
</head>
<body>
<h1>Coach Agam — Deploy Setup Panel</h1>
<div class="info">
    Laravel Path: <strong>{$GLOBALS['laravelPath']}</strong> | 
    PHP: <strong><?php echo PHP_VERSION; ?></strong> |
    Token: <strong>VALID</strong>
</div>
$content
<hr style="border-color:#333; margin:30px 0">
<div class="warning">
    ⚠️ <strong>PENTING:</strong> Setelah semua langkah selesai, HAPUS file ini dari server!<br>
    Hapus: <code>public_html/setup_deploy.php</code>
</div>
<p><a href="?token={$token}" class="btn">← Kembali ke Menu</a></p>
</body>
</html>
HTML;
}

$token = htmlspecialchars($_GET['token']);

// ── MENU UTAMA ───────────────────────────────────────────────
if ($action === 'menu') {
    $artisanExists = file_exists($laravelPath . '/artisan') ? '✓ Ditemukan' : '✗ TIDAK DITEMUKAN — Upload project Laravel!';
    $envExists     = file_exists($laravelPath . '/.env') ? '✓ Ada' : '✗ BELUM ADA — Upload .env!';
    $vendorExists  = file_exists($laravelPath . '/vendor/autoload.php') ? '✓ Ada' : '✗ BELUM ADA — Upload vendor/!';
    $storageWritable = is_writable($laravelPath . '/storage') ? '✓ Writable' : '✗ Tidak writable!';

    $content = <<<HTML
<h2>Status Sistem</h2>
<pre>
artisan   : $artisanExists
.env      : $envExists
vendor/   : $vendorExists
storage/  : $storageWritable
</pre>

<h2>Langkah Deploy (Jalankan Berurutan)</h2>
<div class="menu">
    <a href="?token={$token}&action=fix_permissions" class="btn success">1. Set Permissions (775)</a>
    <a href="?token={$token}&action=migrate" class="btn">2. Jalankan Migration</a>
    <a href="?token={$token}&action=storage_link" class="btn">3. Storage Link</a>
    <a href="?token={$token}&action=cache_clear" class="btn">4. Clear Cache</a>
    <a href="?token={$token}&action=cache_build" class="btn">5. Build Cache (Optimize)</a>
    <a href="?token={$token}&action=check_env" class="btn">6. Cek .env Config</a>
    <a href="?token={$token}&action=test_db" class="btn">7. Test Koneksi DB</a>
    <a href="?token={$token}&action=phpinfo" class="btn">Info PHP</a>
</div>
HTML;

    html('Menu', $content);
    exit;
}

// ── ACTION: FIX PERMISSIONS ──────────────────────────────────
if ($action === 'fix_permissions') {
    $results = [];
    $results[] = setPermission($laravelPath . '/storage', 0775);
    $results[] = setPermission($laravelPath . '/bootstrap/cache', 0775);

    $out = implode("\n", $results);
    $content = "<h2>Set Permissions</h2><pre>$out</pre>";
    html('Permissions', $content);
    exit;
}

// ── ACTION: MIGRATE ──────────────────────────────────────────
if ($action === 'migrate') {
    $out = runArtisan($laravelPath, $phpBin, 'migrate --force');
    $class = (strpos($out, 'error') !== false || strpos($out, 'Error') !== false) ? 'error' : '';
    $content = "<h2>php artisan migrate --force</h2><pre class='$class'>" . htmlspecialchars($out) . "</pre>";
    html('Migrate', $content);
    exit;
}

// ── ACTION: STORAGE LINK ─────────────────────────────────────
if ($action === 'storage_link') {
    // Buat symlink manual karena artisan storage:link tidak selalu bisa di shared hosting
    $target = $laravelPath . '/storage/app/public';
    $link   = $publicPath . '/storage';

    if (is_link($link)) {
        $result = "Symlink sudah ada: $link → " . readlink($link);
    } elseif (file_exists($link)) {
        $result = "WARNING: $link sudah ada tapi bukan symlink. Hapus manual lalu coba lagi.";
    } else {
        $success = symlink($target, $link);
        $result  = $success ? "Symlink berhasil dibuat:\n  $link\n  → $target" : "GAGAL membuat symlink. Coba via artisan:\n" . runArtisan($laravelPath, $phpBin, 'storage:link');
    }

    $class = (strpos($result, 'GAGAL') !== false || strpos($result, 'WARNING') !== false) ? 'error' : '';
    $content = "<h2>Storage Link</h2><pre class='$class'>" . htmlspecialchars($result) . "</pre>";
    html('Storage Link', $content);
    exit;
}

// ── ACTION: CLEAR CACHE ──────────────────────────────────────
if ($action === 'cache_clear') {
    $out  = "=== config:clear ===\n" . runArtisan($laravelPath, $phpBin, 'config:clear');
    $out .= "\n=== cache:clear ===\n" . runArtisan($laravelPath, $phpBin, 'cache:clear');
    $out .= "\n=== view:clear ===\n" . runArtisan($laravelPath, $phpBin, 'view:clear');
    $out .= "\n=== route:clear ===\n" . runArtisan($laravelPath, $phpBin, 'route:clear');
    $content = "<h2>Clear All Cache</h2><pre>" . htmlspecialchars($out) . "</pre>";
    html('Cache Clear', $content);
    exit;
}

// ── ACTION: BUILD CACHE ──────────────────────────────────────
if ($action === 'cache_build') {
    $out  = "=== config:cache ===\n" . runArtisan($laravelPath, $phpBin, 'config:cache');
    $out .= "\n=== route:cache ===\n" . runArtisan($laravelPath, $phpBin, 'route:cache');
    $out .= "\n=== view:cache ===\n" . runArtisan($laravelPath, $phpBin, 'view:cache');
    $content = "<h2>Build Cache (Optimize)</h2><pre>" . htmlspecialchars($out) . "</pre>";
    html('Cache Build', $content);
    exit;
}

// ── ACTION: CHECK ENV ────────────────────────────────────────
if ($action === 'check_env') {
    $envFile = $laravelPath . '/.env';
    if (!file_exists($envFile)) {
        $content = "<h2>Cek .env</h2><pre class='error'>File .env tidak ditemukan di:\n$envFile</pre>";
    } else {
        $lines = file($envFile);
        $safe  = [];
        foreach ($lines as $line) {
            // Sembunyikan nilai sensitif
            if (preg_match('/^(DB_PASSWORD|APP_KEY|MAIL_PASSWORD|.*SECRET.*)\s*=/i', $line)) {
                $key = explode('=', $line)[0];
                $safe[] = $key . '=*****';
            } else {
                $safe[] = rtrim($line);
            }
        }
        $out = implode("\n", $safe);
        $content = "<h2>Isi .env (nilai sensitif disembunyikan)</h2><pre>" . htmlspecialchars($out) . "</pre>";
    }
    html('Check Env', $content);
    exit;
}

// ── ACTION: TEST DB ──────────────────────────────────────────
if ($action === 'test_db') {
    $envFile = $laravelPath . '/.env';
    $env = [];
    if (file_exists($envFile)) {
        foreach (file($envFile) as $line) {
            if (preg_match('/^([A-Z_]+)=(.*)$/', trim($line), $m)) {
                $env[$m[1]] = trim($m[2], '"\'');
            }
        }
    }

    $host = $env['DB_HOST'] ?? '127.0.0.1';
    $port = $env['DB_PORT'] ?? 3306;
    $db   = $env['DB_DATABASE'] ?? '';
    $user = $env['DB_USERNAME'] ?? '';
    $pass = $env['DB_PASSWORD'] ?? '';

    try {
        $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db", $user, $pass, [
            PDO::ATTR_TIMEOUT => 5,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
        $version = $pdo->query('SELECT VERSION()')->fetchColumn();
        $tables  = $pdo->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN);
        $out = "KONEKSI BERHASIL!\n";
        $out .= "MySQL Version: $version\n";
        $out .= "Database: $db\n";
        $out .= "Total Tabel: " . count($tables) . "\n\n";
        $out .= "Tabel yang ada:\n" . implode("\n", array_map(fn($t) => "  - $t", $tables));
        $content = "<h2>Test Koneksi Database</h2><pre>" . htmlspecialchars($out) . "</pre>";
    } catch (\Exception $e) {
        $out = "KONEKSI GAGAL!\n\nError: " . $e->getMessage() . "\n\nConfig:\n  Host: $host\n  Port: $port\n  DB:   $db\n  User: $user";
        $content = "<h2>Test Koneksi Database</h2><pre class='error'>" . htmlspecialchars($out) . "</pre>";
    }

    html('Test DB', $content);
    exit;
}

// ── ACTION: PHP INFO ─────────────────────────────────────────
if ($action === 'phpinfo') {
    phpinfo();
    exit;
}

http_response_code(404);
echo "Unknown action.";
