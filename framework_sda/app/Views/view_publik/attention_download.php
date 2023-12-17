<?= $this->extend('view_publik/frame/p_layout') ?>
<?= $this->section('head') ?>

<?= $this->endSection()?>

<?= $this->section('content') ?>
<div class="container-fluid p-0 mb-3" style="min-height: 68vh;">
  <div class="container mt-5 text-center">
    <h2 class="mb-3"><span class=" pb-1">Anda tidak bisa mendownload dokumen!</span></h2>
    <p>
      Pengguna publik tidak bisa melakukan download dokumen, jadilah kontributor agar dapat mendowload file!.
    </p>
    <div class="form-row w-100 my-5">
      <a href="javascript: history.back()" class="btn btn-outline-secondary col-4 me-3">Kembali</a>
      <a href="<?=base_url("Login/v_register")?>" class="btn btn-primary float-right col-6">Saya ingin menjadi kontributor</a>
    </div>
  </div>
</div>
<?= $this->endSection()?>

<?= $this->section('script') ?>

<?= $this->endSection()?>