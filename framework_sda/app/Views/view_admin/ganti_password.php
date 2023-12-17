<?= $this->extend('view_admin/frame/a_layout');?>
<?= $this->section('content')?>
<div class="card">
  <div class="card-body">
    <div class="btn-group mb-3" role="group">
        <button type="button" class="btn btn-outline-secondary mr-1" onclick="history.back()"><i class="fas fa-chevron-left"></i> Kembali</button>
        <h4 class="pt-1 ml-2">Konfirmasi Password</h4>
    </div>
    <form id="form-cek">
      <div class="mb-2">Masukkan password lama terlebih dahulu</div>
      <div class="input-group mb-3 mt-0">
        
        <div class="input-group-prepend">
          <div class="input-group-text h-100"><i class="fa fa-key"></i></div>
        </div>
        <input type="password" class="form-control" name="pw_lama" id="inputPassword" placeholder="Password Lama">
        <div class="input-group-prepend">
          <div class="input-group-text h-100"><i class="fa fa-eye" role="button" id="togglePassword"></i></div>
        </div>
      </div>
      <button type="submit" class="btn btn-primary px-5"><i class="fa fa-search"></i> Cek</button>
    </form>

    <div id="changePW"></div>
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


  $("#form-cek" ).on("submit", function( event ) {
    var pw_lama = document.getElementById("inputPassword").value;
    $.post('<?=base_url('Login/cekPassword')?>',{user: "<?=session()->get('username')?>", pw_lama : pw_lama},
    function(data, status){
      if(data == "1"){
        console.log(data);
        document.getElementById("changePW").innerHTML = '<form action="<?=base_url("Login/gantiPassword")?>" method="POST" id="gantiPW">'
          +'<div class="mb-2">Masukkan password baru</div>'
            +'<div class="input-group mb-3 mt-0">'
              +'<div class="input-group-prepend">'
                +'<div class="input-group-text h-100"><i class="fa fa-key"></i></div>'
              +'</div>'
              +'<input type="password" class="form-control" name="pw_baru" id="pw_baru" placeholder="Password Baru">'
            +'</div>'
            +'<div class="input-group mb-3 mt-0">'
              +'<div class="input-group-prepend">'
                +'<div class="input-group-text h-100"><i class="fa fa-key"></i></div>'
              +'</div>'
              +'<input type="password" class="form-control" name="pw_baru_konfir" id="inputPassword2" placeholder="Konfirmasi Password">'
              +'<div class="input-group-prepend">'
                +'<div class="input-group-text h-100"><i class="fa fa-eye" role="button" id="togglePassword2"></i></div>'
              +'</div>'
            +'</div>'
          +'<button type="submit" id="submit" class="btn btn-primary px-5"><i class="fa fa-random"></i> Konfirmasi</button>'
          +'</form>';
        const togglePassword2 = document.querySelector('#togglePassword2');
        const password2 = document.querySelector('#inputPassword2');

        togglePassword2.addEventListener('click', function (e) {
          // toggle the type attribute
          const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
          password2.setAttribute('type', type);
          // toggle the eye slash icon
          this.classList.toggle('fa-eye-slash');
        });
        document.getElementById("form-cek").remove();
      }else{
        console.log(data);
        Toast.fire({
          icon: 'error',
          title: 'Password yang anda masukkan salah'
        })
      }

    });
    event.preventDefault();
  });

  const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#inputPassword');

  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
  });
})
</script>
<?= $this->endSection()?>