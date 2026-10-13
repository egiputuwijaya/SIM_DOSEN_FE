<?php
namespace App\Helpers;

use App\Core\App;

class Session
{
    public static function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            ini_set('session.cookie_httponly', '1');
            ini_set('session.use_only_cookies', '1');
            session_start();
        }

        // Kelola penuaan flash messages
        if (!isset($_SESSION['_flash_next'])) {
            $_SESSION['_flash_next'] = [];
        }
        if (isset($_SESSION['_flash'])) {
            $_SESSION['_flash_old'] = $_SESSION['_flash'];
            unset($_SESSION['_flash']);
        }
        if (!empty($_SESSION['_flash_next'])) {
            $_SESSION['_flash'] = $_SESSION['_flash_next'];
            $_SESSION['_flash_next'] = [];
        }
    }

    public static function set(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public static function get(string $key, $default = null)
    {
        return $_SESSION[$key] ?? $default;
    }

    public static function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    public static function remove(string $key): void
    {
        unset($_SESSION[$key]);
    }

    public static function flash(string $key, $value): void
    {
        $_SESSION['_flash_next'][$key] = $value;
    }

    public static function getFlash(string $key, $default = null)
    {
        if (isset($_SESSION['_flash'][$key])) {
            $val = $_SESSION['_flash'][$key];
            unset($_SESSION['_flash'][$key]);
            return $val;
        }
        if (isset($_SESSION['_flash_old'][$key])) {
            $val = $_SESSION['_flash_old'][$key];
            unset($_SESSION['_flash_old'][$key]);
            return $val;
        }
        return $default;
    }

    public static function hasFlash(string $key): bool
    {
        return isset($_SESSION['_flash'][$key]) || isset($_SESSION['_flash_old'][$key]);
    }

    // Auth session helpers
    public static function setAuth(string $token, array $user): void
    {
        self::set('auth_token', $token);
        self::set('auth_user', $user);
    }

    public static function getToken(): ?string
    {
        return self::get('auth_token');
    }

    public static function getUser(): ?array
    {
        return self::get('auth_user');
    }

    public static function user(?string $key = null)
    {
        $user = self::getUser();
        if ($key === null) {
            return $user;
        }
        return $user[$key] ?? null;
    }

    public static function isLoggedIn(): bool
    {
        return self::has('auth_token') && !empty(self::get('auth_token'));
    }

    public static function userRole(): ?string
    {
        $user = self::getUser();
        return $user['role'] ?? null;
    }

    public static function hasWriteAccess(): bool
    {
        $role = self::userRole();
        $writeRoles = App::config('write_roles', ['ADMIN', 'BAAK']);
        return in_array($role, $writeRoles, true);
    }

    public static function logout(): void
    {
        self::remove('auth_token');
        self::remove('auth_user');
        session_regenerate_id(true);
    }
}
