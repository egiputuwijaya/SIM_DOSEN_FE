<!-- PROFIL DOSEN HERO CARD -->
<div class="card full-width-card profile-hero-card" style="margin-bottom: 2rem; border: 1px solid var(--border); border-top: 4px solid var(--primary); background: #ffffff; padding: 2rem; box-shadow: var(--shadow-sm); border-radius: var(--radius-lg);">
  <!-- IDENTITAS UTAMA (AVATAR, NAMA & BADGES) -->
  <div class="profile-hero-inner" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1.5rem;">
    <div style="display: flex; align-items: center; gap: 1.25rem; flex-wrap: wrap;">
      <!-- AVATAR DENGAN INISIAL -->
      <div style="width: 72px; height: 72px; border-radius: 18px; background: linear-gradient(135deg, var(--primary) 0%, #7c3aed 100%); color: #ffffff; font-size: 1.9rem; font-weight: 800; display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 16px rgba(79, 70, 229, 0.2); position: relative; flex-shrink: 0;">
        <?= strtoupper(substr($dosen['nama'] ?? 'D', 0, 1)) ?>
        <span style="position: absolute; bottom: -2px; right: -2px; width: 14px; height: 14px; background: #10b981; border: 2.5px solid #ffffff; border-radius: 50%;" title="Status Akun Aktif"></span>
      </div>

      <!-- NAMA LENGKAP & STATUS -->
      <div>
        <h1 style="font-size: 1.45rem; font-weight: 800; color: var(--slate-900); letter-spacing: -0.02em; margin: 0 0 0.5rem 0; line-height: 1.25;">
          <?= e($dosen['nama'] ?? 'Dosen Universitas') ?>
        </h1>
        <div style="display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap;">
          <span class="badge badge-success" style="font-weight: 700;">
            <span style="display: inline-block; width: 6px; height: 6px; border-radius: 50%; background: currentColor;"></span>
            <?= e($dosen['status_aktivitas'] ?? 'Aktif') ?>
          </span>
          <?php if (!empty($dosen['status_serdos'])): ?>
            <span class="badge badge-info" style="display: inline-flex; align-items: center; gap: 0.3rem;">
              <?= svg_icon('badge-check', '', 13) ?>
              Serdos: <?= e($dosen['status_serdos']) ?>
            </span>
          <?php endif; ?>
          <span style="font-size: 0.85rem; color: var(--text-muted); font-weight: 500; display: inline-flex; align-items: center; gap: 0.35rem;">
            <?= svg_icon('building', '', 14) ?>
            Unit: <strong style="color: var(--slate-800);"><?= e($dosen['penempatan'] ?? 'Fakultas') ?></strong>
          </span>
        </div>
      </div>
    </div>

    <!-- ROLE & ID BADGE -->
    <div class="profile-role-badge-box" style="display: flex; flex-direction: column; align-items: flex-end; gap: 0.5rem;">
      <span class="badge" style="background: var(--primary-subtle); color: var(--primary); font-weight: 700; font-size: 0.8rem; padding: 0.45rem 0.95rem; display: inline-flex; align-items: center; gap: 0.4rem; border: 1px solid rgba(79, 70, 229, 0.2);">
        <?= svg_icon('shield', '', 14) ?>
        Role: DOSEN (Profil Pribadi)
      </span>
      <span class="badge badge-neutral" style="padding: 0.35rem 0.75rem; font-size: 0.775rem; font-family: var(--font-mono);">
        ID Dosen: #<?= e((string)($dosen['id'] ?? '1')) ?>
      </span>
    </div>
  </div>

  <!-- METADATA PEGAWAI (NIP, NUPTK, NO REGISTRASI) -->
  <div class="profile-meta-row" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem; margin-top: 1.5rem; padding: 0.85rem 1.25rem; background: var(--slate-50); border: 1px solid var(--border); border-radius: var(--radius-md);">
    <div style="display: flex; gap: 1.25rem; flex-wrap: wrap; align-items: center;">
      <?php if (!empty($dosen['nip'])): ?>
        <div style="display: flex; align-items: center; gap: 0.4rem; font-size: 0.825rem;">
          <span style="color: var(--text-muted); font-weight: 600;">NIP:</span>
          <span class="code-pill" style="font-weight: 700;"><?= e($dosen['nip']) ?></span>
        </div>
      <?php endif; ?>
      <?php if (!empty($dosen['nuptk'])): ?>
        <div style="display: flex; align-items: center; gap: 0.4rem; font-size: 0.825rem;">
          <span style="color: var(--text-muted); font-weight: 600;">NUPTK:</span>
          <span class="code-pill" style="font-weight: 700;"><?= e($dosen['nuptk']) ?></span>
        </div>
      <?php endif; ?>
      <?php if (!empty($dosen['nomor_registrasi'])): ?>
        <div style="display: flex; align-items: center; gap: 0.4rem; font-size: 0.825rem;">
          <span style="color: var(--text-muted); font-weight: 600;">No. Registrasi:</span>
          <span class="code-pill" style="font-weight: 700;"><?= e($dosen['nomor_registrasi']) ?></span>
        </div>
      <?php endif; ?>
    </div>

    <div style="display: flex; align-items: center; gap: 0.4rem; font-size: 0.825rem; color: var(--text-muted);">
      <?= svg_icon('user', '', 14) ?>
      Status Kepegawaian: <strong style="color: var(--slate-800);"><?= e($dosen['status_pegawai'] ?? 'Dosen Tetap') ?></strong>
    </div>
  </div>
