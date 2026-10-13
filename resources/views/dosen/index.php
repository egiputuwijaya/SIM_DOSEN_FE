<!-- TOP HEADER BAR: KELOLA DATA DOSEN -->
<div class="page-header-bar">
  <div>
    <div style="display: flex; align-items: center; gap: 0.75rem;">
      <h1 class="page-title">
        Kelola Data Dosen
      </h1>
      <span class="badge badge-primary-subtle" style="font-weight: 700; font-size: 0.8rem; padding: 0.25rem 0.75rem;">
        <?= count($dosenList) ?> Data Dosen
      </span>
    </div>
    <p class="page-subtitle">
      Kelola data pengajar, jabatan fungsional, kepangkatan, dan status kepegawaian dosen universitas.
    </p>
  </div>

  <div style="display: flex; align-items: center; gap: 0.75rem;">
    <?php if (can_write()): ?>
      <a href="<?= url('/dosen/create') ?>" class="btn btn-primary" style="box-shadow: 0 4px 12px rgba(79, 70, 229, 0.35);">
        <?= svg_icon('user-plus', '', 18) ?>
        Tambah Dosen Baru
      </a>
    <?php else: ?>
      <span class="badge badge-warning" style="padding: 0.5rem 0.9rem; font-size: 0.8rem; display: inline-flex; align-items: center; gap: 0.4rem;">
        <?= svg_icon('shield', '', 14) ?>
        Mode Baca Saja (Role: <?= e(auth_user()['role'] ?? 'USER') ?>)
      </span>
    <?php endif; ?>
  </div>
</div>

<!-- API ERROR NOTIFICATION JIKA KENDALA KONEKSI -->
<?php if (!empty($apiError)): ?>
  <div class="alert alert-warning" style="margin-bottom: 1.5rem;">
    <?= svg_icon('alert-triangle', '', 22) ?>
    <div>
      <strong>Perhatian: Kendala Koneksi ke Backend API</strong><br>
      <span><?= e($apiError) ?></span>
    </div>
  </div>
<?php endif; ?>

