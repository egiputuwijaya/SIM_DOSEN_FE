<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= e($title ?? 'Masuk - SIM DOSEN Universitas Muhammadiyah Bengkulu') ?></title>
  <link rel="stylesheet" href="<?= asset('css/app.css') ?>?v=<?= time() ?>">
  <link rel="icon" type="image/png" href="<?= asset('logoumb.png') ?>" onerror="this.href='<?= base_url('../assets/logoumb.png') ?>'">
  <script>
    window.BASE_URL = "<?= rtrim(base_url(), '/') ?>";
  </script>
</head>
<body class="guest-body">
  <?= $content ?>
  <script src="<?= asset('js/app.js') ?>"></script>
</body>
</html>

