<?= $this->extend('view_admin/frame/a_layout');?>
<?= $this->section('content')?>
<style>
.was-validated .form-control:valid {
  border-color: grey !important;
  padding-right: 5px !important;
  background: inherit !important
}
</style>
<div class="card">
  <div class="card-body">
    <?php if(!empty(session()->getFlashData('error'))):
        echo "<div class='bg-warning text-white rounded p-2'>".session()->getFlashData('error')."</div>";
      ?>
    <?php endif ?>

    <form class="was-validated" action="<?=base_url('Admin/ubah_sda_prov/'.$data_SDA['id'])?>" method="POST"
      enctype="multipart/form-data">
      <div class="mb-3 row">
        <div class="col-8">
          <label for="judul_data" class="col-form-label">Nama Data</label>
          <div class="">
            <input type="text" class="form-control" name="judul_data" id="judul_data" value="<?=$data_SDA['judul_data']?>" required>
          </div>
        </div>
        <div class="col-4">
          <label for="tahun" class="col-form-label"><i class="fas fa-calendar-alt mr-1"></i>Data Tahun</label>
          <div class="">
            <input type="number" class="form-control" name="tahun" id="tahun" min="2000" max="2999"
              value="<?=$data_SDA['tahun']?>" placeholder="Tahun" required>
          </div>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="id_kategori" class="col-sm-2 col-form-label">Ketegori</label>
        <div class="col-sm-10">
          <select name="id_kategori" id="id_kategori" class="form-control" required>
            <option value="" hidden> - Pilih -</option>
            <?php foreach ($kategori as $kat): ?>
            <option value="<?=$kat["id"]?>"><?=$kat["nama"]?></option>
            <?php endforeach ?>
          </select>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="isi" class="col-sm-2 col-form-label">Deskripsi</label>
        <textarea name="isi" class="form-control mx-2" rows="5" required><?=$data_SDA['isi_data']?></textarea>
      </div>
      <div class="mb-3 row">
        <div class="col-sm-6">
          <label for="gambar" class="col-form-label">Gambar <small class="text-muted">opsional</small></label>
          <input type="hidden" name="gambar_sebelumnya" value="<?=$data_SDA["gambar"]?>" required>
          <input type="file" accept=".jpg,.png,.jpeg,.svg" name="gambar" class="form-control" id="gambar"
            onchange="onFileUpload(this);">
          <div class="d-grid text-center border p-2" style="width: 100%">
            <img class="w-100" id="ajaxImgUpload" alt="[ Belum ada gambar ]" src="<?=base_url('uploads/sda_provinsi/gambar/'.$data_SDA["gambar"])?>" />
          </div>
        </div>
        <div class="col-sm-6">
          <label for="lat" class="col-form-label">Dokumen <small class="text-muted">opsional</small></label>
          <select name="tipe_dokumen" id="tipe_dokumen" class="form-control" required>
            <option value="link">Link / URL</option>
            <option value="upload">Upload (Max: 10mb)</option>
          </select>
          <input type="text" name="link_dokumen" class="form-control" id="link_dokumen" placeholder="Paste link disini"
            title="Masukan nilai yang valid">
          <input type="hidden" name="dokumen_sebelumnya" value="<?=$data_SDA["dokumen"]?>" required>
          <input type="hidden" name="tipe_sebelumnya" value="<?=$data_SDA["tipe_dokumen"]?>" required>
          <input type="file" accept=".doc,.docx,.pdf,.xls,.xlsx,.zip" id="upload_dokumen" name="upload_dokumen" class="form-control d-none"
            title="Masukan nilai yang valid">
          <div class="p-1 border rounded-0">Sebelumnya: <?=$data_SDA["dokumen"] == "" ? "Tanpa Dokumen!" : "[".$data_SDA["tipe_dokumen"]."] ".$data_SDA["dokumen"]?> (<?=$data_SDA["ket_dokumen"] == "" ? "Tanpa Keterangan" : $data_SDA["ket_dokumen"]?>)</div>
          <div class="pl-1">
            <span>Ket. File: </span>
            <input type="checkbox" id="doc" name="doc" value="Doc">
            <label for="doc"> Doc</label>
            <input type="checkbox" id="excel" name="excel" value="Excel">
            <label for="excel"> Excel</label>
            <input type="checkbox" id="ppt" name="ppt" value="PPT">
            <label for="ppt"> PPT</label>
            <input type="checkbox" id="gambar_ket" name="gambar_ket" value="Gambar">
            <label for="gambar_ket"> Gambar</label>
            <input type="hidden" name="ket_sebelumnya" value="<?=$data_SDA["ket_dokumen"]?>" required>
            <br/>
            <small >*Abaikan jika tidak ada perubahan dokumen atau keterangan</small>
          </div>
          
        </div>
      </div>
      <div class="border rounded">
        <label class="border-bottom w-100 px-3 py-2" style="background-color:#ddd">
          File GEOJSON / KML <small title="Dibutuhkan untuk menampilkan data dalam map">*Dibutuhkan setidaknya 1 file <b>geojson</b> atau <b>kml</b>
            untuk menampilkan data ke dalam peta</small>
        </label>
        <div class="m-2 row">
          <label for="geojson" class="col-sm-2 col-form-label">Titik <span class="text-warning" data-toggle="tooltip"
            data-placement="top" title="Untuk: Titik Lokasi / Bangunan"><i class="far fa-question-circle"></i></label>
          <input type="hidden" name="geotitik_sebelumnya" value="<?=$data_SDA["geojson_titik"]?>" required>
          <input type="file" name="geojson_titik" id="geojson_titik" accept=".geojson,.kml" class="form-control col mx-2" rows="5">
          <span class="col-3">Sebelumnya: <?=$data_SDA["geojson_titik"] == "" ? "Tidak Ada" : "Ada" ?></span>
        </div>
        <div class="mx-2 row">
          <label for="geojson" class="col-sm-2 col-form-label">Garis <span class="text-warning" data-toggle="tooltip"
            data-placement="top" title="Untuk: Saluran / Aliran / Garis">
            <i class="far fa-question-circle"></i>
          </label>
          <input type="hidden" name="geogaris_sebelumnya" value="<?=$data_SDA["geojson_garis"]?>" required>
          <input type="file" name="geojson_garis" id="geojson_garis" accept=".geojson,.kml" class="form-control col mx-2" rows="5">
          <span class="col-3">Sebelumnya: <?=$data_SDA["geojson_garis"] == "" ? "Tidak Ada" : "Ada" ?></span>
        </div>
        <div class="m-2 row">
          <label for="geojson" class="col-sm-2 col-form-label">Petak <span class="text-warning" data-toggle="tooltip"
            data-placement="top" title="Untuk: Petak / Bentuk / Polygon">
            <i class="far fa-question-circle"></i>
          </label>
          <input type="hidden" name="geopetak_sebelumnya" value="<?=$data_SDA["geojson_petak"]?>" required>
          <input type="file" name="geojson_petak" id="geojson_petak" accept=".geojson,.kml" class="form-control col mx-2" rows="5">
          <span class="col-3">Sebelumnya: <?=$data_SDA["geojson_petak"] == "" ? "Tidak Ada" : "Ada" ?></span>
        </div>
        
      </div>

      <div class="btn-group mt-4" role="group">
        <button type="button" class="btn btn-outline-primary" onclick="history.back()"><i
            class="fas fa-chevron-left"></i> Kembali</button>
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
    reader.onload = function(e) {
      $(id).attr('src', e.target.result).width(220)
    };
    reader.readAsDataURL(input.files[0]);
  }
}
</script>
<script>
$('#tipe_dokumen').change(function() {
  if( $('#tipe_dokumen').val() == "upload" ){
    $('#upload_dokumen').removeClass('d-none d-block').addClass('d-block');
    $('#link_dokumen').removeClass('d-none d-block').addClass('d-none');
    $('#link_dokumen').val('').change();
  }else{
    $('#link_dokumen').removeClass('d-none d-block').addClass('d-block');
    $('#upload_dokumen').removeClass('d-none d-block').addClass('d-none');
    $('#upload_dokumen').val('').change();
  }
});

$('#id_kategori').val('<?=$data_SDA["id_kategori"]?>').change();

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

$(function() {
  $('[data-toggle="tooltip"]').tooltip();
});
</script>
<?= $this->endSection()?>