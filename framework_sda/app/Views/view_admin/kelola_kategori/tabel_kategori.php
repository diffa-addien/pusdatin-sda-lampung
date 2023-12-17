<?= $this->extend('view_admin/frame/a_layout') ?>
<?= $this->section('content') ?>
<style>
.lihat{visibility: hidden;}tr:hover .lihat{visibility: visible;}
</style>
<?php 
function searchKota($id, $kota){foreach ($kota as $kota): if($id==$kota["id"]){return $kota["nama"];}endforeach; return null;}
?>

<div class="card">
  <div class="card-header">
    <h2 class="card-title pt-2"><i class="nav-icon fas fa-tags"></i> <?= $total; ?> Kategori Data</h2>
    <div class="card-tools">
      <a data-toggle="modal" data-target="#modal-tambah" class="btn btn-primary text-end"><i class="fas fa-plus-square mr-2"></i>Tambah kategori</a>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body p-0">
    <table id="tabel_2" class="table table-hover">
      <thead>
        <tr>
          <th>No.</th>
          <th class="w-75">Kategori</th>
          <th class="text-center"><i class="fas fa-tools"></i></th>
        </tr>
      </thead>
      <tbody>
        <?php $count = 1; foreach ($data_kat as $data_kat) : ?>
        <tr>
          <td><?= $count++; ?></td>
          <td><i class="nav-icon fas fa-tag"></i>  <?= $data_kat["nama"];?></td>
          <td  class="text-center">
            <a data-toggle="modal" data-target="#modal-edit-<?=$data_kat["id"]?>" class="btn btn-warning btn-sm"><i class="far fa-edit"></i></a>
            <a data-toggle="modal" data-target="#modal-<?=$data_kat["id"]?>" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
          </td>
        </tr>

        <div class="modal fade" id="modal-edit-<?=$data_kat["id"]?>"> <!-- START modal-edit -->
          <div class="modal-dialog modal-md">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Ubah Nama Kategori</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="<?=base_url('Admin/ubah_kategori/'.$data_kat["id"])?>" method="POST">
                <div class="modal-body">
                    <div class="form-group mb-0">
                      <label for="nama">Nama Kategori</label>
                      <input type="text" class="form-control" id="nama" name="nama" placeholder="<?= $data_kat["nama"];?>" value="<?= $data_kat["nama"];?>" required>
                      <small id="textHelp" class="form-text text-muted">Semua data dalam kategori ini akan ikut terubah mengikuti kategori baru.</small>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane mr-2"></i> Submit</button>
                </div>
              </form>
            </div><!-- /.modal-content -->
          </div>
        </div><!-- END Modal EDIT -->

        <div class="modal fade" id="modal-<?=$data_kat["id"]?>"> <!-- START modal-hapus -->
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-exclamation-triangle"></i> Hapus Kategori</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body pb-0">
                <p>
                  Kategori: <?= $data_kat["nama"]; ?><br/>
                </p>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <a type="button" href="<?=base_url('admin/hapus_kategori/'.$data_kat["id"])?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Konfirmasi</a>
              </div>
            </div>
          </div><!-- /.modal-content -->
        </div> <!-- /.modal-hapus -->
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->

<div class="modal fade" id="modal-tambah">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Kategori</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?=base_url('Admin/tambah_kategori')?>" method="POST">
        <div class="modal-body">
            <div class="form-group mb-0">
              <label for="nama">Nama Kategori</label>
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Kategori Baru" required>
              <small id="textHelp" class="form-text text-muted">Kategori akan digunakan untuk mengorganisasikan data sumber daya air.</small>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane mr-2"></i> Submit</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div>
</div><!-- /.modal-dialog -->


<?= $this->endSection('content') ?>

<?= $this->section('script')?>
<script>
$(document).ready(function() {
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