<!-- ==========================================================================
     HOME / LANDING PAGE - SIM DOSEN UNIVERSITAS MUHAMMADIYAH BENGKULU
     File: resources/views/home/index.php
     ========================================================================== -->

<!-- 1. HERO BANNER SECTION -->
<section class="landing-hero" id="beranda">
  <div class="landing-container hero-grid">
    <div class="hero-text-content">
     
      <h1 class="hero-title">
        Sistem Informasi <span class="gradient-text">Manajemen Dosen</span>
      </h1>

      <p class="hero-lead">
        Portal terpadu untuk sivitas akademika dosen Universitas Muhammadiyah Bengkulu. 
        Mendukung tata kelola tridharma perguruan tinggi, bimbingan mahasiswa, 
        serta pemenuhan beban kinerja dosen (BKD) secara akuntabel, efisien, dan berkelanjutan.
      </p>

      <div class="hero-actions">
        <?php if ($isLoggedIn): ?>
          <a href="<?= $userRole === 'DOSEN' ? url('/profil') : url('/dashboard') ?>" class="btn btn-primary btn-lg hero-btn-cta">
            <?= svg_icon('user', '', 20) ?>
            <span>Buka Portal Saya</span>
          </a>
        <?php else: ?>
          <a href="<?= url('/login') ?>" class="btn btn-primary btn-lg hero-btn-cta">
            <?= svg_icon('arrow-right', '', 20) ?>
            <span>Masuk ke Portal Dosen</span>
          </a>
        <?php endif; ?>

        <a href="#layanan" class="btn btn-secondary btn-lg hero-btn-secondary">
          <?= svg_icon('academic-cap', '', 18) ?>
          <span>Jelajahi Layanan</span>
        </a>
      </div>

      <!-- Quick Highlights Pills -->
      <div class="hero-highlights">
        <div class="highlight-item">
          <?= svg_icon('check-circle', '', 16) ?>
          <span>Terhubung ke Basis Data Kampus</span>
        </div>
        <div class="highlight-item">
          <?= svg_icon('check-circle', '', 16) ?>
          <span>Standar Sister &amp; LLDIKTI</span>
        </div>
        <div class="highlight-item">
          <?= svg_icon('check-circle', '', 16) ?>
          <span>Akses Fleksibel 24/7</span>
        </div>
      </div>
    </div>

    <!-- Hero Card Mockup Visual -->
    <div class="hero-visual-card">
      <div class="mockup-window">
        <div class="mockup-header">
          <div class="mockup-dots">
            <span class="dot red"></span>
            <span class="dot yellow"></span>
            <span class="dot green"></span>
          </div>
          <div class="mockup-address-bar">
            <span>sim-dosen.umb.ac.id/portal</span>
          </div>
        </div>

        <div class="mockup-body">
          <!-- Mini Preview Portal Dosen -->
          <div class="preview-dosen-profile">
            <div class="preview-avatar-box">
              <img
                src="<?= asset('logoumb.png') ?>"
                alt="Logo UMB"
                class="preview-logo-img"
                onerror="this.onerror=null; this.src='<?= base_url('../assets/logoumb.png') ?>';"
              >
            </div>
            <div class="preview-dosen-info">
              <h4>Universitas Muhammadiyah Bengkulu</h4>
              <p>Portal Layanan Mandiri Dosen</p>
            </div>
            <div class="preview-status-pill">
              <span class="status-indicator"></span>
              <span>Online</span>
            </div>
          </div>

          <!-- Feature Metric Grid -->
          <div class="preview-stats-grid">
            <div class="preview-stat-card">
              <span class="stat-num">Tridharma</span>
              <span class="stat-lbl">Pendidikan, Riset &amp; PkM</span>
            </div>
            <div class="preview-stat-card">
              <span class="stat-num">Validasi Nilai</span>
              <span class="stat-lbl">Semester Aktif</span>
            </div>
            <div class="preview-stat-card">
              <span class="stat-num">Bimbingan</span>
              <span class="stat-lbl">KRS &amp; Tugas Akhir</span>
            </div>
            <div class="preview-stat-card">
              <span class="stat-num">Rubrik BKD</span>
              <span class="stat-lbl">Laporan Kinerja</span>
            </div>
          </div>

          <div class="preview-notice-box">
            <?= svg_icon('badge-check', '', 18) ?>
            <span>Sistem telah terintegrasi dengan Pangkalan Data Pendidikan Tinggi</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 2. STATISTIK KAMPUS SECTION -->
