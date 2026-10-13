<!-- ==========================================================================
     FOOTER REUSABLE COMPONENT - SIM DOSEN UNIVERSITAS MUHAMMADIYAH BENGKULU
     File: resources/views/partials/footer.php
     Dapat digunakan di landing page maupun halaman publik lainnya
     ========================================================================== -->
<footer class="landing-footer" id="kontak">
  <div class="landing-footer-main">
    <div class="landing-footer-container">
      <!-- Kolom 1: Profil Institusi -->
      <div class="footer-col footer-col-brand">
        <div class="footer-brand-box">
          <img
            src="<?= asset('logoumb.png') ?>"
            alt="Logo Universitas Muhammadiyah Bengkulu"
            class="footer-brand-logo"
            onerror="this.onerror=null; this.src='<?= base_url('../assets/logoumb.png') ?>';"
          >
          <div>
            <h3 class="footer-brand-title">SIM DOSEN</h3>
            <p class="footer-brand-subtitle">Universitas Muhammadiyah Bengkulu</p>
          </div>
        </div>
        <p class="footer-brand-desc">
          Sistem Informasi Manajemen Dosen (SIM DOSEN) merupakan pusat layanan administrasi terpadu untuk mendukung tridharma perguruan tinggi, publikasi ilmiah, dan evaluasi kinerja dosen secara transparan dan akuntabel.
        </p>
        <div class="footer-social-links">
          <a href="https://umb.ac.id" target="_blank" rel="noopener" class="footer-social-link" title="Website Resmi UMB">
            <?= svg_icon('building', '', 18) ?>
          </a>
          <a href="mailto:it-helpdesk@umb.ac.id" class="footer-social-link" title="Email Bantuan Teknis">
            <?= svg_icon('info', '', 18) ?>
          </a>
          <a href="tel:073622765" class="footer-social-link" title="Telepon Kampus">
            <?= svg_icon('shield', '', 18) ?>
          </a>
        </div>
      </div>

      <!-- Kolom 2: Tautan Akses Cepat -->
      <div class="footer-col">
        <h4 class="footer-col-title">Tautan Cepat</h4>
        <ul class="footer-links-list">
          <li><a href="<?= url('/') ?>#beranda">Beranda Utama</a></li>
          <li><a href="<?= url('/login') ?>">Masuk ke Portal Dosen</a></li>
          <li><a href="<?= url('/') ?>#layanan">Modul Tridharma</a></li>
          <li><a href="<?= url('/') ?>#panduan">Alur Penggunaan</a></li>
          <li><a href="<?= url('/') ?>#faq">Tanya Jawab (FAQ)</a></li>
          <li><a href="https://umb.ac.id" target="_blank" rel="noopener">Website Utama UMB</a></li>
        </ul>
      </div>

      <!-- Kolom 3: Fakultas & Program Akademik -->
      <div class="footer-col">
        <h4 class="footer-col-title">Fakultas &amp; Unit</h4>
        <ul class="footer-links-list">
          <li><span>Fakultas Teknik</span></li>
          <li><span>Fakultas Keguruan &amp; Ilmu Pendidikan</span></li>
          <li><span>Fakultas Ekonomi &amp; Bisnis</span></li>
          <li><span>Fakultas Agama Islam</span></li>
          <li><span>Fakultas Hukum</span></li>
          <li><span>Fakultas Pertanian &amp; Peternakan</span></li>
          <li><span>Lembaga Riset &amp; Pengabdian (LPPM)</span></li>
        </ul>
      </div>

      <!-- Kolom 4: Lokasi Kampus & Layanan Bantuan -->
      <div class="footer-col">
        <h4 class="footer-col-title">Pusat Informasi &amp; Helpdesk</h4>
        <div class="footer-contact-item">
          <div class="contact-icon-box"><?= svg_icon('map-pin', '', 18) ?></div>
          <div>
            <strong>Kampus 1:</strong> Jl. Bali, Teluk Segara, Kota Bengkulu, Bengkulu 38119<br>
            <strong style="margin-top: 0.25rem; display: inline-block;">Kampus 4:</strong> Jl. Adam Malik, Cempaka Permai, Bengkulu
          </div>
        </div>
        <div class="footer-contact-item">
          <div class="contact-icon-box"><?= svg_icon('building', '', 18) ?></div>
          <div>
            <strong>Biro Pengelola:</strong><br>
            Biro Administrasi Akademik &amp; Kepegawaian (BAAK)<br>
            Biro Sistem Informasi &amp; Pangkalan Data (BIPD)
          </div>
        </div>
        <div class="footer-contact-item">
          <div class="contact-icon-box"><?= svg_icon('info', '', 18) ?></div>
          <div>
            <strong>Kontak Bantuan:</strong><br>
            Email: <a href="mailto:it-helpdesk@umb.ac.id" style="color: var(--primary-subtle); text-decoration: underline;">it-helpdesk@umb.ac.id</a><br>
            Telp: (0736) 22765 / (0736) 344318
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer Bottom / Copyright -->
  <div class="landing-footer-bottom">
    <div class="footer-bottom-container">
      <div class="footer-copyright-text">
        &copy; <?= date('Y') ?> <strong>Universitas Muhammadiyah Bengkulu</strong>. Seluruh Hak Cipta Dilindungi Undang-Undang.
      </div>
      <div class="footer-security-status">
        <span class="security-status-dot"></span>
        <span>Sistem Informasi Manajemen Dosen v1.0 &bull; Server Aktif</span>
      </div>
    </div>
  </div>
</footer>
