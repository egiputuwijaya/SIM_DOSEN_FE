<?php
$errors = get_flash('validation_errors', []);
$val = function ($key) use ($dosen) {
    return old($key, $dosen[$key] ?? '');
};
?>

<div style="max-width: 900px; margin: 0 auto;">
  <!-- BREADCRUMB & HEADING -->
  <div style="margin-bottom: 1.5rem;">
    <a href="<?= url('/dosen') ?>" style="display: inline-flex; align-items: center; gap: 0.4rem; color: var(--text-muted); text-decoration: none; font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem;" class="nav-back-link">
      <?= svg_icon('arrow-left', '', 15) ?>
      Kembali ke Daftar Dosen
    </a>
    <h1 style="font-size: 1.6rem; font-weight: 800; color: var(--slate-900);">
      Edit Data Dosen: <?= e($dosen['nama'] ?? '') ?>
    </h1>
    <p style="color: var(--text-muted); font-size: 0.85rem;">
      Perbarui informasi data dosen (ID: <code style="font-family: var(--font-mono); font-weight: 700;">#<?= e((string)$dosen['id']) ?></code>).
    </p>
  </div>

  <div class="card">
    <div class="card-header" style="flex-wrap: wrap; gap: 0.75rem; justify-content: space-between;">
      <h2 class="card-title" style="display: flex; align-items: center; gap: 0.5rem;">
        <span style="color: var(--primary); display: inline-flex; align-items: center;">
          <?= svg_icon('edit', '', 18) ?>
        </span>
        Formulir Pembaruan Data
      </h2>
      <span class="badge badge-info" style="display: inline-flex; align-items: center; gap: 0.35rem;">
        <?= svg_icon('shield', '', 12) ?>
        Role Akses: <?= e(auth_user()['role'] ?? 'ADMIN') ?>
      </span>
    </div>

    <form action="<?= url('/dosen/' . e((string)$dosen['id'])) ?>" method="POST">
      <?= method_field('PUT') ?>

      <div class="card-body">
        <div class="form-grid">
          <!-- NAMA LENGKAP -->
          <div class="form-group col-span-full">
            <label class="form-label" for="nama">
              Nama Lengkap Beserta Gelar <span class="required">*</span>
            </label>
            <input
              type="text"
              id="nama"
              name="nama"
              class="form-control <?= isset($errors['nama']) ? 'is-invalid' : '' ?>"
              placeholder="Contoh: Dr. Ir. Budi Rahardjo, M.Kom."
              value="<?= e($val('nama')) ?>"
              maxlength="150"
              required
            >
            <?php if (isset($errors['nama'])): ?>
              <span class="invalid-feedback"><?= e($errors['nama']) ?></span>
            <?php endif; ?>
          </div>

          <!-- NOMOR REGISTRASI & NUPTK -->
          <div class="form-group">
            <label class="form-label" for="nomor_registrasi">Nomor Registrasi (Unik)</label>
            <input
              type="text"
              id="nomor_registrasi"
              name="nomor_registrasi"
              class="form-control <?= isset($errors['nomor_registrasi']) ? 'is-invalid' : '' ?>"
              placeholder="Contoh: REG-2026-0012"
              value="<?= e($val('nomor_registrasi')) ?>"
              maxlength="50"
            >
            <?php if (isset($errors['nomor_registrasi'])): ?>
              <span class="invalid-feedback"><?= e($errors['nomor_registrasi']) ?></span>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label class="form-label" for="nuptk">NUPTK</label>
            <input
              type="text"
              id="nuptk"
              name="nuptk"
              class="form-control <?= isset($errors['nuptk']) ? 'is-invalid' : '' ?>"
              placeholder="Nomor Unik Pendidik dan Tenaga Kependidikan"
              value="<?= e($val('nuptk')) ?>"
              maxlength="30"
            >
            <?php if (isset($errors['nuptk'])): ?>
              <span class="invalid-feedback"><?= e($errors['nuptk']) ?></span>
            <?php endif; ?>
          </div>

          <!-- NIP & PENDIDIKAN TERAKHIR -->
          <div class="form-group">
            <label class="form-label" for="nip">NIP</label>
            <input
              type="text"
              id="nip"
              name="nip"
              class="form-control <?= isset($errors['nip']) ? 'is-invalid' : '' ?>"
              placeholder="Nomor Induk Pegawai"
              value="<?= e($val('nip')) ?>"
              maxlength="30"
            >
            <?php if (isset($errors['nip'])): ?>
              <span class="invalid-feedback"><?= e($errors['nip']) ?></span>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label class="form-label" for="pendidikan_terakhir">Pendidikan Terakhir</label>
            <input
              type="text"
              id="pendidikan_terakhir"
              name="pendidikan_terakhir"
              class="form-control"
              placeholder="Contoh: S3 Ilmu Komputer"
              value="<?= e($val('pendidikan_terakhir')) ?>"
              maxlength="100"
            >
          </div>

          <!-- JABATAN FUNGSIONAL & KEPANGKATAN -->
          <div class="form-group">
            <label class="form-label" for="jabatan_fungsional">Jabatan Fungsional</label>
            <select id="jabatan_fungsional" name="jabatan_fungsional" class="form-control">
              <option value="">-- Pilih Jabatan Fungsional --</option>
              <?php foreach (['Tenaga Pengajar', 'Asisten Ahli', 'Lektor', 'Lektor Kepala', 'Guru Besar'] as $jf): ?>
                <option value="<?= $jf ?>" <?= $val('jabatan_fungsional') === $jf ? 'selected' : '' ?>><?= $jf ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label class="form-label" for="kepangkatan">Kepangkatan / Golongan</label>
            <input
              type="text"
              id="kepangkatan"
              name="kepangkatan"
              class="form-control"
              placeholder="Contoh: Pembina Tk. I / IV b"
              value="<?= e($val('kepangkatan')) ?>"
              maxlength="100"
            >
          </div>

          <!-- RUMPUN ILMU & PENEMPATAN -->
          <div class="form-group">
            <label class="form-label" for="rumpun_ilmu">Rumpun Ilmu</label>
            <input
              type="text"
              id="rumpun_ilmu"
              name="rumpun_ilmu"
              class="form-control"
              placeholder="Contoh: Rekayasa Perangkat Lunak"
              value="<?= e($val('rumpun_ilmu')) ?>"
              maxlength="150"
            >
          </div>

          <div class="form-group">
            <label class="form-label" for="penempatan">Unit Penempatan / Prodi</label>
            <input
              type="text"
              id="penempatan"
              name="penempatan"
              class="form-control"
              placeholder="Contoh: Program Studi Teknik Informatika"
              value="<?= e($val('penempatan')) ?>"
              maxlength="150"
            >
          </div>

          <!-- STATUS SERDOS, PEGAWAI, IKATAN KERJA, AKTIVITAS -->
          <div class="form-group">
            <label class="form-label" for="status_serdos">Sertifikasi Dosen (Serdos)</label>
            <select id="status_serdos" name="status_serdos" class="form-control">
              <option value="">-- Pilih Status --</option>
              <option value="Tersertifikasi" <?= $val('status_serdos') === 'Tersertifikasi' ? 'selected' : '' ?>>Tersertifikasi</option>
              <option value="Belum Tersertifikasi" <?= $val('status_serdos') === 'Belum Tersertifikasi' ? 'selected' : '' ?>>Belum Tersertifikasi</option>
            </select>
          </div>

          <div class="form-group">
            <label class="form-label" for="status_pegawai">Status Pegawai</label>
            <select id="status_pegawai" name="status_pegawai" class="form-control">
              <option value="">-- Pilih Status Pegawai --</option>
              <option value="PNS" <?= $val('status_pegawai') === 'PNS' ? 'selected' : '' ?>>PNS</option>
              <option value="PPPK" <?= $val('status_pegawai') === 'PPPK' ? 'selected' : '' ?>>PPPK</option>
              <option value="Non-PNS" <?= $val('status_pegawai') === 'Non-PNS' ? 'selected' : '' ?>>Non-PNS</option>
            </select>
          </div>

          <div class="form-group">
            <label class="form-label" for="ikatan_kerja">Ikatan Kerja</label>
            <select id="ikatan_kerja" name="ikatan_kerja" class="form-control">
              <option value="">-- Pilih Ikatan Kerja --</option>
              <option value="Dosen Tetap" <?= $val('ikatan_kerja') === 'Dosen Tetap' ? 'selected' : '' ?>>Dosen Tetap</option>
              <option value="Dosen Tidak Tetap" <?= $val('ikatan_kerja') === 'Dosen Tidak Tetap' ? 'selected' : '' ?>>Dosen Tidak Tetap</option>
              <option value="Dosen Luar Biasa" <?= $val('ikatan_kerja') === 'Dosen Luar Biasa' ? 'selected' : '' ?>>Dosen Luar Biasa</option>
            </select>
          </div>

          <div class="form-group">
            <label class="form-label" for="status_aktivitas">Status Aktivitas</label>
            <select id="status_aktivitas" name="status_aktivitas" class="form-control">
              <option value="Aktif" <?= $val('status_aktivitas') === 'Aktif' ? 'selected' : '' ?>>Aktif</option>
              <option value="Cuti" <?= $val('status_aktivitas') === 'Cuti' ? 'selected' : '' ?>>Cuti</option>
              <option value="Tugas Belajar" <?= $val('status_aktivitas') === 'Tugas Belajar' ? 'selected' : '' ?>>Tugas Belajar</option>
              <option value="Keluar" <?= $val('status_aktivitas') === 'Keluar' ? 'selected' : '' ?>>Keluar</option>
            </select>
          </div>
        </div>
      </div>

      <div class="card-footer" style="display: flex; align-items: center; justify-content: flex-end; flex-wrap: wrap; gap: 0.75rem;">
        <a href="<?= url('/dosen') ?>" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary" style="display: inline-flex; align-items: center; gap: 0.4rem;">
          <?= svg_icon('check-circle', '', 16) ?>
          Simpan Perubahan Data
        </button>
      </div>
    </form>
  </div>
</div>