<section class="landing-section section-stats" id="statistik">
  <div class="landing-container">
    <div class="stats-card-wrapper">
      <div class="stats-header-text">
        <span class="section-tagline">KOMITMEN AKADEMIK UMB</span>
        <h2>Mendukung Kinerja Ratusan Pendidik Profesional</h2>
        <p>Statistik operasional penunjang tridharma di lingkungan Universitas Muhammadiyah Bengkulu.</p>
      </div>

      <div class="stats-items-grid">
        <?php foreach ($stats as $stat): ?>
          <div class="stat-box-item">
            <div class="stat-icon-wrapper">
              <?= svg_icon($stat['icon'] ?? 'award', '', 24) ?>
            </div>
            <div class="stat-number-val"><?= e($stat['number']) ?></div>
            <div class="stat-label-title"><?= e($stat['label']) ?></div>
            <p class="stat-desc-sub"><?= e($stat['desc']) ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- 3. TENTANG SIM DOSEN SECTION -->
<section class="landing-section section-about" id="tentang">
  <div class="landing-container about-grid">
    <div class="about-image-side">
      <div class="about-badge-card">
        <div class="about-badge-icon">
          <?= svg_icon('academic-cap', '', 32) ?>
        </div>
        <div class="about-badge-text">
          <h3>Kampus Berkemajuan &amp; Berkarakter</h3>
          <p>Terakreditasi Baik Sekali &amp; Menuju Akreditasi Unggul</p>
        </div>
      </div>
      <div class="about-pillars-box">
        <div class="pillar-row">
          <div class="pillar-check"><?= svg_icon('check-circle', '', 18) ?></div>
          <div>
            <strong>Transparansi Beban Mengajar</strong>
            <p>Jadwal perkuliahan dan alokasi SKS terdata secara otomatis dan akurat.</p>
          </div>
        </div>
        <div class="pillar-row">
          <div class="pillar-check"><?= svg_icon('check-circle', '', 18) ?></div>
          <div>
            <strong>Arsip Kinerja Ilmiah Digital</strong>
            <p>Memudahkan pelaporan portofolio publikasi, hibah riset, dan sertifikat HAKI.</p>
          </div>
        </div>
        <div class="pillar-row">
          <div class="pillar-check"><?= svg_icon('check-circle', '', 18) ?></div>
          <div>
            <strong>Pelayanan Administrasi Tanpa Kertas (Paperless)</strong>
            <p>Verifikasi KRS mahasiswa dan lembar pengesahan bimbingan serba digital.</p>
          </div>
        </div>
      </div>
    </div>

    <div class="about-text-side">
      <span class="section-tagline">TENTANG SISTEM</span>
      <h2 class="section-title">
        Pusat Akselerasi Kinerja &amp; Karir Dosen Universitas Muhammadiyah Bengkulu
      </h2>
      <p class="section-desc">
        SIM DOSEN UMB dibangun sebagai solusi teknologi informasi komprehensif yang menjembatani kebutuhan dosen, pimpinan fakultas, dan pengelola universitas. Sistem ini mengintegrasikan seluruh tahapan tridharma mulai dari perencanaan mata kuliah, pelaksanaan bimbingan akademik, hingga pelaporan kinerja berkala.
      </p>
      <p class="section-desc">
        Dengan desain yang bersih, navigasi yang intuitif, serta perlindungan data yang kuat, setiap dosen dapat fokus pada tugas mulia mendidik generasi bangsa dan memajukan riset inovatif.
      </p>

      <div class="about-action-row">
        <?php if ($isLoggedIn): ?>
          <a href="<?= $userRole === 'DOSEN' ? url('/profil') : url('/dashboard') ?>" class="btn btn-primary">
            <span>Buka Halaman Profil Saya</span>
            <?= svg_icon('arrow-right', '', 16) ?>
          </a>
        <?php else: ?>
          <a href="<?= url('/login') ?>" class="btn btn-primary">
            <span>Masuk ke Akun Anda</span>
            <?= svg_icon('arrow-right', '', 16) ?>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<!-- 4. MODUL & LAYANAN TRIDHARMA SECTION -->
