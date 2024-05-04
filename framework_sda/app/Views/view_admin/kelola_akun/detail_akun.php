<?= $this->extend('view_admin/frame/a_layout');?>
<?= $this->section('content')?>
<div class="card">
  <div class="card-header">
    <button onclick="history.back()" class="btn btn-outline-primary pr-3"><i class="fas fa-chevron-left mr-2"></i>Kembali</button>
  </div>
  <div class="card-body">
    <table class="table">
    <tbody>
    <tr>
      <td colspan="2" class="text-center"><img src="<?=base_url('uploads/akun/foto_profil/'.$akun["foto"])?>" onerror="this.src='<?=base_url('myassets/default-img/person-svg.svg')?>'" class="w-25 border"></td>
    </tr>
    <tr>
      <th scope="row" class="w-25">Username</th>
      <td>: <?=$akun["username"]?></td>
    </tr>
    <tr>
      <th scope="row">Nama Lengkap</th>
      <td>: <?=$akun["nama_lengkap"]?></td>
    </tr>
    <tr>
      <th scope="row">E-Mail</th>
      <td>: <?=$akun["email"]?></td>
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
  </div>
</div>

<?= $this->endSection()?>

<?= $this->section('script')?>
<script>
</script>
<?= $this->endSection()?>