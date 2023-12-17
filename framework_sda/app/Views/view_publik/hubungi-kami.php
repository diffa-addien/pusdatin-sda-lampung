<?= $this->extend('view_publik/frame/p_layout') ?>
<?= $this->section('head') ?>

<?= $this->endSection()?>

<?= $this->section('content') ?>
<div class="container-fluid p-0 mb-3" style="min-height: 74vh;">
  <div class="container mt-4">
    <h2 class="mb-3"><span class="border-bottom pb-1">Hubungi kami</span></h2>
    <p>
      Kami terbuka untuk menerima kritik, saran, dan pertanyaan dari anda. Silahkan hubungi kami melalui kontak dibawah
      ini.
    </p>
    <div class="mb-2"><span class="me-2 fa fa-phone"></span> No. Telepon: <?=profil_sistem("no_tlp")?></div>
    <div class="mb-2"><span class="me-2 fa fa-paper-plane"></span> Email: <?=profil_sistem("email")?></div>
    <div class="mb-2"><span class="me-2 fa fa-globe"></span> Website: <?=base_url()?></div>
  </div>
</div>
<?= $this->endSection()?>

<?= $this->section('script') ?>

<?= $this->endSection()?>