<section class="landing-section section-services" id="layanan">
  <div class="landing-container">
    <div class="section-header-center">
      <span class="section-tagline">LAYANAN UNGGULAN</span>
      <h2 class="section-title">Enam Modul Layanan Tridharma Terpadu</h2>
      <p class="section-subtitle">
        Semua kebutuhan administrasi akademik dosen kini berada dalam satu portal yang mudah diakses.
      </p>
    </div>

    <div class="services-cards-grid">
      <?php foreach ($services as $service): ?>
        <div class="service-card">
          <div class="service-card-top">
            <div class="service-icon-box">
              <?= svg_icon($service['icon'] ?? 'award', '', 22) ?>
            </div>
            <span class="service-tag-badge"><?= e($service['tag']) ?></span>
          </div>
          <h3 class="service-title"><?= e($service['title']) ?></h3>
          <p class="service-description"><?= e($service['desc']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- 5. ALUR PENGGUNAAN SECTION -->
<section class="landing-section section-steps" id="panduan">
  <div class="landing-container">
    <div class="section-header-center">
      <span class="section-tagline">PANDUAN AKSES CEPAT</span>
      <h2 class="section-title">Tiga Langkah Mudah Menggunakan SIM Dosen</h2>
      <p class="section-subtitle">
        Dirancang sederhana agar dosen dapat langsung mengelola tridharma tanpa hambatan teknis.
      </p>
    </div>

    <div class="steps-grid">
      <?php foreach ($steps as $step): ?>
        <div class="step-card">
          <div class="step-number"><?= e($step['step']) ?></div>
          <h3 class="step-title"><?= e($step['title']) ?></h3>
          <p class="step-desc"><?= e($step['desc']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- 6. PERTANYAAN YANG SERING DIAJUKAN (FAQ) SECTION -->
<section class="landing-section section-faq" id="faq">
  <div class="landing-container faq-container">
    <div class="section-header-center">
      <span class="section-tagline">PUSAT BANTUAN</span>
      <h2 class="section-title">Pertanyaan yang Sering Diajukan (FAQ)</h2>
      <p class="section-subtitle">
        Temukan jawaban cepat seputar akun, sinkronisasi data, dan layanan SIM Dosen UMB.
      </p>
    </div>

    <div class="faq-list">
      <?php foreach ($faqs as $index => $faq): ?>
        <div class="landing-faq-item <?= $index === 0 ? 'is-open' : '' ?>">
          <button class="faq-question-btn" type="button">
            <span><?= e($faq['q']) ?></span>
            <span class="faq-toggle-icon"><?= svg_icon('plus', '', 18) ?></span>
          </button>
          <div class="faq-answer-content">
            <p><?= e($faq['a']) ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- 7. TIM PENGEMBANG (DEVELOPERS) SECTION -->
<section class="landing-section section-developers" id="pengembang">
  <div class="landing-container">
    <div class="section-header-center">
      <span class="section-tagline">SOLIDARITAS &amp; DEDIKASI</span>
      <h2 class="section-title">Kolaborasi Pengembang SIM Mahasiswa &amp; Dosen</h2>
      <p class="section-subtitle">
        Dikembangkan oleh mahasiswa Fakultas Teknik Universitas Muhammadiyah Bengkulu melalui kolaborasi lintas teknologi modern.
      </p>
    </div>

    <!-- 1. Banner Foto Pengembang (Penuh & Bebas Halangan) -->
    <div class="dev-banner-card">
      <!-- Background Slideshow (Assets person/1.jpeg, person/2.jpeg, person/3.jpeg) -->
      <div class="dev-banner-backdrop" id="devBannerBackdrop">
        <?php foreach ($developerPhotos as $idx => $photo): ?>
          <div
            class="dev-slide-img <?= $idx === 0 ? 'is-active' : '' ?>"
            style="background-image: url('<?= asset($photo) ?>');"
            data-index="<?= $idx ?>"
          ></div>
        <?php endforeach; ?>
        <div class="dev-backdrop-overlay"></div>
      </div>

      <!-- Caption & Controls Di Atas Foto -->
      <div class="dev-banner-caption">
        <div class="dev-banner-badge">
          <?= svg_icon('shield', '', 14) ?>
          <span>SOLIDARITAS &amp; DEDIKASI</span>
        </div>
        <h3 class="dev-banner-title">
          Kolaborasi Pengembang SIM Mahasiswa &amp; Dosen
        </h3>
        <p class="dev-banner-sub">
          Fakultas Teknik (FT) &bull; Universitas Muhammadiyah Bengkulu
        </p>

        <!-- Slide Indicators / Dots -->
        <div class="dev-slide-dots" id="devSlideDots">
          <?php foreach ($developerPhotos as $idx => $photo): ?>
            <button
              type="button"
              class="dev-dot-btn <?= $idx === 0 ? 'is-active' : '' ?>"
              data-slide="<?= $idx ?>"
              aria-label="Foto Pengembang <?= $idx + 1 ?>"
            ></button>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <!-- 2. Tiga Card Pengembang di Bagian Bawah Gambar -->
    <div class="dev-cards-grid">
      <?php foreach ($developers as $dev): ?>
        <div class="dev-profile-card">
          <div class="dev-card-avatar-pill">
            <?= svg_icon('user', '', 22) ?>
          </div>
          <h4 class="dev-profile-name"><?= e($dev['name']) ?></h4>
          <span class="dev-profile-role"><?= e($dev['role']) ?></span>
          <p class="dev-profile-desc"><?= e($dev['desc']) ?></p>
          <div class="dev-card-footer">
            <a
              href="<?= e($dev['github']) ?>"
              target="_blank"
              rel="noopener noreferrer"
              class="dev-github-btn"
              title="Kunjungi GitHub <?= e($dev['name']) ?>"
              aria-label="GitHub <?= e($dev['name']) ?>"
            >
              <?= svg_icon('github', '', 18) ?>
              <span>Lihat GitHub</span>
            </a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- 8. CALL TO ACTION (CTA) BANNER -->
<section class="landing-cta-banner">
  <div class="landing-container">
    <div class="cta-inner-card">
      <div class="cta-text">
        <h2>Siap Mengelola Tridharma &amp; Kinerja Dosen?</h2>
        <p>
          Akses sekarang menggunakan akun resmi dosen Universitas Muhammadiyah Bengkulu untuk pengalaman administrasi akademik yang cepat dan akurat.
        </p>
      </div>
      <div class="cta-action">
        <?php if ($isLoggedIn): ?>
          <a href="<?= $userRole === 'DOSEN' ? url('/profil') : url('/dashboard') ?>" class="btn btn-primary btn-lg cta-btn">
            <?= svg_icon('user', '', 20) ?>
            <span>Masuk ke Portal Saya</span>
          </a>
        <?php else: ?>
          <a href="<?= url('/login') ?>" class="btn btn-primary btn-lg cta-btn">
            <?= svg_icon('arrow-right', '', 20) ?>
            <span>Masuk ke Portal Dosen</span>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
