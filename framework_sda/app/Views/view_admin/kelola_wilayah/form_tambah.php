<?= $this->extend('view_admin/frame/a_layout');?>
<?= $this->section('content')?>
<div class="card">
  <div class="card-body">
    <?php if(!empty(session()->getFlashData('error'))):
      echo session()->getFlashData('error');
      ?>

    <?php endif ?>

    <form action="<?=base_url('Admin/tambah_wilayah')?>" method="POST" enctype="multipart/form-data">
      <div class="mb-3 row">
        <label for="kota" class="col-sm-2 col-form-label">Nama Wilayah</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="kota" id="kota" placeholder="Bandar Lampung" required>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="jenis" class="col-sm-2 col-form-label">Jenis</label>
        <div class="col-sm-10">
          <select name="jenis" id="jenis" class="form-control" required>
            <option value="" hidden> - Pilih -</option>
            <option value="kabupaten">Kabupaten</option>
            <option value="kota">Kota</option></option>
            <option value="kampus">Kampus</option></option>
          </select>
        </div>
      </div>
      <div class="mb-0 row">
        <div class="col-sm-6">
          <label for="gambar" class="col-form-label">Gambar</label>
          <input type="file" accept=".jpg,.png,.jpeg,.svg" name="gambar" class="form-control-file" id="gambar" onchange="onFileUpload(this);" required>
          <div class="d-grid w-100 text-center border p-2">
            <img class="" id="ajaxImgUpload" alt="Preview Image" src="" />
          </div>
        </div>
        <div class="col-sm-6">
          <label for="lat" class="col-form-label">Koordinat</label>
          <small id="passwordHelpBlock" class="form-text text-muted">Latitude</small>
          <input type="text" name="lat" class="form-control" id="lat" placeholder="Latitude: -5.450000" pattern="[\-.0-9]{2,}" title="Masukan nilai yang valid" required>
          <small id="passwordHelpBlock" class="form-text text-muted">Longitude</small>
          <input type="text" name="long" class="form-control" id="long" placeholder="Longitude: 105.266670" pattern="[\-.0-9]{2,}" title="Masukan nilai yang valid" required>
        </div>
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
  function onFileUpload(input, id) {
    id = id || '#ajaxImgUpload';
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $(id).attr('src', e.target.result).width(220)
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
<?= $this->endSection()?>