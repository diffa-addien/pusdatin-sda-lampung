<?php
  $dir_doc = "uploads/sda_provinsi/dokumen/";
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
        <button type="submit" role="button" class="btn btn-light px-4 border" id="basic-addon2"><i
            class="fas fa-search me-1"></i> Cari</button>
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
        <button type="submit" class="btn btn-sm btn-outline-secondary border px-4">Terapkan</button>
      </div>

    </form>

    <div class="fw-light mb-3">
      Menampilkan <?=count($sda_prov)?> data (<?=round($duration, 3)?> detik)
    </div>

    <div class="table-responsive">
      <table id="tabel_1" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th style="min-width: 20%">Judul Data</th>
            <th style="min-width: 35%">Deskripsi</th>
            <th>GIS File</th>
            <th>Dokumen</th>
            <th>Kategori</th>
            <th>Tahun</th>
          </tr>
        </thead>
        <tbody>
          <?php if(!empty($sda_prov)) {
          foreach ($sda_prov as $sda_prov) : ?>
          <tr>
            <td><?= $sda_prov["judul_data"]; ?></td>
            <td><?= $sda_prov["isi_data"]; ?></td>
            <td>
              <?= $sda_prov["geojson_petak"] == "" ? "-" : "<a href='".base_url('Webgis/viewer/?gis=uploads%2Fsda_provinsi%2Fgeografis%2F').$sda_prov["geojson_petak"]."' title='Lihat GIS' data-placement='top' data-toggle='tooltip'><i class='fas fa-object-ungroup'></i></a>"; ?>
              <?= $sda_prov["geojson_garis"] == "" ? "-" : "<a href='".base_url('Webgis/viewer/?gis=uploads%2Fsda_provinsi%2Fgeografis%2F').$sda_prov["geojson_garis"]."' title='Lihat GIS' data-placement='top' data-toggle='tooltip'><i class='fas fa-wave-square'></i></a>"; ?>
              <?= $sda_prov["geojson_titik"] == "" ? "-" : "<a href='".base_url('Webgis/viewer/?gis=uploads%2Fsda_provinsi%2Fgeografis%2F').$sda_prov["geojson_titik"]."' title='Lihat GIS' data-placement='top' data-toggle='tooltip'><i class='fas fa-map-marker'></i></a>"; ?>
            </td>
            <td>
              <?php if($sda_prov["dokumen"]){?>
              <a href="<?=cekSesiUnduh(dokumen_link($sda_prov["dokumen"],$sda_prov["tipe_dokumen"],"provinsi"))?>"><i
                  class='fas fa-file'> <?=get_extensi($sda_prov["dokumen"])?></i></a>
              <?php }else{ echo "-";} ?>
            </td>
            <td><?= get_kategoriById($sda_prov["id_kategori"]) ?></td>
            <td><?= $sda_prov["tahun"]; ?></td>
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
</div>
<?= $this->endSection()?>

<?= $this->section('script') ?>
<script>
$(document).ready(function() {
  $('#kategori').val('<?=$kategori?>').change();
  $('#tahun').val('<?=$tahun?>').change();
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })
});
</script>

<?= $this->endSection()?>