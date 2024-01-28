<?= $this->extend('view_admin/frame/a_layout') ?>
<?= $this->section('content') ?>
<?php 
$dir_doc = "uploads/sda_provinsi/dokumen/";
?>

<div class="card">
  <div class="card-header">
  <h3 class="card-title my-2 ml-1">Data Sumber Daya Air</h3> 
  <a href="<?= base_url('Admin/form_tambah_sda_prov/')?>" class="btn btn-primary float-right"><i class="fas fa-plus mr-2"></i>Tambah Data</a>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="dataTable" class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th class="w-50">Judul Data</th>
          <th>Dokumen</th>
          <th>GIS File</th>
          <th class="text-center"><i class="fas fa-tools"></i></th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($sda_prov)) {
        foreach ($sda_prov as $sda_prov) : ?>
        <tr>
        <td><?= $sda_prov["id"]; ?></td>
        <td><?= $sda_prov["judul_data"]; ?></td>
        <td>
          <?php if($sda_prov["dokumen"]){?>
          <a href="<?=dokumen_link($sda_prov["dokumen"],$sda_prov["tipe_dokumen"],"provinsi")?>" data-placement="top" data-toggle="tooltip" title="<?=$sda_prov["ket_dokumen"]?>"><i class='fas fa-file'> <?=get_extensi($sda_prov["dokumen"])?></i></a>
          <?php
          }else{ echo "-";} ?>
        </td>
        <td>
          <?= $sda_prov["geojson_petak"] == "" ? "-" : "<i class='fas fa-object-ungroup'></i> "; ?>
          <?= $sda_prov["geojson_garis"] == "" ? "-" : "<i class='fas fa-wave-square'></i> "; ?>
          <?= $sda_prov["geojson_titik"] == "" ? "-" : "<i class='fas fa-map-marker'></i>"; ?>
        </td>
        <td class="text-center">
          <a href="<?=base_url('admin/form_ubah_sda_prov/'.$sda_prov["id"])?>" type="button" title="Edit Data" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
          <a href="<?=base_url('admin/hapus_sda_prov/'.$sda_prov["id"])?>" type="button" title="Hapus Data" class="btn btn-sm btn-outline-danger" onclick="return confirm('Konfirmasi hapus data sumber daya air ini?');"><i class="fas fa-trash"></i></a>
        </td>
        </tr>
        <?php endforeach;
        }else{?>
        <tr>
          <td class="text-center" colspan="4">Data kosong</td>
        </tr>
        <?php } ?>
      </tbody>
      <tfoot>
        <tr>
          <th>ID</th>
          <th>Judul Data</th>
          <th>Dokumen</th>
          <th>GIS File</th>
          <th class="text-center"><i class="fas fa-tools"></i></th>
        </tr>
      </tfoot>
    </table>
</div>
<!-- /.card -->

<?= $this->endSection('content') ?>

<?= $this->section('script')?>
<script>
$(document).ready(function() {
  $('#dataTable').DataTable();
  $("[data-toggle='tooltip']").tooltip();
  
  var Toast = Swal.mixin({
      toast: true,
      position: 'top',
      showConfirmButton: false, padding:"10px",
      timer: 4000,
      timerProgressBar: true,
      customClass: {
        title: 'p-2',
      }
  });
  <?php if(!empty(session()->getFlashdata('pesan'))):?>
    Toast.fire({
      icon: '<?=session()->getFlashdata("icon")?>',
      title: '<?=session()->getFlashdata("pesan")?>'
    })
  <?php endif ?>
})
</script>
<?= $this->endSection() ?>