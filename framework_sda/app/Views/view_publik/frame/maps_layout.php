<?php 
function cekView($value){
  if($_GET['layout']){
    if($_GET['layout']==$value){
      return "disabled";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Meta Tags -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="/myassets/favicon/favicon.ico">
  <link rel="apple-touch-icon" sizes="180x180" href="/myassets/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/myassets/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/myassets/favicon/favicon-16x16.png">
  <link rel="manifest" href="/myassets/favicon/site.webmanifest">
  <title><?php echo $title; ?></title>

  <!-- Ambil Resource -->
  <link href="<?= base_url('myassets/bootstrap-5.3.0/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="<?= base_url('adminlte-3.2/plugins/fontawesome-free/css/all.min.css')?>"
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="<?= base_url('leaflet/leaflet.css')?>">
  <link rel="stylesheet" href="<?= base_url('myassets/leaflet-search/src/leaflet-search.css')?>">
  <style>
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
    
    .disabled{pointer-events: none; color: grey;}

    .svh{height: calc(100vh - 110px); height: calc(100svh - 110px); width: 100%;}
    .w-px-190{
      width: 190px
    }
    .img-pop{
      width: 100%;
      max-height: 150px;
      object-fit: cover;
    }
    .leaflet-popup-content-wrapper {
      max-width: 300px;
      padding: 2px;
      border-radius:5px
    }
    .leaflet-popup-content{
      width: 260px;
      margin: 3px;
    } 
    .leaflet-popup-content table{
      display: block;
      width: 100%;
      max-height: 30vh;
      overflow-x:scroll;
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

    #kategori{
      max-height: 35vh;
      overflow-x: hidden;
    }
    .count-wrap{
      background-color: rgba(0,0,0,0);
    }
  </style>
  <!-- Render tambahan (Opsional) -->
  <?= $this->renderSection('head') ?>
</head>

<body>
  <nav class="navbar navbar-expand-sm navbar-dark bg-primary darken-3" style="transition-duration: 5s;" id="header">
    <div class="container">
    <a class="navbar-brand me-5" href="<?= base_url()?>">
        <img src="<?=base_url('uploads/data_provinsi/'.profil_sistem("logo_sistem"))?>" class="logo_img">
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
  <div class="z-10 w-100 py-2 bg-white" style="height: 41px; box-shadow: rgba(0, 0, 0, 0.35) 0px 3px 8px;">
    <div class="container">
      <div class="d-inline-block" style="max-width: 75%; overflow:hidden; white-space: nowrap;">
        <a href="<?= base_url()?>"><i class="fas fa-chevron-left border-end border-2 pe-2 text-start"></i></a> <b class="text-capitalize ps-2"><?=$jenis." ".$nama?></b>
      </div>
        <span class="float-end">
          <span class="pe-2 d-none d-sm-inline">Tampilan : </span><a href="?layout=maps" class="<?=cekView('maps')?>" title="Mode Maps"><i class="fa fa-map"></i></a> <span class="border-end border-2 p-0 mx-1"></span> <a href="?layout=list" class="ps-1 <?=cekView('list')?>" title="Mode List"><i class="fa fa-list-alt"></i></a>
        </span> 
    </div>
  </div>
  <?= $this->renderSection('content') ?>

  <!-- No Footer -->

  <!-- Bootstrap core JavaScript-->
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="<?= base_url('myassets/bootstrap-5.3.0/js/bootstrap.bundle.min.js')?>"></script>

  <script src="<?= base_url('leaflet/leaflet.js')?>"></script>

  <!-- Leaflet Plugins -->
  <script src="<?= base_url('myassets/leaflet-search/dist/leaflet-search.min.js')?>"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-omnivore/0.3.4/leaflet-omnivore.min.js"></script>

  <!-- Render script tambahan jika diperlukan -->
  <?= $this->renderSection('script') ?>

</body>

</html>