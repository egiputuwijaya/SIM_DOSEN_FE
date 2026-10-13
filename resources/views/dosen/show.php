<div style="max-width: 800px; margin: 0 auto;">
  <div style="margin-bottom: 1.5rem;">
    <a href="<?= url('/dosen') ?>" style="display: inline-flex; align-items: center; gap: 0.4rem; color: var(--text-muted); text-decoration: none; font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem;" class="nav-back-link">
      <?= svg_icon('arrow-left', '', 15) ?>
      Kembali ke Daftar Dosen
    </a>
    <h1 style="font-size: 1.6rem; font-weight: 800; color: var(--slate-900);">
      Detail Profil Dosen
    </h1>
  </div>

  <div class="card">
    <div class="card-header" style="flex-wrap: wrap; gap: 0.75rem; justify-content: space-between;">
      <div style="display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;">
        <div style="width: 52px; height: 52px; border-radius: 12px; background: var(--primary-subtle); color: var(--primary); font-size: 1.5rem; font-weight: 800; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
          <?= strtoupper(substr($dosen['nama'] ?? 'D', 0, 1)) ?>
        </div>
        <div>
          <h2 style="font-size: 1.25rem; font-weight: 800; color: var(--slate-900);">
            <?= e($dosen['nama'] ?? '-') ?>
          </h2>
          <div style="font-size: 0.825rem; color: var(--text-muted);">
            ID Sistem: #<?= e((string)$dosen['id']) ?> &bull; No. Reg: <?= e($dosen['nomor_registrasi'] ?? '-') ?>
          </div>
        </div>
      </div>

      <?php if (can_write()): ?>
        <a href="<?= url('/dosen/' . e((string)$dosen['id']) . '/edit') ?>" class="btn btn-secondary btn-sm" style="display: inline-flex; align-items: center; gap: 0.4rem;">
          <?= svg_icon('edit', '', 15) ?>
          Edit Data
        </a>
      <?php endif; ?>
    </div>

    <div class="card-body">
      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(min(100%, 240px), 1fr)); gap: 1.5rem;">
        <div>
          <label style="font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase;">NIP</label>
          <div style="font-size: 0.95rem; font-weight: 600; font-family: var(--font-mono); color: var(--slate-900);">
            <?= e($dosen['nip'] ?? '-') ?>
          </div>
        </div>

        <div>
          <label style="font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase;">NUPTK</label>
          <div style="font-size: 0.95rem; font-weight: 600; font-family: var(--font-mono); color: var(--slate-900);">
            <?= e($dosen['nuptk'] ?? '-') ?>
          </div>
        </div>

        <div>
          <label style="font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase;">Jabatan Fungsional</label>
          <div style="font-size: 0.95rem; font-weight: 600; color: var(--slate-900);">
            <?= e($dosen['jabatan_fungsional'] ?? '-') ?>
          </div>
        </div>

        <div>
          <label style="font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase;">Kepangkatan / Golongan</label>
          <div style="font-size: 0.95rem; font-weight: 600; color: var(--slate-900);">
            <?= e($dosen['kepangkatan'] ?? '-') ?>
          </div>
        </div>

        <div>
          <label style="font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase;">Pendidikan Terakhir</label>
          <div style="font-size: 0.95rem; font-weight: 600; color: var(--slate-900);">
            <?= e($dosen['pendidikan_terakhir'] ?? '-') ?>
          </div>
        </div>

        <div>
          <label style="font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase;">Rumpun Ilmu</label>
          <div style="font-size: 0.95rem; font-weight: 600; color: var(--slate-900);">
            <?= e($dosen['rumpun_ilmu'] ?? '-') ?>
          </div>
        </div>

        <div>
          <label style="font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase;">Status Serdos</label>
          <div style="font-size: 0.95rem; font-weight: 600; color: var(--slate-900);">
            <?= e($dosen['status_serdos'] ?? '-') ?>
          </div>
        </div>

        <div>
          <label style="font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase;">Status Pegawai</label>
          <div style="font-size: 0.95rem; font-weight: 600; color: var(--slate-900);">
            <?= e($dosen['status_pegawai'] ?? '-') ?>
          </div>
        </div>

        <div>
          <label style="font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase;">Ikatan Kerja</label>
          <div style="font-size: 0.95rem; font-weight: 600; color: var(--slate-900);">
            <?= e($dosen['ikatan_kerja'] ?? '-') ?>
          </div>
        </div>

        <div>
          <label style="font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase;">Status Aktivitas</label>
          <div style="margin-top: 0.2rem;">
            <span class="badge <?= strtolower($dosen['status_aktivitas'] ?? '') === 'aktif' ? 'badge-success' : 'badge-neutral' ?>">
              ● <?= e($dosen['status_aktivitas'] ?? 'Belum Diatur') ?>
            </span>
          </div>
        </div>

        <div style="grid-column: 1 / -1;">
          <label style="font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase;">Unit Penempatan</label>
          <div style="font-size: 0.95rem; font-weight: 600; color: var(--slate-900); display: flex; align-items: center; gap: 0.35rem; margin-top: 0.2rem;">
            <?= svg_icon('map-pin', '', 14) ?>
            <span><?= e($dosen['penempatan'] ?? '-') ?></span>
          </div>
        </div>
      </div>
    </div>

    <div class="card-footer" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 0.75rem;">
      <a href="<?= url('/dosen') ?>" class="btn btn-secondary" style="display: inline-flex; align-items: center; gap: 0.4rem;">
        <?= svg_icon('arrow-left', '', 14) ?>
        Kembali
      </a>

      <?php if (can_write()): ?>
        <button
          type="button"
          class="btn btn-danger btn-sm"
          style="display: inline-flex; align-items: center; gap: 0.4rem;"
          onclick="confirmDelete('<?= e((string)$dosen['id']) ?>', '<?= e(addslashes($dosen['nama'] ?? '')) ?>')"
        >
          <?= svg_icon('trash', '', 15) ?>
          Hapus Dosen
        </button>
      <?php endif; ?>
    </div>
  </div>
</div>
