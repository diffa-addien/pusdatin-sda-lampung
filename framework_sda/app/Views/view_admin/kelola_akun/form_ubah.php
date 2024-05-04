<?= $this->extend('view_admin/frame/a_layout');?>
<?= $this->section('content')?>
<div class="card">
  <div class="card-body">
    <form action="<?=base_url('Admin/ubah_akun')?>" method="POST">
      <div class="mb-3 row">
        <label for="username" class="col-sm-2 col-form-label">Username</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="username" id="username" placeholder="sampel_user" value="<?=$akun["username"]?>" readonly>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-8">
          <input type="password" name="password" class="form-control" id="inputPassword" value="<?=$akun["password"]?>" disabled>
        </div>
        <div class="col-sm-2 pt-2 pt-sm-0">
          <button type="button" class="btn btn-warning w-75" data-toggle="modal" data-target="#exampleModal">
            Ubah Sandi
          </button>
        </div>
        
      </div>
      <div class="mb-3 row">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="email" id="email" placeholder="sampel@gmail.com" value="<?=$akun["email"]?>" required>
        </div>
      </div>
      <div class="mb-0 row">
        <div class="col-sm-6">
          <label for="nama_lengkap" class="col-form-label">Nama Lengkap</label>
          <input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap" placeholder="Nama Lengkap" value="<?=$akun["nama_lengkap"]?>" required>
        </div>
        <div class="col-sm-6">
          <label for="role" class="col-form-label">Role</label>
          <select name="role" id="role" class="form-control" required>
            <option value="" hidden>- Pilih -</option>
            <option value="admin_utama">Admin Utama</option>
            <option value="admin_provinsi">Admin Provinsi</option>
            <option value="kontributor">Kontributor</option>
          </select>
        </div>
      </div>
      <div id="wilayah" class="d-none">
        <label for="val_wilayah" class="col-form-label">Wilayah</label>
        <select name="val_wilayah" id="val_wilayah" class="form-control">
          <option value="" hidden>- Pilih -</option>
          <option value="semua" class="d-none"></option>
          <option value="provinsi" class="d-none"></option>
          <?php foreach ($kota as $kota):?>
          <option value="<?=$kota["id"]?>"><?=$kota["nama"]?></option>
          <?php endforeach ?>
        </select>
      </div>

      <div class="btn-group mt-4" role="group">
        <button type="button" class="btn btn-outline-primary" onclick="history.back()"><i class="fas fa-chevron-left"></i> Kembali</button>
        <button type="submit" class="btn btn-primary px-5 ml-2"><i class="fas fa-save"></i> Simpan</button>
      </div>

    </form>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ubah Password Milik: <?=$akun["username"]?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?=base_url("Admin/ubah_pw/".$akun["username"])?>" method="post">
          <div class="modal-body">
          <div class="mb-3 row">
            <label for="pw" class="col-sm-3 mb-2 col-form-label">Password Baru</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="pw_baru" required>
            </div>
            <label for="pw" class="col-sm-3 col-form-label">Ulangi</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="pw_baru_konfir" required>
            </div>
          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-warning">Konfirmasi</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection()?>

<?= $this->section('script')?>
<script>
$(document).ready( function () {
  $('#role').val('<?=$akun["role"]?>').change();
  $('#val_wilayah').val('<?=$akun["wilayah"]?>').change();

  if( $('#role').val() == "admin_kabupaten" ){
    $('#wilayah').removeClass('d-none').addClass('d-block');
  }
});
$('#role').change(function() {
  if( $('#role').val() == "kontributor" ){
    $('#wilayah').removeClass('d-none d-block').addClass('d-block');
    $('#val_wilayah').val('');
  }else if( $('#role').val() == "admin_utama" ){
    $('#wilayah').removeClass('d-none d-block').addClass('d-none');
    $('#val_wilayah').val('semua').change();
  }else{
    $('#wilayah').removeClass('d-none d-block').addClass('d-none');
    $('#val_wilayah').val('provinsi').change();
  }

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

});
</script>
<?= $this->endSection()?>