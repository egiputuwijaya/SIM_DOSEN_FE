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
    /* Jaminan Styling Layout Dashboard & Sidebar (Bypass Cache) */
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
    }
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
    }
    .sidebar-brand {
      padding: 1.25rem 1.5rem !important;
      display: flex !important;
      align-items: center !important;
      gap: 0.85rem !important;
      border-bottom: 1px solid var(--border) !important;
      text-decoration: none !important;
      color: inherit !important;
    }
    .sidebar-user {
      padding: 1.15rem 1.5rem !important;
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
    .content-wrapper {
      flex: 1 !important;
      display: flex !important;
      flex-direction: column !important;
      min-width: 0 !important;
      width: calc(100% - 270px) !important;
      background: var(--bg) !important;
    }
    .main-content {
      flex: 1 !important;
      width: 100% !important;
      max-width: 100% !important;
      margin: 0 !important;
      padding: 1.75rem 2.25rem !important;
      box-sizing: border-box !important;
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
    .brand-logo {
      width: 42px !important;
      height: 42px !important;
      border-radius: 12px !important;
      background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%) !important;
      color: #ffffff !important;
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
      box-shadow: 0 4px 14px rgba(79, 70, 229, 0.3) !important;
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
  </style>
</head>
<body>
  <?php $user = auth_user() ?? []; ?>
  <?php $isAdmin = can_write(); ?>
  <?php $currentUri = $_SERVER['REQUEST_URI'] ?? ''; ?>
  <?php $isDashboardActive = str_contains($currentUri, '/dashboard'); ?>
  <?php $isKelolaActive = !$isDashboardActive && str_contains($currentUri, '/dosen'); ?>

  <div class="dashboard-wrapper">
    <!-- SIDEBAR NAVIGASI (ADMIN & DOSEN) -->
    <aside class="app-sidebar" id="appSidebar">
      <!-- Brand Sidebar -->
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
              <a href="<?= url('/profil') ?>" class="nav-link <?= str_contains($currentUri, '/profil') ? 'active' : '' ?>">
                <span class="nav-icon"><?= svg_icon('id-card', 'nav-svg', 18) ?></span>
                <span>Profil Saya</span>
              </a>
            </li>
          <?php else: ?>
            <li>
              <a href="<?= url('/dashboard') ?>" class="nav-link <?= $isDashboardActive ? 'active' : '' ?>">
                <span class="nav-icon"><?= svg_icon('dashboard', 'nav-svg', 18) ?></span>
                <span>Dashboard & Statistik</span>
              </a>
            </li>
            <li>
              <a href="<?= url('/dosen') ?>" class="nav-link <?= $isKelolaActive ? 'active' : '' ?>">
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
        <div style="display: flex; align-items: center; gap: 1rem;">
          <button type="button" class="sidebar-toggle-btn" onclick="toggleSidebar()" aria-label="Toggle Menu">
            <?= svg_icon('menu', '', 18) ?>
          </button>
          <div style="font-size: 0.875rem; color: var(--text-muted); display: flex; align-items: center; gap: 0.5rem;">
            <span>SIM DOSEN</span>
            <span style="color: var(--slate-300);">&bull;</span>
            <strong style="color: var(--slate-800);"><?= e($title ?? 'Sistem Informasi Dosen') ?></strong>
          </div>
        </div>

        <div style="display: flex; align-items: center; gap: 1rem;">
          <span class="badge <?= $isAdmin ? 'badge-danger' : 'badge-info' ?>" style="font-size: 0.75rem; padding: 0.35rem 0.85rem; display: inline-flex; align-items: center; gap: 0.35rem;">
            <?= svg_icon('shield', '', 13) ?>
            <?= $isAdmin ? 'Izin Akses: Penuh (CRUD)' : 'Izin Akses: Read-Only (Profil Mandiri)' ?>
          </span>
          <div style="font-size: 0.85rem; font-weight: 600; color: var(--slate-800); display: flex; align-items: center; gap: 0.5rem;">
            <div style="width: 28px; height: 28px; border-radius: 50%; background: var(--primary-subtle); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 700;">
              <?= strtoupper(substr($user['nama'] ?? 'U', 0, 1)) ?>
            </div>
            <?= e($user['nama'] ?? 'Pengguna') ?>
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
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; font-size: 0.875rem;">
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
    function toggleSidebar() {
      const sb = document.getElementById('appSidebar');
      if (sb) sb.classList.toggle('is-open');
    }
  </script>
</body>
</html>
