<?php
/**
 * SIM Dosen Frontend - Front Controller (Native PHP MVC)
 */

define('APP_START', microtime(true));

// Sinkronisasi otomatis aset logo dan subfolder ke direktori public/assets
$pubLogo = __DIR__ . '/assets/logoumb.png';
$srcLogo = dirname(__DIR__) . '/assets/logoumb.png';
if (!file_exists($pubLogo) && file_exists($srcLogo)) {
    if (!is_dir(__DIR__ . '/assets')) {
        @mkdir(__DIR__ . '/assets', 0755, true);
    }
    @copy($srcLogo, $pubLogo);
}

foreach (['person', 'university'] as $folder) {
    $srcDir = dirname(__DIR__) . '/assets/' . $folder;
    $dstDir = __DIR__ . '/assets/' . $folder;
    if (is_dir($srcDir)) {
        if (!is_dir($dstDir)) {
            @mkdir($dstDir, 0755, true);
        }
        $files = scandir($srcDir);
        if ($files) {
            foreach ($files as $f) {
                if ($f !== '.' && $f !== '..' && !file_exists($dstDir . '/' . $f)) {
                    @copy($srcDir . '/' . $f, $dstDir . '/' . $f);
                }
            }
        }
    }
}

// Muat Core App
require_once __DIR__ . '/../app/Core/App.php';

// Jalankan Aplikasi dengan path root proyek
\App\Core\App::run(dirname(__DIR__));
