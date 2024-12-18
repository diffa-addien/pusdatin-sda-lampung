<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Meta Tags -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="index, follow">
  <meta name="googlebot" content="index, follow">
  <meta name="google-site-verification" content="ryKp7nOZvoV34O9ztIZxQyM-01pOD_A_iqpzaEyySZU" />
  <meta name="description" content="Pusat data dan informasi sumber daya air Provinsi Lampung. Dapatkan akses ke pusat informasi terpusat yang didedikasikan untuk sumber daya air.">
  <meta name="keywords" content="Sumber daya air, sistem informasi air, Sumber Daya Air Lampung, Pusdatin sda lampung">

  <link rel="icon" type="image/x-icon" href="/myassets/favicon/favicon.ico">
  <link rel="icon" type="image/png" sizes="32x32" href="/myassets/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/myassets/favicon-16x16.png">
  <link rel="apple-touch-icon" sizes="180x180" href="/myassets/apple-touch-icon.png">
  <link rel="manifest" href="/myassets/site.webmanifest">

  <title><?php echo $title; ?></title>

  <!-- Ambil Resource -->
  <link href="<?= base_url('myassets/bootstrap-5.3.0/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="<?= base_url('adminlte-3.2/plugins/fontawesome-free/css/all.min.css')?>" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    /* {outline: 1px solid red;} */
    body{
      overflow-x: hidden;
    }
    .navbar li a {
      color: var(--bs-light);
      opacity: 0.95;
    }
    .navbar li a.active, .navbar li a:hover  {
      color: var(--bs-light);
      opacity: 1;
    }
    .navbar li a.active {
      font-weight: 600;
    }
    /* Paddinger = padding top navbar */
    .paddinger{
      border-top: 5rem solid var(--bs-primary);
    }
    .bg-footer {
      background-color: rgba(59, 113, 202, 0.05);
    }
    .bg-footer-2 {
      background-color: rgba(59, 113, 202, 0.15);
    }
    .logo_img{
      position:relative;
      height: 40px;
      object-fit: contain;
      top: 0px;
    }
    .logo_teks{
      position:relative;
      left: 0px;
    }
    .navbar-brand{
      padding-right: 0px
    }
    
  </style>

  <!-- Render tambahan jika diperlukan -->
  <?= $this->renderSection('head') ?>
</head>

<body>
  <nav class="navbar fixed-top navbar-expand-sm navbar-dark bg-primary darken-3 py-3" style="transition-duration: 5s;"
    id="header">
    <div class="container">
      <a class="navbar-brand me-5" href="<?= base_url()?>">
        <img src="<?=base_url('uploads/data_provinsi/'.profil_sistem("logo_sistem"))?>" class="logo_img" alt="Logo Sistem">
        <span class="logo_teks"><?=profil_sistem("nama_sistem")?></span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item d-none d-lg-block">
            <a class="nav-link <?= \Config\Services::request()->uri->getSegment(1) == '' ? 'active border-bottom' : '' ?>"
              aria-current="page" href="<?= base_url()?>">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= \Config\Services::request()->uri->getSegment(1) == 'tentang-sistem' ? 'active border-bottom' : '' ?>"
              href="<?= base_url('tentang-sistem')?>">Tentang Sistem</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link <?= \Config\Services::request()->uri->getSegment(1) == 'hubungi-kami' ? 'active border-bottom' : '' ?>"
              href="<?= base_url('hubungi-kami')?>">Hubungi Kami</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link"
              href="<?= base_url("publik/panduan")?>" target="_blank"><i class="fas fa-book"></i> Panduan Pengguna</a>
          </li>
        </ul>

        <a href="<?= base_url('admin')?>" target="_blank" class="btn btn-outline-light">
          <i class="fa fa-user me-1"></i>
          <?php if(empty(session()->get('username'))){?>
          Login
          <?php }else{ echo session()->get('username'); }?>
        </a>
        <!-- <a href="<?= base_url('admin')?>" target="_blank" class="btn btn-outline-light ml-3"><i class="fa fa-user"></i>
          Register
        </a> -->

      </div>
    </div>
  </nav>

  <!-- Render Konten -->
  <div class="paddinger">
    <?= $this->renderSection('content') ?>
  </div>

  <div class="py-4 bg-footer-2">
    <div class="container-sm">
      <div class="text-center border-dark-subtle">
        Copyright © <?= date("Y")?> - Universitas Lampung
      </div>
    </div>
  </div>

  <!-- <script src="https://unpkg.com/swup@3"></script> -->
  <!-- Bootstrap core JavaScript-->
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="<?= base_url('myassets/bootstrap-5.3.0/js/bootstrap.bundle.min.js')?>"></script>

  <script>
  var className = "navbar-light bg-primary";
  var scrollTrigger = 20;

  window.onscroll = function() {
    scrollFunction()
  };

  function scrollFunction() {
    if (document.body.scrollTop > scrollTrigger || document.documentElement.scrollTop > scrollTrigger) {
      document.getElementById("header").style.cssText =
        'box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;transition-timing-function: ease-in;transition: 0.25s;';
      document.getElementById("header").classList.remove("py-3");
    } else {
      document.getElementById("header").style.cssText =
        'box-shadow: none;transition-timing-function: ease-out;transition: 0.25s;';
      document.getElementById("header").classList.add("py-3");
    }
  }
  </script>

  <!-- Render script tambahan jika diperlukan -->
  <?= $this->renderSection('script') ?>

</body>

</html>