<div class="login-split-layout">
  <!-- PANEL KIRI: HERO & BRANDING INSTITUSI -->
  <aside class="login-hero-panel">
    <!-- Header Logo & Identitas Kampus -->
    <div class="hero-brand-header">
      <div class="hero-logo-box">
        <img
          src="<?= asset('logoumb.png') ?>"
          alt="Logo Universitas Muhammadiyah Bengkulu"
          class="hero-logo-img"
          onerror="this.onerror=null; this.src='<?= base_url('../assets/logoumb.png') ?>';"
        >
      </div>
      <div class="hero-brand-text">
        <h2>UNIVERSITAS MUHAMMADIYAH BENGKULU</h2>
        <p>Sistem Informasi Manajemen Dosen (SIM DOSEN)</p>
      </div>
    </div>

    <!-- Konten Utama Hero -->
    <div class="hero-main-content">
      <div class="hero-badge-pill">
        <?= svg_icon('shield', '', 15) ?>
        <span>Portal Akademik Resmi Dosen UMB</span>
      </div>

      <h1 class="hero-headline">
        Kelola Tridharma &amp; Kinerja Dosen Secara Terpadu
      </h1>

      <p class="hero-description">
        Selamat datang di portal layanan mandiri dosen Universitas Muhammadiyah Bengkulu. 
        Akses cepat, aman, dan efisien untuk mendukung pengajaran, penelitian, dan pengabdian masyarakat.
      </p>

      <!-- Fitur Pilar Layanan -->
      <div class="hero-features-list">
        <div class="hero-feature-item">
          <div class="feature-icon-box">
            <?= svg_icon('academic-cap', '', 20) ?>
          </div>
          <div class="feature-text">
            <h4>Layanan Perkuliahan &amp; Mahasiswa</h4>
            <p>Pengelolaan jadwal mengajar, absensi, bimbingan akademik, serta validasi nilai semester.</p>
          </div>
        </div>

        <div class="hero-feature-item">
          <div class="feature-icon-box">
            <?= svg_icon('award', '', 20) ?>
          </div>
          <div class="feature-text">
            <h4>Portofolio &amp; Rekam Kinerja</h4>
            <p>Pencatatan publikasi ilmiah, penelitian, kepangkatan fungsional, dan beban kerja dosen (BKD).</p>
          </div>
        </div>

        <div class="hero-feature-item">
          <div class="feature-icon-box">
            <?= svg_icon('badge-check', '', 20) ?>
          </div>
          <div class="feature-text">
            <h4>Akses Data Terpusat &amp; Aman</h4>
            <p>Integritas data terverifikasi dengan standar otentikasi kampus dan proteksi keamanan terpadu.</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer Hero -->
    <div class="hero-footer-meta">
      <div>
        <span>Kampus UMB: Jl. Bali, Teluk Segara &bull; Jl. Adam Malik, Kota Bengkulu</span>
      </div>
      <div>
        &copy; <?= date('Y') ?> Universitas Muhammadiyah Bengkulu.
      </div>
    </div>
  </aside>

  <!-- PANEL KANAN: FORM LOGIN ENTERPRISE -->
  <main class="login-form-panel">
    <div class="login-form-box">
      <!-- Tampilan Header Khusus Mobile/Tablet -->
      <div class="mobile-brand-box">
        <img
          src="<?= asset('logoumb.png') ?>"
          alt="Logo UMB"
          class="mobile-brand-logo"
          onerror="this.onerror=null; this.src='<?= base_url('../assets/logoumb.png') ?>';"
        >
        <div>
          <h2 class="mobile-brand-title">SIM DOSEN UMB</h2>
          <p class="mobile-brand-subtitle">Universitas Muhammadiyah Bengkulu</p>
        </div>
      </div>

      <!-- Header Form -->
      <div class="login-form-header">
        <h2>Masuk ke Akun</h2>
        <p>Silakan masukkan NIP atau Username dan Password Anda untuk mengakses sistem.</p>
      </div>

      <!-- Flash Messages -->
      <?php if (has_flash('error')): ?>
        <div class="alert alert-danger">
          <div><?= e(get_flash('error')) ?></div>
          <button class="alert-close" type="button" onclick="this.parentElement.remove()"><?= svg_icon('x', '', 16) ?></button>
        </div>
      <?php endif; ?>

      <?php if (has_flash('success')): ?>
        <div class="alert alert-success">
          <div><?= e(get_flash('success')) ?></div>
          <button class="alert-close" type="button" onclick="this.parentElement.remove()"><?= svg_icon('x', '', 16) ?></button>
        </div>
      <?php endif; ?>

      <!-- Form Otentikasi -->
      <form action="<?= url('/login') ?>" method="POST" id="loginForm">
        <!-- Input Username / NIP -->
        <div class="form-group" style="margin-bottom: 1.25rem;">
          <label class="form-label" for="username">
            <span>NIP / Username</span>
            <span class="required">*</span>
          </label>
          <div class="input-with-icon-wrapper">
            <input
              type="text"
              id="username"
              name="username"
              class="form-control has-icon"
              placeholder="Masukkan NIP atau username Anda"
              value="<?= e(old('username')) ?>"
              required
              autofocus
              autocomplete="username"
            >
            <span class="input-icon-prefix">
              <?= svg_icon('user', '', 18) ?>
            </span>
          </div>
        </div>

        <!-- Input Password -->
        <div class="form-group" style="margin-bottom: 1.25rem;">
          <label class="form-label" for="password">
            <span>Password</span>
            <span class="required">*</span>
          </label>
          <div class="input-with-icon-wrapper">
            <input
              type="password"
              id="password"
              name="password"
              class="form-control has-icon has-toggle"
              placeholder="Masukkan password Anda"
              required
              autocomplete="current-password"
            >
            <span class="input-icon-prefix">
              <?= svg_icon('lock', '', 18) ?>
            </span>
            <button
              type="button"
              class="password-toggle-btn"
              id="togglePasswordBtn"
              title="Tampilkan / Sembunyikan Password"
              aria-label="Tampilkan / Sembunyikan Password"
            >
              <span id="eyeOpenIcon"><?= svg_icon('eye', '', 18) ?></span>
              <span id="eyeClosedIcon" style="display: none;"><?= svg_icon('eye-off', '', 18) ?></span>
            </button>
          </div>
        </div>

        <!-- Opsi Tambahan -->
        <div class="login-options-row">
          <label class="login-remember-checkbox">
            <input type="checkbox" name="remember" value="1">
            <span>Ingat sesi saya</span>
          </label>
          <a href="mailto:it-helpdesk@umb.ac.id?subject=Bantuan%20Akses%20SIM%20Dosen" class="login-forgot-link">
            Lupa password?
          </a>
        </div>

        <!-- Tombol Masuk -->
        <button type="submit" class="btn btn-primary login-btn-submit" id="submitBtn">
          <?= svg_icon('arrow-right', '', 18) ?>
          <span>Masuk ke Sistem</span>
        </button>

        <!-- Indikator Keamanan -->
        <div class="security-badge">
          <?= svg_icon('shield', '', 15) ?>
          <span>Sesi aman terenkripsi &bull; Standar Keamanan Kampus UMB</span>
        </div>
      </form>

      <!-- Informasi Bantuan / Help Desk -->
      <div class="login-form-footer-help">
        <p>Mengalami kendala saat masuk? Hubungi <strong>Biro Sistem Informasi &amp; Pangkalan Data (BIPD)</strong> atau Biro Kepegawaian UMB.</p>
        <p style="margin-top: 0.35rem; font-size: 0.775rem;">
          Email: <a href="mailto:it-helpdesk@umb.ac.id">it-helpdesk@umb.ac.id</a> &bull; Gedung Rektorat UMB Lt. 2
        </p>
      </div>
    </div>
  </main>
</div>

<script>
  // Toggle Password Visibility
  (function() {
    const toggleBtn = document.getElementById('togglePasswordBtn');
    const passwordInput = document.getElementById('password');
    const eyeOpen = document.getElementById('eyeOpenIcon');
    const eyeClosed = document.getElementById('eyeClosedIcon');

    if (toggleBtn && passwordInput) {
      toggleBtn.addEventListener('click', function() {
        const isPassword = passwordInput.getAttribute('type') === 'password';
        passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
        if (eyeOpen && eyeClosed) {
          eyeOpen.style.display = isPassword ? 'none' : 'inline-block';
          eyeClosed.style.display = isPassword ? 'inline-block' : 'none';
        }
      });
    }
  })();
</script>
