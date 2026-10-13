<?php
$errors = get_flash('validation_errors', []);
?>

<div style="max-width: 900px; margin: 0 auto;">
  <!-- BREADCRUMB & HEADING -->
  <div style="margin-bottom: 1.5rem;">
    <a href="<?= url('/dosen') ?>" style="display: inline-flex; align-items: center; gap: 0.4rem; color: var(--text-muted); text-decoration: none; font-size: 0.85rem; font-weight: 600; margin-bottom: 0.5rem;" class="nav-back-link">
      <?= svg_icon('arrow-left', '', 15) ?>
      Kembali ke Daftar Dosen
    </a>
    <h1 style="font-size: 1.6rem; font-weight: 800; color: var(--slate-900);">
      Tambah Data Dosen Baru
    </h1>
    <p style="color: var(--text-muted); font-size: 0.85rem;">
      Hanya field <strong>Nama Lengkap</strong> yang wajib diisi. Kolom lainnya bersifat opsional sesuai ketersediaan data.
    </p>
  </div>

  <div class="card">
    <div class="card-header" style="flex-wrap: wrap; gap: 0.75rem; justify-content: space-between;">
      <h2 class="card-title" style="display: flex; align-items: center; gap: 0.5rem;">
        <span style="color: var(--primary); display: inline-flex; align-items: center;">
          <?= svg_icon('user-plus', '', 18) ?>
        </span>
        Formulir Data Dosen
      </h2>
      <span class="badge badge-info" style="display: inline-flex; align-items: center; gap: 0.35rem;">
        <?= svg_icon('shield', '', 12) ?>
        Role Akses: <?= e(auth_user()['role'] ?? 'ADMIN') ?>
      </span>
    </div>

    <form action="<?= url('/dosen') ?>" method="POST">
      <div class="card-body">
        <div class="form-grid">
          <!-- NAMA LENGKAP (Wajib) -->
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
              value="<?= e(old('nama')) ?>"
              maxlength="150"
              required
            >
            <?php if (isset($errors['nama'])): ?>
              <span class="invalid-feedback"><?= e($errors['nama']) ?></span>
            <?php endif; ?>
            <span class="form-help">Maksimal 150 karakter. Wajib diisi.</span>
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
              value="<?= e(old('nomor_registrasi')) ?>"
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
              value="<?= e(old('nuptk')) ?>"
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
              value="<?= e(old('nip')) ?>"
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
              value="<?= e(old('pendidikan_terakhir')) ?>"
              maxlength="100"
            >
          </div>

          <!-- JABATAN FUNGSIONAL & KEPANGKATAN -->
          <div class="form-group">
            <label class="form-label" for="jabatan_fungsional">Jabatan Fungsional</label>
            <select id="jabatan_fungsional" name="jabatan_fungsional" class="form-control">
              <option value="">-- Pilih Jabatan Fungsional --</option>
              <option value="Tenaga Pengajar" <?= old('jabatan_fungsional') === 'Tenaga Pengajar' ? 'selected' : '' ?>>Tenaga Pengajar</option>
              <option value="Asisten Ahli" <?= old('jabatan_fungsional') === 'Asisten Ahli' ? 'selected' : '' ?>>Asisten Ahli</option>
              <option value="Lektor" <?= old('jabatan_fungsional') === 'Lektor' ? 'selected' : '' ?>>Lektor</option>
              <option value="Lektor Kepala" <?= old('jabatan_fungsional') === 'Lektor Kepala' ? 'selected' : '' ?>>Lektor Kepala</option>
              <option value="Guru Besar" <?= old('jabatan_fungsional') === 'Guru Besar' ? 'selected' : '' ?>>Guru Besar</option>
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
              value="<?= e(old('kepangkatan')) ?>"
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
              value="<?= e(old('rumpun_ilmu')) ?>"
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
              value="<?= e(old('penempatan')) ?>"
              maxlength="150"
            >
          </div>

          <!-- STATUS SERDOS, PEGAWAI, IKATAN KERJA, AKTIVITAS -->
          <div class="form-group">
            <label class="form-label" for="status_serdos">Sertifikasi Dosen (Serdos)</label>
            <select id="status_serdos" name="status_serdos" class="form-control">
              <option value="">-- Pilih Status --</option>
              <option value="Tersertifikasi" <?= old('status_serdos') === 'Tersertifikasi' ? 'selected' : '' ?>>Tersertifikasi</option>
              <option value="Belum Tersertifikasi" <?= old('status_serdos') === 'Belum Tersertifikasi' ? 'selected' : '' ?>>Belum Tersertifikasi</option>
            </select>
          </div>

          <div class="form-group">
            <label class="form-label" for="status_pegawai">Status Pegawai</label>
            <select id="status_pegawai" name="status_pegawai" class="form-control">
              <option value="">-- Pilih Status Pegawai --</option>
              <option value="PNS" <?= old('status_pegawai') === 'PNS' ? 'selected' : '' ?>>PNS</option>
              <option value="PPPK" <?= old('status_pegawai') === 'PPPK' ? 'selected' : '' ?>>PPPK</option>
              <option value="Non-PNS" <?= old('status_pegawai') === 'Non-PNS' ? 'selected' : '' ?>>Non-PNS</option>
            </select>
          </div>

          <div class="form-group">
            <label class="form-label" for="ikatan_kerja">Ikatan Kerja</label>
            <select id="ikatan_kerja" name="ikatan_kerja" class="form-control">
              <option value="">-- Pilih Ikatan Kerja --</option>
              <option value="Dosen Tetap" <?= old('ikatan_kerja') === 'Dosen Tetap' ? 'selected' : '' ?>>Dosen Tetap</option>
              <option value="Dosen Tidak Tetap" <?= old('ikatan_kerja') === 'Dosen Tidak Tetap' ? 'selected' : '' ?>>Dosen Tidak Tetap</option>
              <option value="Dosen Luar Biasa" <?= old('ikatan_kerja') === 'Dosen Luar Biasa' ? 'selected' : '' ?>>Dosen Luar Biasa</option>
            </select>
          </div>

          <div class="form-group">
            <label class="form-label" for="status_aktivitas">Status Aktivitas</label>
            <select id="status_aktivitas" name="status_aktivitas" class="form-control">
              <option value="Aktif" <?= old('status_aktivitas', 'Aktif') === 'Aktif' ? 'selected' : '' ?>>Aktif</option>
              <option value="Cuti" <?= old('status_aktivitas') === 'Cuti' ? 'selected' : '' ?>>Cuti</option>
              <option value="Tugas Belajar" <?= old('status_aktivitas') === 'Tugas Belajar' ? 'selected' : '' ?>>Tugas Belajar</option>
              <option value="Keluar" <?= old('status_aktivitas') === 'Keluar' ? 'selected' : '' ?>>Keluar</option>
            </select>
          </div>
        </div>
      </div>

      <div class="card-footer" style="display: flex; align-items: center; justify-content: flex-end; flex-wrap: wrap; gap: 0.75rem;">
        <a href="<?= url('/dosen') ?>" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary" style="display: inline-flex; align-items: center; gap: 0.4rem;">
          <?= svg_icon('check-circle', '', 16) ?>
          Simpan Data Dosen
        </button>
      </div>
    </form>
  </div>
</div>
