<!-- ==========================================================================
     NAVBAR REUSABLE COMPONENT - SIM DOSEN UNIVERSITAS MUHAMMADIYAH BENGKULU
     File: resources/views/partials/navbar.php
     Dapat digunakan di landing page maupun halaman publik lainnya
     ========================================================================== -->
<header class="landing-header" id="landingHeader">
  <div class="landing-header-container">
    <!-- Brand Logo & Kampus Title -->
    <a href="<?= url('/') ?>" class="landing-brand-link">
      <div class="landing-brand-logo-box">
        <img
          src="<?= asset('logoumb.png') ?>"
          alt="Logo Universitas Muhammadiyah Bengkulu"
          class="landing-brand-logo-img"
          onerror="this.onerror=null; this.src='<?= base_url('../assets/logoumb.png') ?>';"
        >
      </div>
      <div class="landing-brand-info">
        <span class="landing-brand-title">SIM DOSEN</span>
        <span class="landing-brand-sub">Univ. Muhammadiyah Bengkulu</span>
      </div>
    </a>

    <!-- Nav Menu Desktop -->
    <nav class="landing-nav-menu" id="landingNavMenu" aria-label="Navigasi Utama">
      <a href="<?= url('/') ?>#beranda" class="landing-nav-link active">Beranda</a>
      <a href="<?= url('/') ?>#tentang" class="landing-nav-link">Tentang</a>
      <a href="<?= url('/') ?>#layanan" class="landing-nav-link">Layanan</a>
      <a href="<?= url('/') ?>#statistik" class="landing-nav-link">Statistik</a>
      <a href="<?= url('/') ?>#panduan" class="landing-nav-link">Alur Akses</a>
      <a href="<?= url('/') ?>#faq" class="landing-nav-link">FAQ</a>
      <a href="<?= url('/') ?>#pengembang" class="landing-nav-link">Pengembang</a>
      <a href="<?= url('/') ?>#kontak" class="landing-nav-link">Kontak</a>
    </nav>

    <!-- Tombol Aksi Kanan (Masuk / Profil Dosen) -->
    <div class="landing-header-actions">
      <?php if (auth_check()): ?>
        <?php 
          $targetUrl = (auth_user()['role'] ?? '') === 'DOSEN' ? url('/profil') : url('/dashboard');
          $displayName = auth_user()['nama'] ?? auth_user()['username'] ?? 'Dosen';
        ?>
        <a href="<?= $targetUrl ?>" class="btn btn-primary landing-btn-action">
          <?= svg_icon('user', '', 17) ?>
          <span>Portal Saya (<?= e(substr($displayName, 0, 14)) ?>)</span>
        </a>
        <form action="<?= url('/logout') ?>" method="POST" style="margin: 0; display: inline;">
          <button type="submit" class="btn btn-secondary landing-btn-logout" title="Keluar">
            <?= svg_icon('log-out', '', 16) ?>
          </button>
        </form>
      <?php else: ?>
        <a href="<?= url('/login') ?>" class="btn btn-primary landing-btn-action">
          <span>Masuk ke Portal</span>
          <?= svg_icon('arrow-right', '', 16) ?>
        </a>
      <?php endif; ?>

      <!-- Tombol Hamburger Mobile -->
      <button class="landing-mobile-toggle" id="landingMobileToggle" aria-label="Menu Navigasi">
        <?= svg_icon('menu', '', 22) ?>
      </button>
    </div>
  </div>

  <!-- Mobile Dropdown Menu -->
  <div class="landing-mobile-menu" id="landingMobileMenu">
    <a href="<?= url('/') ?>#beranda" class="landing-mobile-link">Beranda</a>
    <a href="<?= url('/') ?>#tentang" class="landing-mobile-link">Tentang SIM Dosen</a>
    <a href="<?= url('/') ?>#layanan" class="landing-mobile-link">Modul &amp; Layanan</a>
    <a href="<?= url('/') ?>#statistik" class="landing-mobile-link">Statistik Akademik</a>
    <a href="<?= url('/') ?>#panduan" class="landing-mobile-link">Alur Penggunaan</a>
    <a href="<?= url('/') ?>#faq" class="landing-mobile-link">Tanya Jawab (FAQ)</a>
    <a href="<?= url('/') ?>#pengembang" class="landing-mobile-link">Tim Pengembang</a>
    <a href="<?= url('/') ?>#kontak" class="landing-mobile-link">Hubungi Kami</a>
    <div class="landing-mobile-auth">
      <?php if (auth_check()): ?>
        <a href="<?= (auth_user()['role'] ?? '') === 'DOSEN' ? url('/profil') : url('/dashboard') ?>" class="btn btn-primary" style="width: 100%;">
          <?= svg_icon('user', '', 16) ?>
          <span>Buka Portal Dosen</span>
        </a>
      <?php else: ?>
        <a href="<?= url('/login') ?>" class="btn btn-primary" style="width: 100%;">
          <span>Masuk ke Akun Dosen</span>
          <?= svg_icon('arrow-right', '', 16) ?>
        </a>
      <?php endif; ?>
    </div>
  </div>
</header>
