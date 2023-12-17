<?= $this->extend('view_admin/frame/a_layout') ?>
<?= $this->section('content') ?>
<style>
.lihat {
  visibility: hidden;
}

tr:hover .lihat {
  visibility: visible;
}
</style>
<?php 
function searchWilayah($id, $kota){foreach ($kota as $kota): if($id==$kota["id"]){return $kota["nama"];}endforeach; return null;}
?>

<?php 
$statusAkun = array_column($data_akun, 'status');
if(!empty(array_count_values($statusAkun)['tertunda'])) : ?>
<div class="card">
  <div class="card-header" style="background-color:#ffffbd">
    <h3 class="card-title">Permintaan Registrasi</h3>
    <div class="card-tools">
      <!-- Collapse Button -->
      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
    </div>
    <!-- /.card-tools -->
  </div>
  <!-- /.card-header -->
  <div class="card-body p-0">
    <table id="tabel_2" class="table table-hover">
      <thead>
        <tr>
          <th>No.</th>
          <th class="w-25">Nama</th>
          <th class="w-25">Role</th>
          <th class="w-25">Wilayah</th>
          <th class="text-center"><i class="fas fa-tools"></i></th>
        </tr>
      </thead>
      <tbody>
        <?php $count = 1; foreach ($data_akun as $akunPending) : ?>
        <?php if($akunPending["status"] != "aktif") : ?>
        <tr>
          <td><?= $count++; ?></td>
          <td><?= $akunPending["nama_lengkap"];?> <a href="<?=base_url('admin/detail_akun/'.$akunPending["username"])?>"
              class="lihat"><i class="fas fa-search"></i></a> </td>
          <td><?= $akunPending["role"]; ?></td>
          <td class="text-capitalize">
            <?php
              if(!is_numeric($akunPending["wilayah"])){
                echo $akunPending["wilayah"];
              }else{
                echo searchWilayah($akunPending["wilayah"], $kota);
            }?>
          </td>
          <td class="text-center">
            <a href="<?=base_url('admin/terima_akun/'.$akunPending["username"])?>" class="btn btn-success btn-sm"
              title="TERIMA PERMINTAAN" onclick="return confirm('Konfirmasi terima akun?');"><i class="fa fa-check"></i></a>
            <a href="<?=base_url('admin/hapus_akun/'.$akunPending["username"])?>" class="btn btn-outline-danger btn-sm"
              title="TOLAK dan HAPUS PERMINTAAN" onclick="return confirm('Konfirmasi tolak akun?');"><i class="fas fa-times"></i></a>
          </td>
        </tr>
        <?php endif; ?>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>
<?php endif; ?>

<div class="card">
  <div class="card-header">
    <h2 class="card-title pt-2">Tabel Akun</h2>
    <div class="card-tools">
      <a href="<?= base_url('Admin/form_tambah_akun')?>" class="btn btn-icon-split btn-primary text-end"><span
          class="icon"><i class="fas fa-user-plus mr-2"></i></span>Tambah Akun</a>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body p-0">
    <table id="tabel_2" class="table table-hover">
      <thead>
        <tr>
          <th>No.</th>
          <th class="w-25">Nama</th>
          <th class="w-25">Role</th>
          <th class="w-25">Wilayah</th>
          <th class="text-center"><i class="fas fa-tools"></i></th>
        </tr>
      </thead>
      <tbody>
        <?php $count = 1; foreach ($data_akun as $data_akun) : ?>
        <?php if($data_akun["status"] == "aktif") : ?>
        <tr>
          <td><?= $count++; ?></td>
          <td><?= $data_akun["nama_lengkap"];?> <a href="<?=base_url('admin/detail_akun/'.$data_akun["username"])?>"
              class="lihat"><i class="fas fa-search"></i></a> </td>
          <td><?= $data_akun["role"]; ?></td>
          <td class="text-capitalize">
            <?php
              if(!is_numeric($data_akun["wilayah"])){
                echo $data_akun["wilayah"];
              }else{
                echo searchWilayah($data_akun["wilayah"], $kota);
            }?>
          </td>
          <td class="text-center">
            <a href="<?=base_url('admin/form_ubah_akun/'.$data_akun["username"])?>" class="btn btn-warning btn-sm"
              title="EDIT DATA"><i class="far fa-edit"></i></a>
            <a data-toggle="modal" data-target="#modal-<?=$data_akun["username"]?>"
              class="btn btn-outline-danger btn-sm <?=$data_akun['role'] == 'admin_utama' ? 'disabled':'';?>"
              title="HAPUS DATA"><i class="fas fa-trash-alt"></i></a>
          </td>
        </tr>
        <div class="modal fade" id="modal-<?=$data_akun["username"]?>">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Hapus Akun</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>
                  Nama: <?= $data_akun["nama_lengkap"]; ?><br />
                  Role: <?= $data_akun["role"]; ?>
                </p>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a type="button" href="<?=base_url('admin/hapus_akun/'.$data_akun["username"])?>"
                  class="btn btn-danger"><i class="fas fa-trash-alt"></i> Konfirmasi</a>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <?php endif; ?>
        <?php endforeach; ?>
      </tbody>
      <tfoot>
        <tr>
          <th>No.</th>
          <th>Nama</th>
          <th>Role</th>
          <th>Wilayah</th>
          <th class="text-center"><i class="fas fa-tools"></i></th>
        </tr>
      </tfoot>
    </table>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->

<?= $this->endSection('content') ?>

<?= $this->section('script')?>
<script>
$(document).ready(function() {
  var Toast = Swal.mixin({
    toast: true,
    position: 'top',
    showConfirmButton: false,
    padding: "10px",
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