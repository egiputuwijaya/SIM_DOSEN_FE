<?php
namespace App\Core;

class Router
{
    private static array $routes = [];

    public static function get(string $path, array|callable $action, array $middlewares = []): void
    {
        self::addRoute('GET', $path, $action, $middlewares);
    }

    public static function post(string $path, array|callable $action, array $middlewares = []): void
    {
        self::addRoute('POST', $path, $action, $middlewares);
    }

    public static function put(string $path, array|callable $action, array $middlewares = []): void
    {
        self::addRoute('PUT', $path, $action, $middlewares);
    }

    public static function delete(string $path, array|callable $action, array $middlewares = []): void
    {
        self::addRoute('DELETE', $path, $action, $middlewares);
    }

    private static function addRoute(string $method, string $path, array|callable $action, array $middlewares): void
    {
        $path = '/' . trim($path, '/');
        if ($path === '//') $path = '/';

        self::$routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'action' => $action,
            'middlewares' => $middlewares,
        ];
    }

    public static function dispatch(Request $request): void
    {
        $currentMethod = $request->method();
        $currentPath = $request->path();

        foreach (self::$routes as $route) {
            if ($route['method'] !== $currentMethod) {
                continue;
            }

            $pattern = self::convertPathToRegex($route['path']);
            if (preg_match($pattern, $currentPath, $matches)) {
                // Ekstrak named parameters
                $params = array_filter($matches, function ($key) {
                    return !is_numeric($key);
                }, ARRAY_FILTER_USE_KEY);

                // Jalankan Middleware jika ada
                foreach ($route['middlewares'] as $middleware) {
                    if (is_callable($middleware)) {
                        $middleware($request);
                    } elseif (class_exists($middleware)) {
                        $instance = new $middleware();
                        if (method_exists($instance, 'handle')) {
                            $instance->handle($request);
                        }
                    }
                }

                // Eksekusi Action
                $action = $route['action'];
                if (is_callable($action)) {
                    call_user_func_array($action, array_merge([$request], $params));
                    return;
                }

                if (is_array($action) && count($action) === 2) {
                    [$controllerClass, $method] = $action;
                    if (class_exists($controllerClass)) {
                        $controller = new $controllerClass();
                        if (method_exists($controller, $method)) {
                            call_user_func_array([$controller, $method], array_merge([$request], $params));
                            return;
                        }
                    }
                }
            }
        }

        // 404 Not Found
        http_response_code(404);
        $viewsPath = dirname(__DIR__, 2) . '/resources/views';
        if (file_exists($viewsPath . '/errors/404.php')) {
            require $viewsPath . '/errors/404.php';
        } else {
            echo "<h1>404 Not Found</h1><p>Halaman tidak ditemukan.</p>";
        }
    }

    private static function convertPathToRegex(string $path): string
    {
        $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[^/]+)', $path);
        return '#^' . $pattern . '$#';
    }
}
