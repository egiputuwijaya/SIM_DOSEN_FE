<?php
namespace App\Core;

class Request
{
    private array $get;
    private array $post;
    private array $server;
    private string $method;
    private string $uri;

    public function __construct()
    {
        $this->get = $_GET ?? [];
        $this->post = $_POST ?? [];
        $this->server = $_SERVER ?? [];

        // Method spoofing untuk RESTful (PUT, DELETE dari form HTML)
        $rawMethod = strtoupper($this->server['REQUEST_METHOD'] ?? 'GET');
        if ($rawMethod === 'POST' && isset($this->post['_method'])) {
            $this->method = strtoupper((string)$this->post['_method']);
        } else {
            $this->method = $rawMethod;
        }

        $this->uri = $this->parseUri();
    }

    private function parseUri(): string
    {
        $requestUri = $this->server['REQUEST_URI'] ?? '/';
        $path = parse_url($requestUri, PHP_URL_PATH) ?? '/';

        // Hilangkan subfolder script name bila aplikasi berjalan di subfolder
        $scriptName = str_replace('\\', '/', $this->server['SCRIPT_NAME'] ?? '');
        $baseDir = str_replace('\\', '/', dirname($scriptName));
        if ($baseDir !== '/' && $baseDir !== '.' && !empty($baseDir) && strpos($path, $baseDir) === 0) {
            $path = substr($path, strlen($baseDir));
        } else {
            $parentDir = str_replace('\\', '/', dirname($baseDir));
            if ($parentDir !== '/' && $parentDir !== '.' && !empty($parentDir) && strpos($path, $parentDir) === 0) {
                $path = substr($path, strlen($parentDir));
            }
        }

        // Hilangkan akhiran /index.php bila ada
        if (strpos($path, '/index.php') === 0) {
            $path = substr($path, 10);
        }

        $path = '/' . trim($path, '/');
        return $path === '//' ? '/' : $path;
    }

    public function method(): string
    {
        return $this->method;
    }

    public function path(): string
    {
        return $this->uri;
    }

    public function isMethod(string $method): bool
    {
        return strtoupper($method) === $this->method;
    }

    public function input(?string $key = null, $default = null)
    {
        $all = array_merge($this->get, $this->post);
        if ($key === null) {
            return $all;
        }
        return $all[$key] ?? $default;
    }

    public function all(): array
    {
        return array_merge($this->get, $this->post);
    }

    public function query(?string $key = null, $default = null)
    {
        if ($key === null) return $this->get;
        return $this->get[$key] ?? $default;
    }

    public function post(?string $key = null, $default = null)
    {
        if ($key === null) return $this->post;
        return $this->post[$key] ?? $default;
    }
}
