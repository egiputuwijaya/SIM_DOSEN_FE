<?php
namespace App\Core;

class App
{
    private static array $config = [];
    private static string $basePath;

    public static function run(string $basePath): void
    {
        self::$basePath = rtrim($basePath, '/\\');

        // Autoloader sederhana PSR-4 untuk namespace App\
        spl_autoload_register(function ($class) {
            $prefix = 'App\\';
            $baseDir = self::$basePath . '/app/';

            $len = strlen($prefix);
            if (strncmp($prefix, $class, $len) !== 0) {
                return;
            }

            $relativeClass = substr($class, $len);
            $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

            if (file_exists($file)) {
                require $file;
            }
        });

        // Muat Konfigurasi
        $configFile = self::$basePath . '/config/config.php';
        if (file_exists($configFile)) {
            self::$config = require $configFile;
        }

        // Muat Global Helpers
        require_once __DIR__ . '/../Helpers/functions.php';

        // Inisialisasi Session
        \App\Helpers\Session::start();

        // Muat Routes
        $routesFile = self::$basePath . '/routes/web.php';
        if (file_exists($routesFile)) {
            require $routesFile;
        }

        // Tangani Request
        $request = new Request();
        Router::dispatch($request);
    }

    public static function config(string $key, $default = null)
    {
        return self::$config[$key] ?? $default;
    }

    public static function basePath(string $path = ''): string
    {
        return self::$basePath . ($path ? '/' . ltrim($path, '/') : '');
    }
}