</div>

<!-- INFORMASI DETAIL PROFIL (GRID 2 KOLOM) -->
<div class="profile-cards-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(min(100%, 300px), 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
  <!-- KARTU 1: JABATAN & KEPANGKATAN -->
  <div class="card">
    <div class="card-header">
      <h2 class="card-title">
        <span style="color: var(--primary); display: inline-flex; align-items: center;">
          <?= svg_icon('award', '', 20) ?>
        </span>
        Jabatan Fungsional & Kepangkatan
      </h2>
    </div>
    <div class="card-body">
      <div style="display: flex; flex-direction: column; gap: 1.25rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 0.75rem; border-bottom: 1px solid var(--slate-100);">
          <span style="font-size: 0.85rem; color: var(--text-muted); font-weight: 600;">Jabatan Fungsional</span>
          <span style="font-weight: 700; color: var(--slate-900); font-size: 0.95rem;"><?= e($dosen['jabatan_fungsional'] ?? '-') ?></span>
        </div>
        <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 0.75rem; border-bottom: 1px solid var(--slate-100);">
          <span style="font-size: 0.85rem; color: var(--text-muted); font-weight: 600;">Kepangkatan / Golongan</span>
          <span style="font-weight: 700; color: var(--slate-900); font-size: 0.95rem;"><?= e($dosen['kepangkatan'] ?? '-') ?></span>
        </div>
        <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 0.75rem; border-bottom: 1px solid var(--slate-100);">
          <span style="font-size: 0.85rem; color: var(--text-muted); font-weight: 600;">Sertifikasi Dosen (Serdos)</span>
          <span class="badge badge-success" style="font-weight: 700; font-size: 0.8rem;">
            <?= e($dosen['status_serdos'] ?? 'Belum') ?>
          </span>
        </div>
        <div style="display: flex; justify-content: space-between; align-items: center;">
          <span style="font-size: 0.85rem; color: var(--text-muted); font-weight: 600;">Unit Penempatan</span>
          <span style="font-weight: 600; color: var(--primary); font-size: 0.9rem;"><?= e($dosen['penempatan'] ?? '-') ?></span>
        </div>
      </div>
    </div>
  </div>

  <!-- KARTU 2: PENDIDIKAN & KEILMUAN -->
  <div class="card">
    <div class="card-header">
      <h2 class="card-title">
        <span style="color: var(--emerald-500); display: inline-flex; align-items: center;">
          <?= svg_icon('academic-cap', '', 20) ?>
        </span>
        Pendidikan Terakhir & Keilmuan
      </h2>
    </div>
    <div class="card-body">
      <div style="display: flex; flex-direction: column; gap: 1.25rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 0.75rem; border-bottom: 1px solid var(--slate-100);">
          <span style="font-size: 0.85rem; color: var(--text-muted); font-weight: 600;">Jenjang Pendidikan Terakhir</span>
          <span style="font-weight: 700; color: var(--slate-900); font-size: 0.95rem;"><?= e($dosen['pendidikan_terakhir'] ?? '-') ?></span>
        </div>
        <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 0.75rem; border-bottom: 1px solid var(--slate-100);">
          <span style="font-size: 0.85rem; color: var(--text-muted); font-weight: 600;">Rumpun Bidang Ilmu</span>
          <span style="font-weight: 700; color: var(--slate-900); font-size: 0.95rem;"><?= e($dosen['rumpun_ilmu'] ?? '-') ?></span>
        </div>
        <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 0.75rem; border-bottom: 1px solid var(--slate-100);">
          <span style="font-size: 0.85rem; color: var(--text-muted); font-weight: 600;">Status Kepegawaian</span>
          <span style="font-weight: 600; color: var(--slate-800);"><?= e($dosen['status_pegawai'] ?? 'PNS / Tetap') ?></span>
        </div>
        <div style="display: flex; justify-content: space-between; align-items: center;">
          <span style="font-size: 0.85rem; color: var(--text-muted); font-weight: 600;">Ikatan Kerja</span>
          <span style="font-weight: 600; color: var(--slate-800);"><?= e($dosen['ikatan_kerja'] ?? 'Permanen') ?></span>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- INFORMASI KEAMANAN & SESI SSO -->
