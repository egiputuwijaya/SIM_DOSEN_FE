<?php
$user = auth_user() ?? [];
$isAdmin = can_write();
?>

<!-- WELCOME HERO BANNER -->
<div class="dashboard-hero">
  <div class="hero-content">
    <div class="hero-badge">
      <span class="live-pulse-dot"></span>
      <span>SIM Dosen Enterprise &bull; Sistem Terhubung</span>
    </div>
    <h1 class="hero-title">
      Selamat Datang, <?= e($user['nama'] ?? 'Administrator') ?>!
    </h1>
    <p class="hero-subtitle">
      Pantau ringkasan statistik kepegawaian dosen, sebaran jabatan fungsional, dan status sertifikasi dosen secara real-time.
    </p>
  </div>

  <div class="hero-actions">
    <a href="<?= url('/dosen') ?>" class="btn btn-secondary" style="background: rgba(255,255,255,0.95); font-weight: 700;">
      <?= svg_icon('users', '', 18) ?>
      Kelola Data Dosen
    </a>
    <?php if ($isAdmin): ?>
      <a href="<?= url('/dosen/create') ?>" class="btn btn-primary" style="box-shadow: 0 4px 14px rgba(79, 70, 229, 0.4);">
        <?= svg_icon('user-plus', '', 18) ?>
        Tambah Dosen Baru
      </a>
    <?php endif; ?>
  </div>
</div>

<!-- API ERROR NOTIFICATION JIKA ADA -->
<?php if (!empty($apiError)): ?>
  <div class="alert alert-warning" style="margin-bottom: 2rem;">
    <?= svg_icon('alert-triangle', '', 22) ?>
    <div>
      <strong>Perhatian: Kendala Koneksi ke Backend API</strong><br>
      <span><?= e($apiError) ?></span>
    </div>
  </div>
<?php endif; ?>

<!-- 4 WIDE METRIC CARDS -->
<div class="stats-grid">
  <div class="stat-card">
    <div class="stat-header">
      <div class="stat-icon-wrapper indigo">
        <?= svg_icon('users', 'stat-svg', 22) ?>
      </div>
      <span class="stat-trend trend-indigo">Total Pengajar</span>
    </div>
    <div class="stat-body">
      <div class="stat-value"><?= e((string)$total) ?></div>
      <div class="stat-label">Total Dosen Terdaftar</div>
    </div>
  </div>

  <div class="stat-card">
    <div class="stat-header">
      <div class="stat-icon-wrapper emerald">
        <?= svg_icon('check-circle', 'stat-svg', 22) ?>
      </div>
      <span class="stat-trend trend-emerald">Status Siap Ajar</span>
    </div>
    <div class="stat-body">
      <div class="stat-value"><?= e((string)$aktif) ?></div>
      <div class="stat-label">Dosen Status Aktif</div>
    </div>
  </div>

  <div class="stat-card">
    <div class="stat-header">
      <div class="stat-icon-wrapper amber">
        <?= svg_icon('building', 'stat-svg', 22) ?>
      </div>
      <span class="stat-trend trend-amber">Homebase Tetap</span>
    </div>
    <div class="stat-body">
      <div class="stat-value"><?= e((string)$tetap) ?></div>
      <div class="stat-label">Ikatan Dosen Tetap</div>
    </div>
  </div>

  <div class="stat-card">
    <div class="stat-header">
      <div class="stat-icon-wrapper sky">
        <?= svg_icon('award', 'stat-svg', 22) ?>
      </div>
      <span class="stat-trend trend-sky">Lulus Sertifikasi</span>
    </div>
    <div class="stat-body">
      <div class="stat-value"><?= e((string)$serdos) ?></div>
      <div class="stat-label">Tersertifikasi (Serdos)</div>
    </div>
  </div>
</div>

