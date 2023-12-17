<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="/myassets/favicon/favicon.ico">
  <link rel="apple-touch-icon" sizes="180x180" href="/myassets/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/myassets/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/myassets/favicon/favicon-16x16.png">
  <link rel="manifest" href="/myassets/favicon/site.webmanifest">
  <title><?=$title?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('adminlte-3.2/plugins/fontawesome-free/css/all.min.css')?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet"
    href="<?= base_url('adminlte-3.2/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')?>">
      <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('adminlte-3.2/dist/css/adminlte.min.css')?>">

  <link rel="stylesheet" href="<?= base_url('leaflet/leaflet.css')?>">

  <?= $this->renderSection('head') ?>

</head>

<body class="" style="max-height: 100vh; overflow: hidden">

  <!-- Main content -->
  <section>

    <?= $this->renderSection('content') ?>

  </section><!-- /.content -->

  <!-- jQuery -->
  <script src="<?= base_url('adminlte-3.2/plugins/jquery/jquery.min.js')?>"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?= base_url('adminlte-3.2/plugins/jquery-ui/jquery-ui.min.js')?>"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
  $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url('adminlte-3.2/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>

  <!-- Leaflet JS -->
  <script src="<?= base_url('leaflet/leaflet.js')?>"></script>
  <!-- <script src="<?= base_url('leaflet/leaflet-omnivore.min.js')?>"></script> -->

  <?= $this->renderSection('script') ?>

</body>

</html>