<?= $this->extend('view_admin/frame/a_layout') ?>
<?= $this->section('content') ?>


<div class="card">
  <div class="card-header">
    <h3 class="card-title pt-2">Tabel Wilayah</h3>
    <div class="card-tools">
      <a href="<?= base_url('Admin/form_tambah_wilayah')?>" class="btn btn-primary text-end"><i class="fas fa-plus-square mr-2"></i>Tambah Data</a>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body p-0">
    <table id="example1" class="table table-bordered table-hover">
      <thead>
        <tr>
          <th class="text-center" style="width:60px">Foto</th>
          <th class="w-50">Nama Wilayah</th>
          <th>Jenis</th>
          <th class="text-center"><i class="fas fa-tools"></i></th>
        </tr>
      </thead>
      <tbody>
        <?php $count=1; foreach ($data_kab as $data_kabupaten) : ?>
        <tr>
          <td>
            <img src="<?= base_url('uploads/data_wilayah/gambar/'.$data_kabupaten["gambar"]); ?>" width="50">
          </td>
          <td><?= $data_kabupaten["nama"]; ?></td>
          <td class="text-capitalize"><?= $data_kabupaten["jenis"]; ?></td>
          <td class="text-center">
            <a href="<?=base_url('admin/form_ubah_wilayah/'.$data_kabupaten["id"])?>" class="btn btn-warning btn-sm"><i class="far fa-edit"></i></a>
            <a data-toggle="modal" data-target="#modal-<?=$data_kabupaten["id"]?>" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
          </td> 
        </tr>
        <div class="modal fade" id="modal-<?=$data_kabupaten["id"]?>">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-exclamation-triangle"></i> Hapus Kabupaten</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>
                  <h2><?= $data_kabupaten["nama"]; ?></h2><br/>
                  Menghapus kabupaten dapat menyebabkan error jika sudah memiliki data sumber daya air.
                </p>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a type="button" href="<?=base_url('admin/hapus_kabupaten/'.$data_kabupaten["id"])?>" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i> Konfirmasi</a>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <?php endforeach; ?>
      </tbody>
      <tfoot>
        <tr>
          <th class="text-center">Foto</th>
          <th>Nama Wilayah</th>
          <th>Jenis</th>
          <th  class="text-center"><i class="fas fa-tools"></i></th>
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