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
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?= base_url('adminlte-3.2/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet"
    href="<?= base_url('adminlte-3.2/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url('adminlte-3.2/plugins/icheck-bootstrap/icheck-bootstrap.min.css')?>">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= base_url('adminlte-3.2/plugins/jqvmap/jqvmap.min.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('adminlte-3.2/dist/css/adminlte.min.css')?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url('adminlte-3.2/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url('adminlte-3.2/plugins/daterangepicker/daterangepicker.css')?>">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url('adminlte-3.2/plugins/summernote/summernote-bs4.min.css')?>">

  <?php if (!empty($library) && in_array("datatables", $library)): ?>
  <!-- DataTables -->
  <link rel="stylesheet" href="../../adminlte-3.2/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../adminlte-3.2/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../adminlte-3.2/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <?php endif ?>

  <link rel="stylesheet" href="<?= base_url('leaflet/leaflet.css')?>">

  <?= $this->renderSection('head') ?>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto text-capitalize">
        
        <!-- <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li> -->
        <!-- <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
            <i class="fas fa-th"></i>
          </a>
        </li> -->

        <?php if($_SESSION['role'] == "admin_utama"){?>
        <li class="nav-item">
          <a class="nav-link" href="<?=base_url("Admin/profil_sistem")?>" role="button"><i class="fas fa-cog mr-1"></i>Pengaturan</a>
        </li>
        <span class="nav-link"> | </span>
        <?php } ?>

        <li class="nav-item">
          <a class="nav-link" href="#" data-toggle="dropdown" role="button">
            <i class="fas fa-user-circle fa-lg"></i> <?=$_SESSION['nama']?>
          </a>
          <div class="dropdown-menu dropdown-menu-md dropdown-menu-right mr-2">
            <a href="<?=base_url("Admin/profil_akun")?>" class="dropdown-item"><i class="fas fa-user mr-2"></i>Profil Akun</a>
            <a href="<?=base_url("Admin/ganti_password")?>" class="dropdown-item"><i class="fas fa-unlock-alt mr-2"></i>Ganti Password</a>
            <div class="dropdown-divider"></div>
            <a href="<?=base_url('Login/logout')?>" class="dropdown-item"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-primary elevation-1">
      <!-- Brand Logo -->
      <a href="<?=base_url('admin')?>" class="brand-link">
          <i class="fas fa-faucet fa-lg pl-3"></i>
        <span class="brand-text font-weight-light"><?= profil_sistem("nama_sistem") ?></span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?= base_url('adminlte-3.2/dist/img/user2-160x160.jpg')?>" class="img-circle elevation-2"
          alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Alexander Pierce</a>
      </div>
    </div> -->

        <!-- SidebarSearch Form -->
        <!-- <div class="form-inline mt-3">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Cari..." aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
            <li class="nav-item m-o p-0">
              <a href="<?=base_url('admin')?>"
                class="nav-link <?= \Config\Services::request()->uri->getSegment(2) == '' ? 'active' : '' ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dasbor
                </p>
              </a>
            </li>

            <?php if($_SESSION['role'] == "admin_utama"){?>
            <li class="nav-item">
              <a href="<?=base_url('admin/kelola_akun')?>"
                class="nav-link <?= \Config\Services::request()->uri->getSegment(2) == 'kelola_akun' ? 'active' : '' ?>">
                <i class="nav-icon fas fa-users-cog"></i>
                <p>
                  Kelola Akun
                </p>
              </a>
            </li>
            <?php } ?>

            <?php if($_SESSION['role'] == "admin_utama" OR $_SESSION['role'] == "admin_provinsi"){?>
            <li class="nav-item">
              <a href="<?=base_url('admin/kelola_wilayah')?>"
                class="nav-link <?= \Config\Services::request()->uri->getSegment(2) == 'kelola_wilayah' ? 'active' : '' ?>">
                <i class="fas fa-landmark nav-icon"></i>
                <p>
                  Kelola Wilayah
                </p>
              </a>
            </li>
            <?php } ?>

            <?php if($_SESSION['role'] == "admin_utama" OR $_SESSION['role'] == "admin_provinsi"){?>
            <li class="nav-item">
              <a href="<?=base_url('admin/kelola_kategori')?>" 
                class="nav-link <?= \Config\Services::request()->uri->getSegment(2) == 'kelola_kategori' ? 'active' : '' ?>">
                <i class="nav-icon fas fa-tags"></i>
                <p>Kelola Ketegori</p>
              </a>
            </li>
            <?php } ?>
          
            <li class="nav-header m-o p-0"><hr/></li>

            <?php if($_SESSION['role'] == "admin_utama" OR $_SESSION['role'] == "admin_provinsi"){?>
            <li class="nav-item">
              <a href="<?=base_url('admin/sda_provinsi')?>" 
                class="nav-link <?= \Config\Services::request()->uri->getSegment(2) == 'sda_provinsi' ? 'active' : '' ?>">
                <i class="nav-icon fas fa-map"></i>
                <p>SDA Provinsi</p>
              </a>
            </li>
            <?php } ?>

            <?php if($_SESSION['role'] == "admin_utama" OR $_SESSION['role'] == "kontributor"){?>
            <li class="nav-item">
              <a href="<?=base_url('admin/sda_wilayah/pilih')?>" 
                class="nav-link <?= \Config\Services::request()->uri->getSegment(2) == 'sda_wilayah' ? 'active' : '' ?>">
                <i class="nav-icon fas fa-map-marked-alt"></i>
                <p>SDA di Wilayah</p>
              </a>
            </li>
            <?php } ?>

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Preloader -->
    <!-- <div class="preloader flex-column justify-content-center align-items-center">
<img class="animation__shake" src="<?= base_url('adminlte-3.2/dist/img/AdminLTELogo.png')?>" alt="AdminLTELogo" height="60" width="60">
</div> -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0"><?=$title?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Dasbor</a></li>
                <?= \Config\Services::request()->uri->getSegment(2) == '' ? '' : '
                  <li class="breadcrumb-item active">'.$title.'</li>
                ' ?>
                
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">

        <?= $this->renderSection('content') ?>

        </div><!-- /.container-fluid -->
      </section><!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
      <strong>Copyright &copy; <?=date("Y")?> Universitas Lampung.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Versi</b> 1.0
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      <!-- Customize AdminLTE -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->



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
  <!-- SweetAlert2 -->
  <script src="<?= base_url('adminlte-3.2/plugins/sweetalert2/sweetalert2.min.js')?>"></script>
  <!-- ChartJS -->
  <script src="<?= base_url('adminlte-3.2/plugins/chart.js/Chart.min.js')?>"></script>
  <!-- Sparkline -->
  <script src="<?= base_url('adminlte-3.2/plugins/sparklines/sparkline.js')?>"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?= base_url('adminlte-3.2/plugins/jquery-knob/jquery.knob.min.js')?>"></script>
  <!-- daterangepicker -->
  <script src="<?= base_url('adminlte-3.2/plugins/moment/moment.min.js')?>"></script>
  <script src="<?= base_url('adminlte-3.2/plugins/daterangepicker/daterangepicker.js')?>"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?= base_url('adminlte-3.2/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')?>">
  </script>
  <!-- Summernote -->
  <script src="<?= base_url('adminlte-3.2/plugins/summernote/summernote-bs4.min.js')?>"></script>
  <!-- overlayScrollbars -->
  <script src="<?= base_url('adminlte-3.2/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')?>"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url('adminlte-3.2/dist/js/adminlte.js')?>"></script>  

  <!-- Leaflet JS -->
  <script src="<?= base_url('leaflet/leaflet.js')?>"></script>
  <!-- <script src="<?= base_url('leaflet/leaflet-omnivore.min.js')?>"></script> -->

  <?php if (!empty($library) && in_array("datatables", $library)): ?>
  <!-- DataTables  & Plugins -->
  <script src="<?= base_url('adminlte-3.2/plugins/datatables/jquery.dataTables.min.js')?>"></script>
  <script src="<?= base_url('adminlte-3.2/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')?>"></script>
  <script src="<?= base_url('adminlte-3.2/plugins/datatables-responsive/js/dataTables.responsive.min.js')?>"></script>
  <script src="<?= base_url('adminlte-3.2/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')?>"></script>
  <script src="<?= base_url('adminlte-3.2/plugins/datatables-buttons/js/dataTables.buttons.min.js')?>"></script>
  <script src="<?= base_url('adminlte-3.2/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')?>"></script>
  <script src="<?= base_url('adminlte-3.2/plugins/jszip/jszip.min.js')?>"></script>
  <script src="<?= base_url('adminlte-3.2/plugins/pdfmake/pdfmake.min.js')?>"></script>
  <script src="<?= base_url('adminlte-3.2/plugins/pdfmake/vfs_fonts.js')?>"></script>
  <script src="<?= base_url('adminlte-3.2/plugins/datatables-buttons/js/buttons.html5.min.js')?>"></script>
  <script src="<?= base_url('adminlte-3.2/plugins/datatables-buttons/js/buttons.print.min.js')?>"></script>
  <script src="<?= base_url('adminlte-3.2/plugins/datatables-buttons/js/buttons.colVis.min.js')?>"></script>
  <script>
  $(function() {
    $("#tabel_1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    
    $('#tabel_2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
  </script>
  <?php endif ?>

  <?= $this->renderSection('script') ?>

</body>

</html>