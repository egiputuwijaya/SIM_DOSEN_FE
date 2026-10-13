<?php
/**
 * SIM Dosen - Konfigurasi Aplikasi (Native PHP MVC)
 */

if (!defined('APP_INIT')) {
    define('APP_INIT', true);
}

// Deteksi base URL secara dinamis agar berjalan di virtual host maupun subfolder Laragon
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || ($_SERVER['SERVER_PORT'] ?? 80) == 443) ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
$baseUrl = rtrim($protocol . $host . $scriptDir, '/');

// Base URL API utama (sim-dosen-api)
$apiBase = getenv('SIM_DOSEN_API_URL') ?: 'https://sim-dosen-api.vercel.app/api';

// SSO Endpoint sim-mhs-api (Live SSO Provider dari database SIM Mahasiswa di Vercel - API v1)
$ssoMhsUrl = getenv('SIM_MHS_SSO_URL') ?: 'https://sim-mhs-api.vercel.app/api/v1/auth/login';

return [
    'app_name' => 'SIM DOSEN Universitas Muhammadiyah Bengkulu',
    'app_version' => '1.0.0',
    'base_url' => $baseUrl,

    // Endpoint Backend sim-dosen-api
    'api_base_url' => $apiBase,

    // URL Endpoint SSO sim-mhs-api (Database SIM Mahasiswa di Vercel)
    'sso_mhs_url' => $ssoMhsUrl,

    // URL Endpoint Login SSO utama (sim-mhs-api Vercel)
    'sso_login_url' => getenv('SSO_LOGIN_URL') ?: $ssoMhsUrl,

    // URL Fallback jika sim-mhs-api tidak dapat dihubungi
    'sso_fallback_url' => rtrim($apiBase, '/') . '/auth/login',

    // Fallback otomatis ke server lokal (port 3000) bila server Vercel belum selesai dideploy
    'api_fallback_url' => 'http://localhost:3000/api',

    // Konfigurasi JWT Secret (sinkron dengan sim-dosen-api)
    'jwt_secret' => getenv('JWT_SECRET') ?: 'EDzB85JxzloVIG0NO0Y74qpOPu_HDb0Cfr630bIf3-u6E3KoKSy6TqObHRVFm0ZW',
    'jwt_issuer' => 'sim-mhs-api',

    // Role yang diizinkan melakukan create, edit, delete
    'write_roles' => ['ADMIN', 'BAAK'],

    // Semua role yang memiliki akses baca ke modul dosen
    'read_roles' => [
        'ADMIN', 'BAAK', 'DOSEN', 'MAHASISWA',
        'REKTORAT', 'DEKANAT', 'KAPRODI', 'ADMIN_PRODI', 'ADMIN_DEKANAT'
    ],
];
