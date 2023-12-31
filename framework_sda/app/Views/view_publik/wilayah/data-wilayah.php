<?php
$dir_doc = "uploads/sda_wilayah/dokumen/";
?>
<?= $this->extend('view_publik/frame/maps_layout') ?>
<?= $this->section('head') ?>
<!-- Font Awesome -->
<link rel="stylesheet" href="<?= base_url('leaflet/leaflet.css')?>">
<link rel="stylesheet" href="<?= base_url('myassets/leaflet-search/src/leaflet-search.css')?>">
<?= $this->endSection()?>

<?= $this->section('content') ?>
<div class="z-1 p-0">
  <div class="container pt-4">

    <form method="POST">
      <div class="input-group mb-3 shadow rounded">
        <input type="text" class="form-control" placeholder="Telusuri Data" value="<?=$query?>" name="query">
        <button type="submit" role="button" class="btn btn-light px-4 border" id="basic-addon2"><i class="fas fa-search me-1"></i> Cari</button>    
      </div>
      <div class="input-group mb-3">
        <select name="kategori" id="kategori" class="btn btn-light border px-1">
          <option value="">Semua Kategori</option>
          <?php foreach ($data_kat as $kat): ?>
          <option value="<?=$kat['id']?>"><?=$kat['nama']?></option>
          <?php endforeach ?>
        </select>
        <select name="tahun" id="tahun" class="btn btn-light border px-1">
          <option value="">Semua Tahun</option>
          <?php foreach ($getTahun as $tah): ?>
          <option value="<?=$tah['tahun']?>"><?=$tah['tahun']?></option>
          <?php endforeach ?>
        </select>
        <button  type="submit" class="btn btn-sm btn-outline-secondary border px-4">Terapkan</button>
      </div>
    </form>

    <div class="fw-light mb-3">
      Menampilkan <?=count($sda_wilayah)?> data (<?=round($duration, 3)?> detik)
    </div>

    <table id="tabel-wilayah" class="table table-bordered table-hover">
      <thead>
        <tr>
          <th class="w-25">Judul Data</th>
          <th class="w-50">Deskripsi</th>
          <th>GIS File</th>
          <th>Dokumen</th>
          <th>Tahun</th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($sda_wilayah)) {
        foreach ($sda_wilayah as $sda_wilayah) : ?>
        <tr>
        <td><?= $sda_wilayah["judul_data"]; ?></td>
        <td><?= $sda_wilayah["isi_data"]; ?></td>
        <td>
          <?= $sda_wilayah["geojson_petak"] == "" ? "-" : "<i class='fas fa-object-ungroup'></i> "; ?>
          <?= $sda_wilayah["geojson_garis"] == "" ? "-" : "<i class='fas fa-wave-square'></i> "; ?>
          <?= $sda_wilayah["geojson_titik"] == "" ? "-" : "<i class='fas fa-map-marker'></i>"; ?>
        </td>
        <td>
          <?php if($sda_wilayah["dokumen"]){?>
          <a href="javascript:void(0)" onclick="location.href='<?= base_url('Publik/pemberitahuan')?>'" data-bs-placement="top" data-bs-toggle="tooltip" title="<?=$sda_wilayah["ket_dokumen"]?>"><i class='fas fa-file'> <?=get_extensi($sda_wilayah["dokumen"])?></i></a>
          <?php }else{ echo "-";} ?>
        </td>
        <td><?= $sda_wilayah["tahun"]; ?></td>
        </tr>
        <?php endforeach;
        }else{?>
        <tr>
          <td class="text-center" colspan="5">Data kosong</td>
        </tr>
        <?php } ?>
      </tbody>
    </table>

  </div>
</div>
</div>
<?= $this->endSection()?>

<?= $this->section('script') ?>
<script>
$(document).ready( function () {
  $('#kategori').val('<?=$kategori?>').change();
  $('#tahun').val('<?=$tahun?>').change();
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })
});
</script>
<?= $this->endSection()?>