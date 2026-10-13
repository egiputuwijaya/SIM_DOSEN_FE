<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= e($title ?? 'Sistem Informasi Dosen') ?></title>
  <!-- Cache busting query string agar browser selalu memuat stylesheet terbaru -->
  <link rel="stylesheet" href="<?= asset('css/app.css') ?>?v=<?= time() ?>">
  <script>
    window.BASE_URL = "<?= rtrim(base_url(), '/') ?>";
  </script>
  <style>
    /* Jaminan Styling Layout Dashboard & Sidebar (Bypass Cache & Responsive) */
    body {
      margin: 0;
      padding: 0;
      display: flex !important;
      min-height: 100vh;
      background-color: var(--bg);
    }
    .dashboard-wrapper {
      display: flex !important;
      flex-direction: row !important;
      min-height: 100vh !important;
      width: 100% !important;
      background-color: var(--bg);
    }
    
    /* SIDEBAR (DESKTOP DEFAULT) */
    .app-sidebar {
      width: 270px !important;
      min-width: 270px !important;
      max-width: 270px !important;
      background: #ffffff !important;
      border-right: 1px solid var(--border) !important;
      display: flex !important;
      flex-direction: column !important;
      position: sticky !important;
      top: 0 !important;
      height: 100vh !important;
      overflow-y: auto !important;
      z-index: 45 !important;
      box-sizing: border-box !important;
      transition: transform 0.28s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.28s ease !important;
    }
    .sidebar-brand-wrapper {
      display: flex !important;
      align-items: center !important;
      justify-content: space-between !important;
      border-bottom: 1px solid var(--border) !important;
      padding-right: 0.75rem !important;
    }
    .sidebar-brand {
      padding: 1.15rem 1.25rem !important;
      display: flex !important;
      align-items: center !important;
      gap: 0.85rem !important;
      text-decoration: none !important;
      color: inherit !important;
      flex: 1 !important;
      min-width: 0 !important;
    }
    .sidebar-close-btn {
      display: none !important;
    }
    .sidebar-backdrop {
      display: none !important;
    }
    .sidebar-toggle-btn {
      display: none !important;
    }
    .sidebar-user {
      padding: 1.15rem 1.25rem !important;
      display: flex !important;
      align-items: center !important;
      gap: 0.85rem !important;
      background: var(--slate-50) !important;
      border-bottom: 1px solid var(--border) !important;
    }
    .sidebar-nav {
      padding: 1.25rem 1rem !important;
      flex: 1 !important;
      display: flex !important;
      flex-direction: column !important;
      gap: 0.25rem !important;
    }
    .nav-section-title {
      font-size: 0.7rem !important;
      font-weight: 700 !important;
      color: var(--slate-400) !important;
      text-transform: uppercase !important;
      letter-spacing: 0.05em !important;
      padding: 0.85rem 0.65rem 0.4rem !important;
    }
    .nav-list {
      list-style: none !important;
      display: flex !important;
      flex-direction: column !important;
      gap: 0.35rem !important;
      padding: 0 !important;
      margin: 0 !important;
    }
    .nav-link {
      display: flex !important;
      align-items: center !important;
      gap: 0.75rem !important;
      padding: 0.65rem 0.85rem !important;
      border-radius: var(--radius-md) !important;
      font-size: 0.875rem !important;
      font-weight: 600 !important;
      color: var(--slate-600) !important;
      text-decoration: none !important;
      transition: all 0.2s ease !important;
    }
    .nav-link:hover {
      background: var(--slate-100) !important;
      color: var(--primary) !important;
      transform: translateX(2px) !important;
    }
    .nav-link.active {
      background: var(--primary-subtle) !important;
      color: var(--primary) !important;
      font-weight: 700 !important;
      border-left: 3px solid var(--primary) !important;
    }
    .sidebar-api-status {
      display: flex !important;
      align-items: center !important;
      gap: 0.75rem !important;
      padding: 0.65rem 0.85rem !important;
      border-radius: var(--radius-md) !important;
      background: var(--slate-50) !important;
      border: 1px solid var(--border) !important;
      margin-top: 0.5rem !important;
    }
    .nav-icon {
      display: inline-flex !important;
      align-items: center !important;
      justify-content: center !important;
      width: 22px !important;
      height: 22px !important;
      color: var(--slate-400) !important;
      transition: color 0.15s ease !important;
    }
    .nav-link:hover .nav-icon {
      color: var(--primary) !important;
    }
    .nav-link.active .nav-icon {
      color: var(--primary) !important;
    }
    .nav-link-danger {
      color: var(--rose-600) !important;
    }
    .nav-link-danger .nav-icon {
      color: var(--rose-400) !important;
    }
    .nav-link-danger:hover {
      background: var(--rose-50) !important;
      color: var(--rose-700) !important;
    }
    .nav-link-danger:hover .nav-icon {
      color: var(--rose-600) !important;
    }

    /* CONTENT WRAPPER & TOPBAR */
    .content-wrapper {
      flex: 1 !important;
      display: flex !important;
      flex-direction: column !important;
      min-width: 0 !important;
      width: calc(100% - 270px) !important;
      background: var(--bg) !important;
    }
    .topbar {
      background: #ffffff !important;
      border-bottom: 1px solid var(--border) !important;
      padding: 0.95rem 2.25rem !important;
      width: 100% !important;
      box-sizing: border-box !important;
      display: flex !important;
      align-items: center !important;
      justify-content: space-between !important;
      position: sticky !important;
      top: 0 !important;
      z-index: 35 !important;
      backdrop-filter: blur(8px) !important;
      gap: 1rem !important;
    }
    .topbar-left {
      display: flex !important;
      align-items: center !important;
      gap: 0.85rem !important;
      min-width: 0 !important;
    }
    .topbar-breadcrumb {
      font-size: 0.875rem !important;
      color: var(--text-muted) !important;
      display: flex !important;
      align-items: center !important;
      gap: 0.45rem !important;
      min-width: 0 !important;
    }
    .topbar-page-title {
      color: var(--slate-800) !important;
      font-weight: 700 !important;
      white-space: nowrap !important;
      overflow: hidden !important;
      text-overflow: ellipsis !important;
    }
    .topbar-right {
      display: flex !important;
      align-items: center !important;
      gap: 1rem !important;
      flex-shrink: 0 !important;
    }
    .badge-text-short {
      display: none !important;
    }
    .badge-text-full {
      display: inline !important;
    }
    .topbar-user-pill {
      font-size: 0.85rem !important;
      font-weight: 600 !important;
      color: var(--slate-800) !important;
      display: flex !important;
      align-items: center !important;
      gap: 0.5rem !important;
    }
    .topbar-avatar {
      width: 30px !important;
      height: 30px !important;
      border-radius: 50% !important;
      background: var(--primary-subtle) !important;
      color: var(--primary) !important;
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
      font-size: 0.775rem !important;
      font-weight: 700 !important;
      flex-shrink: 0 !important;
    }
    .main-content {
      flex: 1 !important;
      width: 100% !important;
      max-width: 100% !important;
      margin: 0 !important;
      padding: 1.75rem 2.25rem !important;
      box-sizing: border-box !important;
    }

    /* FULL-WIDTH ENTERPRISE DASHBOARD STYLES */
    .dashboard-hero {
      background: linear-gradient(135deg, #4338ca 0%, #312e81 60%, #1e1b4b 100%) !important;
      border-radius: var(--radius-lg) !important;
      padding: 2.25rem 2.5rem !important;
      color: #ffffff !important;
      display: flex !important;
      align-items: center !important;
      justify-content: space-between !important;
      flex-wrap: wrap !important;
      gap: 1.5rem !important;
      margin-bottom: 2rem !important;
      box-shadow: 0 10px 25px -5px rgba(67, 56, 202, 0.35) !important;
    }
    .hero-content {
      max-width: 650px !important;
    }
    .hero-badge {
      display: inline-flex !important;
      align-items: center !important;
      gap: 0.5rem !important;
      background: rgba(255, 255, 255, 0.15) !important;
      backdrop-filter: blur(8px) !important;
      padding: 0.3rem 0.75rem !important;
      border-radius: var(--radius-full) !important;
      font-size: 0.75rem !important;
      font-weight: 700 !important;
      letter-spacing: 0.04em !important;
      text-transform: uppercase !important;
      margin-bottom: 0.75rem !important;
      border: 1px solid rgba(255, 255, 255, 0.25) !important;
    }
    .live-pulse-dot {
      width: 8px !important;
      height: 8px !important;
      background: #34d399 !important;
      border-radius: 50% !important;
      box-shadow: 0 0 0 2px rgba(52, 211, 153, 0.4) !important;
    }
    .hero-title {
      font-size: 1.85rem !important;
      font-weight: 800 !important;
      color: #ffffff !important;
      margin-bottom: 0.4rem !important;
      letter-spacing: -0.02em !important;
    }
    .hero-subtitle {
      font-size: 0.925rem !important;
      color: rgba(255, 255, 255, 0.85) !important;
      line-height: 1.5 !important;
    }
    .hero-actions {
      display: flex !important;
      align-items: center !important;
      gap: 0.75rem !important;
      flex-wrap: wrap !important;
    }
    .page-header-bar {
      display: flex !important;
      align-items: center !important;
      justify-content: space-between !important;
      flex-wrap: wrap !important;
      gap: 1rem !important;
      margin-bottom: 1.75rem !important;
    }
    .page-title {
      font-size: 1.75rem !important;
      font-weight: 800 !important;
      color: var(--slate-900) !important;
      letter-spacing: -0.02em !important;
    }
    .page-subtitle {
      color: var(--text-muted) !important;
      font-size: 0.9rem !important;
      margin-top: 0.2rem !important;
    }
    .full-width-card {
      width: 100% !important;
      box-shadow: var(--shadow-sm) !important;
    }
    .filter-toolbar {
      display: flex !important;
      align-items: center !important;
      justify-content: space-between !important;
      flex-wrap: wrap !important;
      gap: 1rem !important;
      padding: 1.15rem 1.5rem !important;
    }
    .filter-controls {
      display: flex !important;
      align-items: center !important;
      gap: 0.65rem !important;
      flex-wrap: wrap !important;
    }
    .progress-bar-track {
      width: 100% !important;
      height: 8px !important;
      background: var(--slate-100) !important;
      border-radius: 9999px !important;
      overflow: hidden !important;
    }
    .progress-bar-fill {
      height: 100% !important;
      border-radius: 9999px !important;
    }
    .progress-bar-fill.indigo {
      background: linear-gradient(90deg, #6366f1, #4f46e5) !important;
    }
    .progress-bar-fill.emerald {
      background: linear-gradient(90deg, #10b981, #059669) !important;
    }

    /* TABLE RESPONSIVE SCROLL */
    .table-responsive {
      width: 100% !important;
      overflow-x: auto !important;
      -webkit-overflow-scrolling: touch !important;
      border-radius: var(--radius-md) !important;
    }
    .data-table {
      min-width: 760px;
    }

    /* =========================================================================
       MEDIA QUERIES: RESPONSIVE UNTUK TABLET & SMARTPHONE HANDPHONE
       ========================================================================= */

    /* 1. TABLET & LAYAR MEDIUM (<= 992px) */
    @media (max-width: 992px) {
      .dashboard-wrapper {
        display: block !important;
        position: relative !important;
        overflow-x: hidden !important;
      }
      .app-sidebar {
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        bottom: 0 !important;
        height: 100vh !important;
        width: 285px !important;
        min-width: 285px !important;
        max-width: 85vw !important;
        z-index: 1050 !important;
        transform: translateX(-100%) !important;
        box-shadow: none !important;
      }
      .app-sidebar.is-open {
        transform: translateX(0) !important;
        box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.35) !important;
      }
      .sidebar-close-btn {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 36px !important;
        height: 36px !important;
        border-radius: var(--radius-md) !important;
        border: 1px solid var(--border) !important;
        background: var(--slate-100) !important;
        color: var(--slate-600) !important;
        cursor: pointer !important;
        flex-shrink: 0 !important;
        transition: all 0.2s ease !important;
      }
      .sidebar-close-btn:hover {
        background: var(--rose-50) !important;
        color: var(--rose-600) !important;
        border-color: var(--rose-200) !important;
      }
      .sidebar-backdrop {
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        bottom: 0 !important;
        width: 100vw !important;
        height: 100vh !important;
        background: rgba(15, 23, 42, 0.6) !important;
        backdrop-filter: blur(4px) !important;
        z-index: 1040 !important;
        opacity: 0 !important;
        pointer-events: none !important;
        transition: opacity 0.25s ease !important;
        display: block !important;
      }
      .sidebar-backdrop.is-open {
        opacity: 1 !important;
        pointer-events: auto !important;
      }
      .content-wrapper {
        width: 100% !important;
        min-width: 100% !important;
        max-width: 100% !important;
        margin: 0 !important;
      }
      .topbar {
        padding: 0.85rem 1.25rem !important;
        position: sticky !important;
        top: 0 !important;
        z-index: 1000 !important;
      }
      .sidebar-toggle-btn {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 40px !important;
        height: 40px !important;
        min-width: 40px !important;
        border-radius: var(--radius-md) !important;
        background: var(--slate-100) !important;
        border: 1px solid var(--border) !important;
        color: var(--slate-700) !important;
        cursor: pointer !important;
        flex-shrink: 0 !important;
        transition: all 0.15s ease !important;
      }
      .sidebar-toggle-btn:hover {
        background: var(--slate-200) !important;
        color: var(--primary) !important;
      }
      .main-content {
        padding: 1.5rem 1.25rem !important;
        width: 100% !important;
        max-width: 100% !important;
        box-sizing: border-box !important;
        overflow-x: hidden !important;
      }
      .app-footer {
        padding: 1.25rem 1.25rem !important;
      }
      .footer-container {
        flex-direction: column !important;
        gap: 0.5rem !important;
        text-align: center !important;
      }
    }

    /* 2. TABLET PORTRAIT & SMARTPHONE (<= 768px) */
    @media (max-width: 768px) {
      .dashboard-hero {
        padding: 1.5rem 1.25rem !important;
        gap: 1.25rem !important;
        border-radius: var(--radius-md) !important;
      }
      .hero-title {
        font-size: 1.45rem !important;
        line-height: 1.25 !important;
      }
      .hero-subtitle {
        font-size: 0.875rem !important;
        line-height: 1.5 !important;
      }
      .hero-actions {
        width: 100% !important;
        flex-direction: column !important;
        gap: 0.65rem !important;
      }
      .hero-actions .btn {
        width: 100% !important;
        justify-content: center !important;
      }
      .page-header-bar {
        flex-direction: column !important;
        align-items: stretch !important;
        gap: 0.85rem !important;
        margin-bottom: 1.25rem !important;
      }
      .page-header-bar > div:last-child {
        width: 100% !important;
      }
      .page-header-bar .btn {
        width: 100% !important;
        justify-content: center !important;
      }
      .page-title {
        font-size: 1.4rem !important;
      }
      .filter-toolbar {
        flex-direction: column !important;
        align-items: stretch !important;
        padding: 1rem !important;
        gap: 0.85rem !important;
      }
      .filter-controls {
        width: 100% !important;
        flex-direction: column !important;
        align-items: stretch !important;
        gap: 0.6rem !important;
      }
      .search-input-box {
        width: 100% !important;
        min-width: 100% !important;
      }
      .select-filter {
        width: 100% !important;
      }
      .filter-controls .btn {
        width: 100% !important;
        justify-content: center !important;
      }
    }

    /* 3. PONSEL SMARTPHONE (<= 640px) */
    @media (max-width: 640px) {
      .topbar {
        padding: 0.65rem 0.85rem !important;
        gap: 0.5rem !important;
      }
      .topbar-brand-label {
        display: none !important;
      }
      .topbar-dot {
        display: none !important;
      }
      .topbar-page-title {
        font-size: 0.85rem !important;
        max-width: 130px !important;
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
      }
      .badge-text-full {
        display: none !important;
      }
      .badge-text-short {
        display: inline !important;
      }
      .topbar-user-name {
        display: none !important;
      }
      .topbar-avatar {
        width: 32px !important;
        height: 32px !important;
        font-size: 0.8rem !important;
      }
      .main-content {
        padding: 1rem 0.75rem !important;
      }
      .stats-grid {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 0.65rem !important;
        margin-bottom: 1.25rem !important;
      }
      .stat-card {
        padding: 0.9rem 0.8rem !important;
      }
      .stat-value {
        font-size: 1.35rem !important;
      }
      .stat-label {
        font-size: 0.72rem !important;
      }
      .form-grid {
        grid-template-columns: 1fr !important;
        gap: 0.85rem !important;
      }
      .card-footer {
        flex-direction: column-reverse !important;
        gap: 0.5rem !important;
        padding: 0.85rem 1rem !important;
      }
      .card-footer .btn {
        width: 100% !important;
        justify-content: center !important;
      }
      .modal-dialog {
        margin: 0.75rem !important;
        max-width: calc(100% - 1.5rem) !important;
        width: calc(100% - 1.5rem) !important;
      }
      .modal-detail-grid {
        grid-template-columns: 1fr !important;
        gap: 0.75rem !important;
      }
    }

    /* 4. PONSEL SMARTPHONE KECIL (<= 380px) */
    @media (max-width: 380px) {
      .stats-grid {
        grid-template-columns: 1fr !important;
      }
      .topbar-page-title {
        max-width: 100px !important;
      }
    }
  </style>
</head>
<body>
  <?php $user = auth_user() ?? []; ?>
  <?php $isAdmin = can_write(); ?>
  <?php $currentUri = $_SERVER['REQUEST_URI'] ?? ''; ?>
  <?php $isDashboardActive = str_contains($currentUri, '/dashboard'); ?>
  <?php $isKelolaActive = !$isDashboardActive && str_contains($currentUri, '/dosen'); ?>

  <div class="dashboard-wrapper">
    <!-- BACKDROP MOBILE DRAWER -->
    <div class="sidebar-backdrop" id="sidebarBackdrop" onclick="toggleSidebar(false)"></div>

    <!-- SIDEBAR NAVIGASI (ADMIN & DOSEN) -->
    <aside class="app-sidebar" id="appSidebar">
      <!-- Brand Sidebar Header -->
      <div class="sidebar-brand-wrapper">
        <a href="<?= (($user['role'] ?? '') === 'DOSEN') ? url('/profil') : url('/dashboard') ?>" class="sidebar-brand">
          <div style="display: flex; align-items: center; justify-content: center; width: 38px; height: 38px; border-radius: 10px; background: #ffffff; border: 1px solid var(--border); box-shadow: 0 2px 6px rgba(0,0,0,0.05); padding: 3px; flex-shrink: 0;">
            <img
              src="<?= asset('logoumb.png') ?>"
              alt="Logo UMB"
              style="width: 100%; height: 100%; object-fit: contain;"
              onerror="this.onerror=null; this.src='<?= base_url('../assets/logoumb.png') ?>';"
            >
          </div>
          <div class="brand-info" style="display: flex; flex-direction: column; min-width: 0;">
            <span class="brand-title" style="font-size: 0.95rem; font-weight: 800; color: var(--slate-900); line-height: 1.2;">SIM DOSEN</span>
            <span class="brand-subtitle" style="font-size: 0.675rem; color: var(--text-muted); font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Univ. Muhammadiyah Bengkulu</span>
          </div>
        </a>
        <button type="button" class="sidebar-close-btn" onclick="toggleSidebar(false)" aria-label="Tutup Menu">
          <?= svg_icon('x', '', 18) ?>
        </button>
      </div>

      <!-- Info Pengguna di Sidebar -->
      <div class="sidebar-user">
        <div class="user-avatar" style="position: relative;">
          <?= strtoupper(substr($user['nama'] ?? 'U', 0, 1)) ?>
          <span style="position: absolute; bottom: -2px; right: -2px; width: 10px; height: 10px; background: #10b981; border: 2px solid #ffffff; border-radius: 50%;"></span>
        </div>
        <div class="user-details">
          <span class="user-name"><?= e($user['nama'] ?? 'Pengguna') ?></span>
          <span class="role-badge <?= e($user['role'] ?? 'GUEST') ?>" style="margin-top: 0.25rem;">
            <?= e($user['role'] ?? 'GUEST') ?>
          </span>
        </div>
      </div>

      <!-- Menu Navigasi Sesuai Role -->
      <nav class="sidebar-nav">
        <!-- SEKSI MENU UTAMA -->
        <div class="nav-section-title">
          <?= ($user['role'] ?? '') === 'DOSEN' ? 'PORTAL DOSEN' : 'MENU ADMINISTRATOR' ?>
        </div>
        <ul class="nav-list">
          <?php if (($user['role'] ?? '') === 'DOSEN'): ?>
            <li>
              <a href="<?= url('/profil') ?>" class="nav-link <?= str_contains($currentUri, '/profil') ? 'active' : '' ?>" onclick="if(window.innerWidth <= 992) toggleSidebar(false)">
                <span class="nav-icon"><?= svg_icon('id-card', 'nav-svg', 18) ?></span>
                <span>Profil Saya</span>
              </a>
            </li>
          <?php else: ?>
            <li>
              <a href="<?= url('/dashboard') ?>" class="nav-link <?= $isDashboardActive ? 'active' : '' ?>" onclick="if(window.innerWidth <= 992) toggleSidebar(false)">
                <span class="nav-icon"><?= svg_icon('dashboard', 'nav-svg', 18) ?></span>
                <span>Dashboard & Statistik</span>
              </a>
            </li>
            <li>
              <a href="<?= url('/dosen') ?>" class="nav-link <?= $isKelolaActive ? 'active' : '' ?>" onclick="if(window.innerWidth <= 992) toggleSidebar(false)">
                <span class="nav-icon"><?= svg_icon('users', 'nav-svg', 18) ?></span>
                <span>Kelola Data Dosen</span>
              </a>
            </li>
          <?php endif; ?>
        </ul>

        <!-- SEKSI SISTEM & AKUN -->
        <div class="nav-section-title">SISTEM & AKUN</div>
        <ul class="nav-list">
          <li>
            <div class="sidebar-api-status">
              <span class="nav-icon" style="color: var(--primary);"><?= svg_icon('server', 'nav-svg', 18) ?></span>
              <div style="font-size: 0.75rem; display: flex; flex-direction: column; line-height: 1.3;">
                <span style="font-weight: 700; color: var(--slate-700);">REST API Backend</span>
                <span id="apiStatusBadge" style="color: var(--emerald-500); font-size: 0.72rem; font-weight: 600; display: inline-flex; align-items: center; gap: 0.35rem;">
                  <span style="display: inline-block; width: 6px; height: 6px; border-radius: 50%; background: var(--emerald-500);"></span> Terhubung
                </span>
              </div>
            </div>
          </li>
          <li style="margin-top: 0.75rem;">
            <form action="<?= url('/logout') ?>" method="POST" style="margin: 0;">
              <button type="submit" class="nav-link nav-link-danger" style="width: 100%; border: none; background: none; text-align: left; cursor: pointer;">
                <span class="nav-icon"><?= svg_icon('log-out', 'nav-svg', 18) ?></span>
                <span>Keluar (Logout)</span>
              </button>
            </form>
          </li>
        </ul>
      </nav>
    </aside>

    <!-- CONTENT WRAPPER -->
    <div class="content-wrapper">
      <!-- TOPBAR HEADER -->
      <header class="topbar">
        <div class="topbar-left">
          <button type="button" class="sidebar-toggle-btn" onclick="toggleSidebar()" aria-label="Toggle Menu">
            <?= svg_icon('menu', '', 18) ?>
          </button>
          <div class="topbar-breadcrumb">
            <span class="topbar-brand-label">SIM DOSEN</span>
            <span class="topbar-dot">&bull;</span>
            <strong class="topbar-page-title"><?= e($title ?? 'Sistem Informasi Dosen') ?></strong>
          </div>
        </div>

        <div class="topbar-right">
          <span class="badge <?= $isAdmin ? 'badge-danger' : 'badge-info' ?>" style="font-size: 0.75rem; padding: 0.35rem 0.85rem; display: inline-flex; align-items: center; gap: 0.35rem;">
            <?= svg_icon('shield', '', 13) ?>
            <span class="badge-text-full"><?= $isAdmin ? 'Izin Akses: Penuh (CRUD)' : 'Izin Akses: Read-Only (Profil Mandiri)' ?></span>
            <span class="badge-text-short"><?= $isAdmin ? 'Admin' : 'Dosen' ?></span>
          </span>
          <div class="topbar-user-pill">
            <div class="topbar-avatar">
              <?= strtoupper(substr($user['nama'] ?? 'U', 0, 1)) ?>
            </div>
            <span class="topbar-user-name"><?= e($user['nama'] ?? 'Pengguna') ?></span>
          </div>
        </div>
      </header>

      <!-- MAIN CONTENT -->
      <main class="main-content">
        <!-- FLASH MESSAGES -->
        <?php if (has_flash('success')): ?>
          <div class="alert alert-success">
            <?= svg_icon('check-circle', '', 20) ?>
            <div><?= e(get_flash('success')) ?></div>
            <button class="alert-close" type="button"><?= svg_icon('x', '', 16) ?></button>
          </div>
        <?php endif; ?>

        <?php if (has_flash('error')): ?>
          <div class="alert alert-danger">
            <?= svg_icon('alert-triangle', '', 20) ?>
            <div><?= e(get_flash('error')) ?></div>
            <button class="alert-close" type="button"><?= svg_icon('x', '', 16) ?></button>
          </div>
        <?php endif; ?>

        <?= $content ?>
      </main>

      <!-- FOOTER -->
      <footer class="app-footer">
        <div class="footer-container">
          <div>
            <strong>SIM DOSEN</strong> &copy; <?= date('Y') ?> &bull; Native PHP MVC Architecture
          </div>
          <div>
            Terhubung ke API: <code style="font-family: var(--font-mono); font-size: 0.75rem;"><?= e(App\Core\App::config('api_base_url')) ?></code>
          </div>
        </div>
      </footer>
    </div>
  </div>

  <!-- MODAL KONFIRMASI HAPUS -->
  <div class="modal-backdrop" id="deleteConfirmModal">
    <div class="modal-dialog">
      <div class="modal-header">
        <div style="display: flex; align-items: center; gap: 0.6rem;">
          <div style="width: 32px; height: 32px; border-radius: 8px; background: var(--rose-50); color: var(--rose-600); display: flex; align-items: center; justify-content: center;">
            <?= svg_icon('trash', '', 18) ?>
          </div>
          <h3 class="modal-title" style="color: var(--rose-700);">Konfirmasi Hapus Data</h3>
        </div>
        <button type="button" class="btn btn-secondary btn-icon btn-sm" onclick="closeDeleteModal()" aria-label="Tutup">
          <?= svg_icon('x', '', 16) ?>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah Anda yakin ingin menghapus data dosen <strong id="deleteDosenName">-</strong>?</p>
        <p style="font-size: 0.8rem; color: var(--text-muted); margin-top: 0.5rem; background: var(--slate-50); padding: 0.75rem; border-radius: var(--radius-md); border: 1px solid var(--border); display: flex; align-items: center; gap: 0.5rem;">
          <span style="color: var(--amber-500); display: inline-flex; align-items: center;">
            <?= svg_icon('alert-triangle', '', 16) ?>
          </span>
          <span><strong>Peringatan Sistem:</strong> Tindakan ini akan mengirimkan permintaan <code>DELETE</code> ke REST API dan data tidak dapat dipulihkan.</span>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="closeDeleteModal()">Batal</button>
        <form id="deleteConfirmForm" method="POST" style="margin:0;">
          <?= method_field('DELETE') ?>
          <button type="submit" class="btn btn-danger" style="display: inline-flex; align-items: center; gap: 0.4rem;">
            <?= svg_icon('trash', '', 16) ?>
            Hapus Permanen
          </button>
        </form>
      </div>
    </div>
  </div>

  <!-- MODAL QUICK PREVIEW DETAIL DOSEN -->
  <div class="modal-backdrop" id="dosenDetailModal">
    <div class="modal-dialog" style="max-width: 650px;">
      <div class="modal-header">
        <div style="display: flex; align-items: center; gap: 0.6rem;">
          <div style="width: 32px; height: 32px; border-radius: 8px; background: var(--primary-subtle); color: var(--primary); display: flex; align-items: center; justify-content: center;">
            <?= svg_icon('id-card', '', 18) ?>
          </div>
          <h3 class="modal-title">Detail Profil Dosen</h3>
        </div>
        <button type="button" class="btn btn-secondary btn-icon btn-sm" onclick="closeDetailModal()" aria-label="Tutup">
          <?= svg_icon('x', '', 16) ?>
        </button>
      </div>
      <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
        <div class="modal-detail-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; font-size: 0.875rem;">
          <div>
            <label style="color: var(--text-muted); font-size: 0.75rem;">NAMA LENGKAP</label>
            <div id="detail_nama" style="font-weight: 700; font-size: 1rem; color: var(--slate-900);">-</div>
          </div>
          <div>
            <label style="color: var(--text-muted); font-size: 0.75rem;">NO. REGISTRASI</label>
            <div id="detail_nomor_registrasi" style="font-weight: 600;">-</div>
          </div>
          <div>
            <label style="color: var(--text-muted); font-size: 0.75rem;">NUPTK</label>
            <div id="detail_nuptk">-</div>
          </div>
          <div>
            <label style="color: var(--text-muted); font-size: 0.75rem;">NIP</label>
            <div id="detail_nip">-</div>
          </div>
          <div>
            <label style="color: var(--text-muted); font-size: 0.75rem;">JABATAN FUNGSIONAL</label>
            <div id="detail_jabatan_fungsional">-</div>
          </div>
          <div>
            <label style="color: var(--text-muted); font-size: 0.75rem;">KEPANGKATAN</label>
            <div id="detail_kepangkatan">-</div>
          </div>
          <div>
            <label style="color: var(--text-muted); font-size: 0.75rem;">PENDIDIKAN TERAKHIR</label>
            <div id="detail_pendidikan_terakhir">-</div>
          </div>
          <div>
            <label style="color: var(--text-muted); font-size: 0.75rem;">RUMPUN ILMU</label>
            <div id="detail_rumpun_ilmu">-</div>
          </div>
          <div>
            <label style="color: var(--text-muted); font-size: 0.75rem;">STATUS SERDOS</label>
            <div id="detail_status_serdos">-</div>
          </div>
          <div>
            <label style="color: var(--text-muted); font-size: 0.75rem;">STATUS PEGAWAI</label>
            <div id="detail_status_pegawai">-</div>
          </div>
          <div>
            <label style="color: var(--text-muted); font-size: 0.75rem;">IKATAN KERJA</label>
            <div id="detail_ikatan_kerja">-</div>
          </div>
          <div>
            <label style="color: var(--text-muted); font-size: 0.75rem;">STATUS AKTIVITAS</label>
            <div id="detail_status_aktivitas">-</div>
          </div>
          <div style="grid-column: 1 / -1;">
            <label style="color: var(--text-muted); font-size: 0.75rem;">UNIT PENEMPATAN</label>
            <div id="detail_penempatan">-</div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="closeDetailModal()">Tutup</button>
      </div>
    </div>
  </div>

  <script src="<?= asset('js/app.js') ?>"></script>
  <script>
    function toggleSidebar(force) {
      const sb = document.getElementById('appSidebar');
      const bd = document.getElementById('sidebarBackdrop');
      if (!sb) return;
      const isCurrentlyOpen = sb.classList.contains('is-open');
      const shouldOpen = (force !== undefined) ? force : !isCurrentlyOpen;
      if (shouldOpen) {
        sb.classList.add('is-open');
        if (bd) bd.classList.add('is-open');
        document.body.style.overflow = 'hidden';
      } else {
        sb.classList.remove('is-open');
        if (bd) bd.classList.remove('is-open');
        document.body.style.overflow = '';
      }
    }
    function closeSidebar() {
      toggleSidebar(false);
    }
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        toggleSidebar(false);
      }
    });
  </script>
</body>
</html>
