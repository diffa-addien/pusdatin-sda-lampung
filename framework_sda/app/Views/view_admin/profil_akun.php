<?= $this->extend('view_admin/frame/a_layout');?>
<?= $this->section('content')?>
<div class="card">
  <div class="card-body">
    <form action="<?=base_url('Admin/save_profil_akun/'.session()->get('username'))?>" method="POST" enctype="multipart/form-data">
      <div class="btn-group mb-2" role="group">
        <button type="button" class="btn btn-outline-secondary mr-1" onclick="history.back()"><i
            class="fas fa-chevron-left"></i> Kembali</button>
        <button type="submit" class="btn btn-primary px-5 ml-2"><i class="fas fa-save"></i> Simpan</button>
      </div>

      <table class="table">
        <tbody>
          <tr>
            <td colspan="2" class="text-center">
              <input type="hidden" name="foto_lama" value="<?=$akun["foto"]?>" required>
              <img id="ajaxImgUpload1" alt="Preview Image" src="<?=base_url('uploads/akun/foto_profil/'.$akun["foto"])?>" onerror="this.src='<?=base_url('myassets/default-img/person-svg.svg')?>'" class="w-25 border">
              <br class="mb-0"/><br class=""/>
              Ganti foto: 
              <input type="file" accept=".jpg,.png,.jpeg,.svg" name="foto_profil" class="w-50 border mt-0" id="foto" onchange="onFileUpload(this);">
            </td>
          </tr>
          <tr>
            <th scope="row" class="w-25">Username</th>
            <td>: <?=$akun["username"]?></td>
          </tr>
          <tr>
            <th scope="row">Nama Lengkap</th>
            <td><input type="text" name="nama_lengkap" id="nama_lengkap" value="<?=$akun["nama_lengkap"]?>" placeholder="sebelumnya: <?=$akun["nama_lengkap"]?>" class="form-control"></td>
          </tr>
          <tr>
            <th scope="row">E-Mail</th>
            <td><input type="text" name="email" id="email" value="<?=$akun["email"]?>" placeholder="sebelumnya: <?=$akun["email"]?>" class="form-control"></td>
          </tr>
          <tr>
            <th scope="row">Role</th>
            <td>: <?=$akun["role"]?></td>
          </tr>
          <tr>
            <th scope="row">Wilayah</th>
            <td>: <?=$akun["wilayah"]?></td>
          </tr>
          <tr>
            <th scope="row">Tanggal Dibuat</th>
            <td>: <?=$akun["tanggal_dibuat"]?></td>
          </tr>
        </tbody>
      </table>

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

function onFileUpload(input) {
  //id = id || '#ajaxImgUpload1';
  if (input.id == "foto") {
    var preview = "#ajaxImgUpload1";
  }
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $(preview).attr('src', e.target.result)
    };
    reader.readAsDataURL(input.files[0]);
  }
}
</script>
<?= $this->endSection()?>