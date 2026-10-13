<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>404 Halaman Tidak Ditemukan - SIM Dosen</title>
  <link rel="stylesheet" href="<?= asset('css/app.css') ?>">
</head>
<body style="background: var(--bg); display: flex; align-items: center; justify-content: center; min-height: 100vh;">
  <div style="text-align: center; max-width: 480px; padding: 2rem;">
    <div style="font-size: 5rem; font-weight: 800; color: var(--primary); line-height: 1;">404</div>
    <h1 style="font-size: 1.5rem; font-weight: 800; color: var(--slate-900); margin-top: 1rem;">
      Halaman Tidak Ditemukan
    </h1>
    <p style="color: var(--text-muted); font-size: 0.9rem; margin-top: 0.5rem; margin-bottom: 1.5rem;">
      Halaman atau rute yang Anda tuju tidak tersedia atau telah dipindahkan.
    </p>
    <a href="<?= url('/dosen') ?>" class="btn btn-primary">
      Kembali ke Beranda &rarr;
    </a>
  </div>
</body>
</html>
