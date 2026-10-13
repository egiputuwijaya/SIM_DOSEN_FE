<?php
/**
 * Web Routes Configuration (ala Laravel)
 */

use App\Core\Router;
use App\Helpers\Session;
use App\Controllers\AuthController;
use App\Controllers\DosenController;
use App\Controllers\HomeController;

// Route Root / Beranda (Landing Page Utama SIM Dosen)
Router::get('/', [HomeController::class, 'index']);

// Autentikasi & SSO
Router::get('/login', [AuthController::class, 'showLogin']);
Router::post('/login', [AuthController::class, 'login']);
Router::post('/logout', [AuthController::class, 'logout']);

// Portal Profil Khusus Dosen (Read-Only)
Router::get('/profil', [DosenController::class, 'profile']);

// Dashboard Admin & Statistik
Router::get('/dashboard', [DosenController::class, 'dashboard']);

// Modul Kelola Data Dosen (CRUD)
Router::get('/dosen', [DosenController::class, 'index']);
Router::get('/dosen/create', [DosenController::class, 'create']);
Router::post('/dosen', [DosenController::class, 'store']);
Router::get('/dosen/{id}', [DosenController::class, 'show']);
Router::get('/dosen/{id}/edit', [DosenController::class, 'edit']);
Router::put('/dosen/{id}', [DosenController::class, 'update']);
Router::delete('/dosen/{id}', [DosenController::class, 'destroy']);

// Health Check Endpoint (AJAX UI)
Router::get('/api-status', [DosenController::class, 'checkStatus']);
