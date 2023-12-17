<?= $this->extend('view_admin/frame/a_layout');?>
<?= $this->section('content')?>
<div class="card">
  <div class="card-body">
    <form action="<?=base_url('Admin/save_profil')?>" method="POST" enctype="multipart/form-data">
      <div class="btn-group mb-2" role="group">
        <button type="button" class="btn btn-outline-secondary mr-1" onclick="history.back()"><i class="fas fa-chevron-left"></i> Kembali</button>
        <button type="submit" class="btn btn-primary px-5 ml-2"><i class="fas fa-save"></i> Simpan</button>
      </div>

      <div class="mb-0 row">
        <div class="col-sm-3">
          <label for="logo_sis" class="col-form-label">Logo Sistem</label>
          <input type="hidden" name="logo_sis_lama" value="<?=profil_sistem("logo_sistem")?>" required>
          <input type="file" accept=".jpg,.png,.jpeg,.svg" name="logo_sis" class="form-control" id="logo_sis" onchange="onFileUpload(this);">
          <div class="d-grid w-100 text-center border p-2">
            <img class="w-100" id="ajaxImgUpload1" alt="Preview Image" src="<?=base_url('uploads/data_provinsi/'.profil_sistem("logo_sistem"))?>" />
          </div>
        </div>
        <div class="col-sm-9">
          <label for="lat" class="col-form-label">Nama Sistem</label>
          <input type="text" name="nama_sistem" class="form-control" id="nama_sistem" placeholder="Nama" value="<?=profil_sistem("nama_sistem")?>" title="Masukan nilai yang valid" required>
          <label for="lat" class="col-form-label">No. Telepon Admin</label>
          <input type="text" name="no_tlp" class="form-control" id="no_tlp" placeholder="Nomor Telepon / Wa" value="<?=profil_sistem("no_tlp")?>" title="Masukan nilai yang valid" required>
          <label for="lat" class="col-form-label">Email Admin</label>
          <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="<?=profil_sistem("email")?>" title="Masukan nilai yang valid" required>
        </div>
      </div>
      <div class="mb-0 row">
        <div class="col-sm-3">
          <label for="logo_prov" class="col-form-label">Logo Provinsi</label>
          <input type="hidden" name="logo_prov_lama" value="<?=profil_sistem("logo_prov")?>" required>
          <input type="file" accept=".jpg,.png,.jpeg,.svg" name="logo_prov" class="form-control" id="logo_prov" onchange="onFileUpload(this);">
          <div class="d-grid w-100 text-center border p-2">
            <img class="w-100" id="ajaxImgUpload2" alt="Preview Image" src="<?=base_url('uploads/data_provinsi/'.profil_sistem("logo_provinsi"))?>" />
          </div>
        </div>
        <div class="col-sm-9">
          <label for="lat" class="col-form-label">Nama Provinsi</label>
          <input type="text" name="nama_provinsi" class="form-control" id="nama_provinsi" placeholder="Nama" value="<?=profil_sistem("nama_provinsi")?>" title="Masukan nilai yang valid" required>
        </div>
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

function onFileUpload(input) {
  //id = id || '#ajaxImgUpload1';
  if(input.id == "logo_sis"){
    var preview = "#ajaxImgUpload1";
  }else{
    var preview = "#ajaxImgUpload2";
  }
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $(preview).attr('src', e.target.result).width(220)
    };
    reader.readAsDataURL(input.files[0]);
  }
}
</script>
<?= $this->endSection()?>