<!-- ANALYTICS CARDS (2 KOLOM LUAS) -->
<div class="analytics-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(min(100%, 320px), 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
  <!-- KARTU 1: JABATAN FUNGSIONAL -->
  <div class="card">
    <div class="card-header">
      <h2 class="card-title">
        <span style="color: var(--primary); display: inline-flex; align-items: center;">
          <?= svg_icon('award', '', 20) ?>
        </span>
        Sebaran Jabatan Fungsional
      </h2>
      <span class="badge badge-neutral"><?= e((string)$total) ?> Dosen</span>
    </div>
    <div class="card-body" style="display: flex; flex-direction: column; gap: 1.1rem;">
      <?php foreach ($jabatanCounts as $jabatan => $count): ?>
        <?php $pct = $total > 0 ? round(($count / $total) * 100) : 0; ?>
        <div>
          <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.35rem; font-size: 0.85rem;">
            <span style="font-weight: 600; color: var(--slate-800);"><?= e($jabatan) ?></span>
            <span style="font-weight: 700; color: var(--slate-900); font-family: var(--font-mono);">
              <?= $count ?> <span style="font-weight: 400; color: var(--text-muted); font-size: 0.75rem;">(<?= $pct ?>%)</span>
            </span>
          </div>
          <div class="progress-bar-track">
            <div class="progress-bar-fill indigo" style="width: <?= max($pct, 2) ?>%;"></div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- KARTU 2: PENDIDIKAN TERAKHIR & AKTIVITAS -->
  <div class="card">
    <div class="card-header">
      <h2 class="card-title">
        <span style="color: var(--emerald-500); display: inline-flex; align-items: center;">
          <?= svg_icon('academic-cap', '', 20) ?>
        </span>
        Kualifikasi Pendidikan & Status
      </h2>
      <span class="badge badge-success"><?= e((string)$aktif) ?> Aktif Mengajar</span>
    </div>
    <div class="card-body">
      <div style="font-size: 0.8rem; font-weight: 700; color: var(--slate-400); text-transform: uppercase; letter-spacing: 0.04em; margin-bottom: 0.75rem;">
        Kualifikasi Ijazah Terakhir
      </div>
      <div style="display: flex; flex-direction: column; gap: 1.1rem; margin-bottom: 1.5rem;">
        <?php foreach ($pendidikanCounts as $jenjang => $count): ?>
          <?php $pct = $total > 0 ? round(($count / $total) * 100) : 0; ?>
          <div>
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.35rem; font-size: 0.85rem;">
              <span style="font-weight: 600; color: var(--slate-800);"><?= e($jenjang) ?></span>
              <span style="font-weight: 700; color: var(--slate-900); font-family: var(--font-mono);">
                <?= $count ?> <span style="font-weight: 400; color: var(--text-muted); font-size: 0.75rem;">(<?= $pct ?>%)</span>
              </span>
            </div>
            <div class="progress-bar-track">
              <div class="progress-bar-fill emerald" style="width: <?= max($pct, 2) ?>%;"></div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <div style="font-size: 0.8rem; font-weight: 700; color: var(--slate-400); text-transform: uppercase; letter-spacing: 0.04em; margin-bottom: 0.75rem;">
        Distribusi Status Keaktifan
      </div>
      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(75px, 1fr)); gap: 0.75rem;">
        <div style="background: var(--emerald-50); border: 1px solid #a7f3d0; border-radius: var(--radius-md); padding: 0.75rem; text-align: center;">
          <div style="font-size: 1.3rem; font-weight: 800; color: var(--emerald-700);"><?= $aktif ?></div>
          <div style="font-size: 0.725rem; font-weight: 600; color: var(--emerald-700);">Aktif</div>
        </div>
        <div style="background: var(--amber-50); border: 1px solid #fde68a; border-radius: var(--radius-md); padding: 0.75rem; text-align: center;">
          <div style="font-size: 1.3rem; font-weight: 800; color: var(--amber-700);"><?= $cuti ?></div>
          <div style="font-size: 0.725rem; font-weight: 600; color: var(--amber-700);">Cuti</div>
        </div>
        <div style="background: var(--sky-50); border: 1px solid #bae6fd; border-radius: var(--radius-md); padding: 0.75rem; text-align: center;">
          <div style="font-size: 1.3rem; font-weight: 800; color: var(--sky-700);"><?= $tugasBelajar ?></div>
          <div style="font-size: 0.725rem; font-weight: 600; color: var(--sky-700);">Tugas Belajar</div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- RINGKASAN DOSEN TERBARU -->
