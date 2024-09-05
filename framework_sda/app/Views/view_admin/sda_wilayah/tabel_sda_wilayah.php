<?= $this->extend('view_admin/frame/a_layout') ?>
<?= $this->section('content') ?>


<div class="card">
  <div class="card-header">
    <h3 class="card-title my-1">Pilih Wilayah Terlebih Dahulu</h3> <span class="float-right">
      (Total: <?=count($data_wilayah)?> Wilayah) </span>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <div class="row">
      <?php 
      foreach ($data_wilayah as $data_kota) : 
        if($data_kota["jenis"] == "kabupaten" || $data_kota["jenis"] == "kota"){
          if(session()->get('role') == "kontributor" AND session()->get('wilayah') == $data_kota["id"] OR session()->get('role') != "kontributor"){
      ?>
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <a href="<?=base_url('admin/sda_wilayah/'.$data_kota["id"])?>" class="small-box bg-light px-2 py-1">
          <div class="row">
            <div class="col-8">
              <small class="mb-2 text-capitalize"><?=$data_kota["jenis"]?></small>
              <h5 class="mb-2 text-wrap text-capitalize"><?=$data_kota["nama"]?></h5>
            </div>
            <div class="col-4">
              <img src="<?= base_url('uploads/data_wilayah/gambar/'.$data_kota["gambar"]); ?>" class="w-100 float-right"
                style="height:80px; width:80px; object-fit: contain">
            </div>
            <div class="col-12 mt-1" style="background-color: rgba(0,0,0,.05)">
              <small class="mb-2 text-capitalize">Jumlah Data: <?=count_sda_wilayah($data_kota["id"])?></small>
            </div>
          </div>
        </a>
      </div>
      <?php } } endforeach; ?>
    </div>
    <hr style="border-color: rgba(0,0,0,.3);" class="mt-0"/>
    <div class="row">
      <?php foreach ($data_wilayah as $data_kam) : 
         if($data_kam["jenis"] == "kampus"){
          if(session()->get('role') == "kontributor" AND session()->get('wilayah') == $data_kota["id"] OR session()->get('role') != "kontributor"){
      ?>
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <a href="<?=base_url('admin/sda_wilayah/'.$data_kam["id"])?>" class="small-box bg-light px-2 py-1">
          <div class="row">
            <div class="col-8">
              <small class="mb-2 text-capitalize"><?=$data_kam["jenis"]?></small>
              <h5 class="mb-2 text-wrap text-capitalize"><?=$data_kam["nama"]?></h5>
            </div>
            <div class="col-4">
              <img src="<?= base_url('uploads/data_wilayah/gambar/'.$data_kam["gambar"]); ?>" class="w-100 float-right"
                style="height:80px; width:80px; object-fit: contain">
            </div>
            <div class="col-12 mt-1" style="background-color: rgba(0,0,0,.05)">
              <small class="mb-2 text-capitalize">Jumlah Data: <?=count_sda_wilayah($data_kam["id"])?></small>
            </div>
          </div>
        </a>
      </div>
      <?php } } endforeach; ?>
    </div>

  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->

<?= $this->endSection('content') ?>