<?php
namespace App\Controllers;

use App\Core\App;
use App\Core\Request;
use App\Helpers\Session;
use App\Helpers\JwtHelper;
use App\Helpers\ApiClient;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login SSO
     */
    public function showLogin(Request $request): void
    {
        if (Session::isLoggedIn()) {
            if (Session::userRole() === 'DOSEN') {
                $this->redirect('/profil');
            } else {
                $this->redirect('/dashboard');
            }
        }

        $this->render('auth.login', [
            'title' => 'Masuk - SIM DOSEN Universitas Muhammadiyah Bengkulu',
        ], 'layouts.guest');
    }

    /**
     * Proses login melalui sim-mhs-api
     */
    public function login(Request $request): void
    {
        $username = trim((string)$request->input('username', ''));
        $password = (string)$request->input('password', '');

        if (empty($username) || empty($password)) {
            $this->redirectWithError('/login', 'Username dan password wajib diisi!', [], ['username' => $username]);
        }

        $ssoUrl = App::config('sso_login_url');
        $ssoFallbackUrl = App::config('sso_fallback_url');

        // 1. Hubungi server autentikasi sim-mhs-api
        $response = ApiClient::sendRequest('POST', $ssoUrl, [
            'username' => $username,
            'password' => $password,
        ]);

        // 2. Jika koneksi jaringan gagal total (status 0 / offline), coba fallback
        if (!$response['success'] && $response['status'] === 0 && !empty($ssoFallbackUrl)) {
            $response = ApiClient::sendRequest('POST', $ssoFallbackUrl, [
                'username' => $username,
                'password' => $password,
            ]);
        }

        if (!$response['success'] || empty($response['data']['accessToken'])) {
            $status = $response['status'] ?? 0;
            $apiMsg = $response['message'] ?? '';

            if ($status === 401) {
                $msg = 'Username atau password tidak sesuai. Silakan periksa kembali akun Anda.';
            } elseif ($status === 0) {
                $msg = 'Tidak dapat terhubung ke server autentikasi. Silakan periksa koneksi internet Anda.';
            } elseif ($status >= 500) {
                $msg = 'Server autentikasi sedang dalam pemeliharaan. Silakan coba beberapa saat lagi.';
            } else {
                $msg = $apiMsg ?: 'Gagal masuk ke sistem. Silakan periksa kembali username dan password Anda.';
            }

            $this->redirectWithError(
                '/login',
                $msg,
                [],
                ['username' => $username]
            );
        }

        $token = $response['data']['accessToken'];
        $payload = JwtHelper::decodePayload($token) ?? [];
        $userObj = $response['data']['user'] ?? [];

        // Ekstraksi role, nama, dan nip baik dari format sim-mhs-api maupun sim-dosen-api
        $role = $payload['role'] ?? (is_array($userObj['role'] ?? null) ? ($userObj['role']['kodeRole'] ?? 'GUEST') : ($userObj['role'] ?? 'GUEST'));
        $nama = $payload['nama'] ?? ($userObj['namaLengkap'] ?? ($userObj['nama'] ?? $username));
        $nip = $userObj['nip'] ?? ($payload['nip'] ?? null);

        Session::setAuth($token, [
            'id' => $payload['sub'] ?? ($userObj['id'] ?? 1),
            'username' => $payload['username'] ?? $username,
            'nama' => $nama,
            'nip' => $nip,
            'role' => strtoupper($role),
            'scope' => $payload['scope'] ?? ($userObj['scope'] ?? []),
        ]);

        // Pengalihan cerdas sesuai Role
        if (strtoupper($role) === 'DOSEN') {
            $this->redirectWithSuccess('/profil', 'Login SSO berhasil! Selamat datang, ' . $nama);
        } else {
            $this->redirectWithSuccess('/dashboard', 'Login SSO berhasil! Selamat datang, ' . $nama);
        }
    }

    /**
     * Logout
     */
    public function logout(Request $request): void
    {
        Session::logout();
        $this->redirectWithSuccess('/login', 'Anda telah berhasil keluar dari sistem.');
    }
}