<div class="card">
  <div class="card-header" style="justify-content: space-between; flex-wrap: wrap; gap: 0.75rem;">
    <h2 class="card-title">
      <span style="color: var(--primary); display: inline-flex; align-items: center;">
        <?= svg_icon('users', '', 20) ?>
      </span>
      Ringkasan Data Dosen Terbaru
    </h2>
    <a href="<?= url('/dosen') ?>" class="btn btn-primary btn-sm" style="display: inline-flex; align-items: center; gap: 0.4rem;">
      <span>Buka Kelola Data Dosen Penuh</span>
      <?= svg_icon('arrow-right', '', 14) ?>
    </a>
  </div>

  <div class="table-responsive">
    <table class="data-table">
      <thead>
        <tr>
          <th style="width: 50px;">#</th>
          <th>Dosen & Identitas</th>
          <th>Jabatan Fungsional</th>
          <th>Pendidikan Terakhir</th>
          <th>Ikatan Kerja</th>
          <th>Status</th>
          <th style="text-align: right;">Aksi Cepat</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($recentDosen)): ?>
          <tr>
            <td colspan="7" style="text-align: center; padding: 2rem; color: var(--text-muted);">
              Belum ada data dosen terdaftar di sistem.
            </td>
          </tr>
        <?php else: ?>
          <?php foreach ($recentDosen as $idx => $d): ?>
            <tr>
              <td>
                <span style="font-family: var(--font-mono); font-size: 0.775rem; color: var(--slate-400); font-weight: 600;">
                  <?= e((string)($d['id'] ?? ($idx + 1))) ?>
                </span>
              </td>
              <td>
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                  <div class="lecturer-avatar">
                    <?= strtoupper(substr($d['nama'] ?? 'D', 0, 1)) ?>
                  </div>
                  <div>
                    <div style="font-weight: 700; color: var(--slate-900); font-size: 0.925rem;">
                      <?= e($d['nama'] ?? '-') ?>
                    </div>
                    <div style="font-size: 0.75rem; color: var(--text-muted); font-family: var(--font-mono);">
                      <?= !empty($d['nip']) ? 'NIP: ' . e($d['nip']) : (!empty($d['nuptk']) ? 'NUPTK: ' . e($d['nuptk']) : '-') ?>
                    </div>
                  </div>
                </div>
              </td>
              <td>
                <div style="font-weight: 600; color: var(--slate-800);"><?= e($d['jabatan_fungsional'] ?? '-') ?></div>
              </td>
              <td>
                <div style="font-weight: 600; color: var(--slate-800);"><?= e($d['pendidikan_terakhir'] ?? '-') ?></div>
              </td>
              <td>
                <div style="font-weight: 500; color: var(--slate-700);"><?= e($d['ikatan_kerja'] ?? '-') ?></div>
              </td>
              <td>
                <span class="badge <?= strtolower($d['status_aktivitas'] ?? '') === 'aktif' ? 'badge-success' : 'badge-neutral' ?>">
                  ● <?= e($d['status_aktivitas'] ?? 'Belum Diatur') ?>
                </span>
              </td>
              <td style="text-align: right;">
                <a href="<?= url('/dosen') ?>" class="btn btn-secondary btn-sm" style="font-size: 0.775rem; padding: 0.25rem 0.65rem;">
                  Kelola di Tabel &rarr;
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
