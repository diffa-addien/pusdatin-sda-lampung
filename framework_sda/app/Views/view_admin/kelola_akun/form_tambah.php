<?= $this->extend('view_admin/frame/a_layout');?>
<?= $this->section('content')?>
<div class="card">
  <div class="card-body">
    <form action="<?=base_url('Login/tambah_akun')?>" method="POST" enctype="multipart/form-data">
      <div class="mb-3 row">
        <label for="username" class="col-sm-2 col-form-label">Username</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="username" id="username" placeholder="sampel_user" required>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
          <input type="password" name="password" class="form-control" id="inputPassword">
        </div>
      </div>
      <div class="mb-3 row">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="email" id="email" placeholder="sampel@gmail.com" required>
        </div>
      </div>
      <div class="mb-0 row">
        <div class="col-sm-6">
          <label for="nama_lengkap" class="col-form-label">Nama</label>
          <input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap" placeholder="Nama Lengkap" required>
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
        <select name="val_wilayah" id="val_wilayah" class="form-control" required>
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
</div>

<?= $this->endSection()?>

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
<script>
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
  });
</script>
<?= $this->endSection()?>