<div class="card full-width-card" style="margin-bottom: 2rem;">
  <div class="card-header">
    <h2 class="card-title">
      <span style="color: var(--primary); display: inline-flex; align-items: center;">
        <?= svg_icon('shield', '', 18) ?>
      </span>
      Informasi Autentikasi Single Sign-On (SSO)
    </h2>
    <span class="badge badge-success">Sesi SSO Aktif</span>
  </div>
  <div class="card-body">
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.25rem;">
      <div>
        <label style="font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase;">Username SSO</label>
        <div style="font-size: 0.95rem; font-weight: 700; color: var(--slate-900); margin-top: 0.2rem;">
          <?= e($user['username'] ?? 'dosen') ?>
        </div>
      </div>
      <div>
        <label style="font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase;">Peran Akun (Role)</label>
        <div style="font-size: 0.95rem; font-weight: 700; color: var(--primary); margin-top: 0.2rem;">
          DOSEN (Akses Profil Mandiri)
        </div>
      </div>
      <div>
        <label style="font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase;">Hak Akses Sistem</label>
        <div style="font-size: 0.95rem; font-weight: 600; color: var(--emerald-600); margin-top: 0.2rem;">
          Read-Only (Data Pribadi)
        </div>
      </div>
      <div>
        <label style="font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase;">Penyedia Identitas</label>
        <div style="font-size: 0.95rem; font-weight: 600; color: var(--slate-800); margin-top: 0.2rem;">
          sim-mhs-api SSO Provider
        </div>
      </div>
    </div>
  </div>
</div>

<!-- NOTICE ALERT READ-ONLY -->
<div class="alert alert-warning" style="margin-bottom: 2rem; border-left: 4px solid var(--amber-500);">
  <?= svg_icon('info', '', 24) ?>
  <div>
    <strong>Pemberitahuan Hak Akses Dosen:</strong><br>
    <span>
      Halaman ini menampilkan data profil kepegawaian Anda yang terdaftar di basis data universitas. Sesuai kebijakan tata kelola sistem, akun dengan role <strong>DOSEN</strong> hanya memiliki hak akses untuk melihat data pribadi (<em>Read-Only</em>).
    </span>
    <div style="margin-top: 0.5rem; font-size: 0.825rem; color: var(--slate-700);">
      Apabila Anda menemukan ketidaksesuaian data pada jabatan fungsional, kepangkatan, atau kualifikasi pendidikan, silakan mengajukan permohonan pembaruan data ke <strong>Biro Administrasi Akademik & Kepegawaian (BAAK)</strong>.
    </div>
  </div>
</div>