<!-- CARD UTAMA: FILTER & TABEL PENUH LAYAR -->
<div class="card full-width-card">
  <!-- TOOLBAR PENCARIAN & FILTER -->
  <div class="card-header filter-toolbar">
    <div style="display: flex; align-items: center; gap: 0.6rem;">
      <span style="color: var(--primary); display: inline-flex; align-items: center;">
        <?= svg_icon('users', '', 20) ?>
      </span>
      <strong style="font-size: 1rem; color: var(--slate-900);">Daftar Pengajar</strong>
    </div>

    <form action="<?= url('/dosen') ?>" method="GET" class="filter-controls">
      <div class="search-input-box">
        <span class="search-icon-prefix">
          <?= svg_icon('search', '', 15) ?>
        </span>
        <input
          type="text"
          name="q"
          class="form-control search-input"
          placeholder="Cari nama, NIP, NUPTK, prodi..."
          value="<?= e($keyword) ?>"
        >
      </div>

      <select name="status" class="form-control select-filter" onchange="this.form.submit()">
        <option value="">Semua Status Aktivitas</option>
        <option value="Aktif" <?= $filterStatus === 'Aktif' ? 'selected' : '' ?>>Aktif</option>
        <option value="Cuti" <?= $filterStatus === 'Cuti' ? 'selected' : '' ?>>Cuti</option>
        <option value="Tugas Belajar" <?= $filterStatus === 'Tugas Belajar' ? 'selected' : '' ?>>Tugas Belajar</option>
        <option value="Keluar" <?= $filterStatus === 'Keluar' ? 'selected' : '' ?>>Keluar</option>
      </select>

      <select name="ikatan" class="form-control select-filter" onchange="this.form.submit()">
        <option value="">Semua Ikatan Kerja</option>
        <option value="Dosen Tetap" <?= $filterIkatan === 'Dosen Tetap' ? 'selected' : '' ?>>Dosen Tetap</option>
        <option value="Dosen Tidak Tetap" <?= $filterIkatan === 'Dosen Tidak Tetap' ? 'selected' : '' ?>>Dosen Tidak Tetap</option>
        <option value="Dosen Luar Biasa" <?= $filterIkatan === 'Dosen Luar Biasa' ? 'selected' : '' ?>>Dosen Luar Biasa</option>
      </select>

      <button type="submit" class="btn btn-secondary btn-sm" style="display: inline-flex; align-items: center; gap: 0.35rem; height: 38px;">
        <?= svg_icon('filter', '', 14) ?>
        Filter
      </button>

      <?php if (!empty($keyword) || !empty($filterStatus) || !empty($filterIkatan)): ?>
        <a href="<?= url('/dosen') ?>" class="btn btn-secondary btn-sm" title="Reset filter" style="display: inline-flex; align-items: center; gap: 0.35rem; height: 38px;">
          <?= svg_icon('refresh', '', 13) ?>
          Reset
        </a>
      <?php endif; ?>
    </form>
  </div>

  <!-- TABEL DATA DOSEN FULL WIDTH -->
  <div class="table-responsive">
    <table class="data-table">
      <thead>
        <tr>
          <th style="width: 55px; text-align: center;">#</th>
          <th>Dosen & Identitas Kepegawaian</th>
          <th>Jabatan Fungsional & Pangkat</th>
          <th>Pendidikan & Bidang Keilmuan</th>
          <th>Ikatan Kerja & Serdos</th>
          <th>Status Aktivitas</th>
          <th style="text-align: right; width: 140px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($dosenList)): ?>
          <tr>
            <td colspan="7" style="text-align: center; padding: 4rem 1rem;">
              <div style="width: 60px; height: 60px; margin: 0 auto 1rem; border-radius: 50%; background: var(--slate-100); color: var(--slate-400); display: flex; align-items: center; justify-content: center;">
                <?= svg_icon('search', '', 30) ?>
              </div>
              <div style="font-weight: 700; color: var(--slate-800); font-size: 1.1rem;">Tidak ada data dosen yang sesuai</div>
              <p style="font-size: 0.85rem; color: var(--text-muted); margin-top: 0.25rem;">
                Cobalah mengubah kata kunci pencarian atau reset filter di atas.
              </p>
              <?php if (can_write()): ?>
                <a href="<?= url('/dosen/create') ?>" class="btn btn-primary btn-sm" style="margin-top: 1rem; display: inline-flex; align-items: center; gap: 0.4rem;">
                  <?= svg_icon('plus', '', 16) ?>
                  Tambah Dosen Sekarang
                </a>
              <?php endif; ?>
            </td>
          </tr>
        <?php else: ?>
          <?php foreach ($dosenList as $idx => $d): ?>
            <tr>
              <td style="text-align: center;">
                <span style="font-family: var(--font-mono); font-size: 0.775rem; color: var(--slate-400); font-weight: 600;">
                  <?= e((string)($d['id'] ?? ($idx + 1))) ?>
                </span>
              </td>
              <td>
                <div style="display: flex; align-items: flex-start; gap: 0.85rem;">
                  <div class="lecturer-avatar">
                    <?= strtoupper(substr($d['nama'] ?? 'D', 0, 1)) ?>
                  </div>
                  <div>
                    <div style="font-weight: 700; color: var(--slate-900); font-size: 0.95rem;">
                      <?= e($d['nama'] ?? '-') ?>
                    </div>
                    <div style="display: flex; gap: 0.4rem; font-size: 0.73rem; color: var(--text-muted); margin-top: 0.25rem; font-family: var(--font-mono); flex-wrap: wrap;">
                      <?php if (!empty($d['nip'])): ?>
                        <span class="code-pill">NIP: <?= e($d['nip']) ?></span>
                      <?php endif; ?>
                      <?php if (!empty($d['nuptk'])): ?>
                        <span class="code-pill">NUPTK: <?= e($d['nuptk']) ?></span>
                      <?php endif; ?>
                      <?php if (!empty($d['nomor_registrasi'])): ?>
                        <span class="code-pill">REG: <?= e($d['nomor_registrasi']) ?></span>
                      <?php endif; ?>
                    </div>
                    <?php if (!empty($d['penempatan'])): ?>
                      <div style="font-size: 0.75rem; color: var(--primary); font-weight: 500; margin-top: 0.25rem; display: flex; align-items: center; gap: 0.3rem;">
                        <?= svg_icon('map-pin', '', 13) ?>
                        <span><?= e($d['penempatan']) ?></span>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </td>
              <td>
                <div style="font-weight: 600; color: var(--slate-800); font-size: 0.9rem;">
                  <?= e($d['jabatan_fungsional'] ?? '-') ?>
                </div>
                <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 0.15rem;">
                  <?= e($d['kepangkatan'] ?? '-') ?>
                </div>
              </td>
              <td>
                <div style="font-weight: 600; color: var(--slate-800); font-size: 0.9rem;">
                  <?= e($d['pendidikan_terakhir'] ?? '-') ?>
                </div>
                <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 0.15rem;">
                  <?= e($d['rumpun_ilmu'] ?? '-') ?>
                </div>
              </td>
              <td>
                <div style="font-weight: 500; color: var(--slate-700); font-size: 0.875rem;">
                  <?= e($d['ikatan_kerja'] ?? '-') ?>
                </div>
                <?php if (!empty($d['status_serdos'])): ?>
                  <?php $isLulus = strtolower($d['status_serdos']) === 'tersertifikasi' || strtolower($d['status_serdos']) === 'lulus'; ?>
                  <span class="badge <?= $isLulus ? 'badge-success' : 'badge-neutral' ?>" style="margin-top: 0.25rem; display: inline-flex; align-items: center; gap: 0.25rem;">
                    <?php if ($isLulus): ?>
                      <?= svg_icon('badge-check', '', 11) ?>
                    <?php endif; ?>
                    <?= e($d['status_serdos']) ?>
                  </span>
                <?php endif; ?>
              </td>
              <td>
                <?php
                  $st = strtolower($d['status_aktivitas'] ?? '');
                  $badgeClass = match ($st) {
                    'aktif' => 'badge-success',
                    'cuti' => 'badge-warning',
                    default => 'badge-neutral',
                  };
                ?>
                <span class="badge <?= $badgeClass ?>" style="display: inline-flex; align-items: center; gap: 0.35rem;">
                  <span style="display: inline-block; width: 6px; height: 6px; border-radius: 50%; background: currentColor;"></span>
                  <?= e($d['status_aktivitas'] ?? 'Belum Diatur') ?>
                </span>
              </td>
              <td style="text-align: right;">
                <div class="action-btn-group">
                  <!-- Tombol Quick Detail -->
                  <button
                    type="button"
                    class="btn btn-secondary btn-icon"
                    title="Lihat Detail Profil"
                    onclick='viewDosenDetail(<?= json_encode($d, JSON_HEX_APOS | JSON_HEX_QUOT) ?>)'
                    aria-label="Detail"
                  >
                    <?= svg_icon('eye', 'action-svg', 16) ?>
                  </button>

                  <?php if (can_write()): ?>
                    <!-- Tombol Edit -->
                    <a
                      href="<?= url('/dosen/' . e((string)$d['id']) . '/edit') ?>"
                      class="btn btn-secondary btn-icon"
                      title="Edit Data Dosen"
                      aria-label="Edit"
                    >
                      <?= svg_icon('edit', 'action-svg', 16) ?>
                    </a>

                    <!-- Tombol Hapus -->
                    <button
                      type="button"
                      class="btn btn-secondary btn-icon btn-icon-danger"
                      title="Hapus Data Dosen"
                      onclick="confirmDelete('<?= e((string)$d['id']) ?>', '<?= e(addslashes($d['nama'] ?? '')) ?>')"
                      aria-label="Hapus"
                    >
                      <?= svg_icon('trash', 'action-svg', 16) ?>
                    </button>
                  <?php endif; ?>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <!-- FOOTER TABEL -->
  <div class="card-footer" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.5rem; font-size: 0.8rem; color: var(--text-muted);">
    <div>
      Total Dosen Terdaftar: <strong><?= count($dosenList) ?></strong> dari total sistem
    </div>
    <div>
      SIM Dosen Enterprise &bull; Native PHP MVC
    </div>
  </div>
</div>
