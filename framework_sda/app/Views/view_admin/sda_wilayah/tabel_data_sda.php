<?= $this->extend('view_admin/frame/a_layout') ?>
<?= $this->section('content') ?>
<?php 
$dir_doc = "uploads/sda_wilayah/dokumen/";
?>

<div class="card">
  <div class="card-header">
  <a href="<?= base_url('admin/sda_wilayah/pilih')?>" type="button" class="btn btn-outline-secondary float-left"><i class="fas fa-chevron-left"></i> Kembali</a> 
  <h3 class="card-title my-2 ml-3">Data Sumber Daya Air</h3> 
  <a href="<?= base_url('Admin/form_tambah_sda_wilayah/'.$id)?>" class="btn btn-primary float-right"><i class="fas fa-plus mr-2"></i>Tambah Data</a>
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
        <?php if(!empty($data_wilayah)) {
        foreach ($data_wilayah as $data_sda) : ?>
        <tr>
        <td><?= $data_sda["id"]; ?></td>
        <td><?= $data_sda["judul_data"]; ?></td>
        <td>
          <?php if($data_sda["dokumen"]){?>
          <a href="<?=dokumen_link($data_sda["dokumen"],$data_sda["tipe_dokumen"],"wilayah")?>" data-placement="top" data-toggle="tooltip" title="<?=$data_sda["ket_dokumen"]?>"><i class='fas fa-file'> <?=get_extensi($data_sda["dokumen"])?></i></a>
          <?php }else{ echo "-";} ?>
        </td>
        <td>
          <?= $data_sda["geojson_petak"] == "" ? "-" : "<i class='fas fa-object-ungroup'></i> "; ?>
          <?= $data_sda["geojson_garis"] == "" ? "-" : "<i class='fas fa-wave-square'></i> "; ?>
          <?= $data_sda["geojson_titik"] == "" ? "-" : "<i class='fas fa-map-marker'></i>"; ?>
        </td>
        <td class="text-center">
          <a href="<?=base_url('admin/form_ubah_sda_wilayah/'.$data_sda["id"])?>" type="button" title="Edit Data" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
          <a href="<?=base_url('admin/hapus_sda_wilayah/'.$data_sda["id"])?>" type="button" data-placement="left" data-toggle="tooltip" title="Hapus Data" class="btn btn-sm btn-outline-danger" onclick="return confirm('Konfirmasi hapus data sumber daya air ini?');"><i class="fas fa-trash"></i></a>
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
  $("[data-toggle='tooltip']").tooltip();
  $('#dataTable').DataTable();

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