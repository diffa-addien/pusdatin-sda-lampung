<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Diffa Addien Aziz">

  <!-- Bootstrap 4 -->
  <link href="<?= base_url('myassets/bootstrap-5.3.0/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="<?= base_url('adminlte-3.2/plugins/fontawesome-free/css/all.min.css')?>" crossorigin="anonymous" referrerpolicy="no-referrer" />
	
  <title><?=$title?></title>

  <style>
	.input-group i{
		min-width: 20px;
	}
	.main-content{
		width: 50%;
		border-radius: 20px;
		box-shadow: 0 5px 5px rgba(0,0,0,.4);
		margin: 5em auto;
		display: flex;
	}
	.company__info{
		border-top-left-radius: 20px;
		border-bottom-left-radius: 20px;
		display: flex;
		flex-direction: column;
		justify-content: center;
		color: #fff;
	}

	.fa-android{
		font-size:3em;
	}
	@media screen and (max-width: 640px) {
		.main-content{width: 90%;}
		.company__info{
			display: none;
		}
		.login_form{
			border-top-left-radius:20px;
			border-bottom-left-radius:20px;
		}
	}
	@media screen and (min-width: 642px) and (max-width:800px){
		.main-content{width: 70%;}
	}

	.login_form{
		background-color: #fff;
		border-top-right-radius:20px;
		border-bottom-right-radius:20px;
		border-top:1px solid #ccc;
		border-right:1px solid #ccc;
	}

.waves{position:relative;width:100%;margin-bottom:-7px;height:10vh}
.parallax>use{animation:25s cubic-bezier(.55,.5,.45,.5) infinite move-forever}
.parallax>use:first-child{animation-delay:-2s;animation-duration:7s}
.parallax>use:nth-child(2){animation-delay:-3s;animation-duration:10s}
.parallax>use:nth-child(3){animation-delay:-4s;animation-duration:13s}
.parallax>use:nth-child(4){animation-delay:-5s;animation-duration:20s}

@keyframes move-forever {
  0% {
   transform: translate3d(-90px,0,0);
  }
  100% { 
    transform: translate3d(85px,0,0);
  }
}
  </style>

</head>
<body class="bg-body-secondary">
	<!-- Main Content -->
	<div class="container-fluid d-flex align-items-center justify-content-center" style="height: 90vh;">
		<div class="row main-content bg-primary text-center">
			<div class="col-md-4 text-center company__info bg-primary">
				<span class="company__logo"><h2><i class="fas fa-faucet"></i></h2></span>
				<h4 class="company_title"><?=profil_sistem("nama_sistem")?></h4>
			</div>
			<div class="col-md-8 col-xs-12 col-sm-12 login_form">
				<div class="container-fluid">
					<div class="row py-3">
						<h2>Registrasi</h2>
						<span>Silahkan isi data akun kontributor anda</span>
					</div>
					<?php if (session()->getFlashdata('pesan')) { ?>
            <div class="p-2 my-2 bg-warning rounded">
            <?php echo session()->getFlashdata('pesan') ?>
            </div>
					<?php } ?>
					<div class="row">
						<form action="<?=base_url('Login/tambah_akun')?>" method="POST" class="form-group" enctype="multipart/form-data">
							<input type="hidden" name="status" value="tertunda">
							<input type="hidden" name="role" value="kontributor">
							
							<div class="input-group mb-2">
								<div class="input-group-prepend">
									<div class="input-group-text h-100"><i class="fa fa-user"></i></div>
								</div>
								<input type="text" name="username" id="username" pattern="[^' ']+" class="form-control" placeholder="Username" required>
							</div>
							
							<div class="input-group mb-2">
								<div class="input-group-prepend">
									<div class="input-group-text h-100"><i class="fa fa-key"></i></div>
								</div>
								<input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
								<div class="input-group-prepend">
									<div class="input-group-text h-100"><i class="fa fa-eye"  role="button" id="togglePassword"></i></div>
								</div>
							</div>

							<div class="input-group mb-2">
								<div class="input-group-prepend">
									<div class="input-group-text h-100"><i class="fa fa-at"></i></div>
								</div>
								<input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
							</div>

							<div class="input-group mb-2">
								<div class="input-group-prepend">
									<div class="input-group-text h-100"><i class="fa fa-address-card"></i></div>
								</div>
								<input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" placeholder="Nama Lengkap" required>
							</div>

							<div class="input-group mb-2">
								<div class="input-group-prepend">
									<div class="input-group-text h-100"><i class="fa fa-map"></i></div>
								</div>
								<select name="val_wilayah" id="val_wilayah" class="form-control" required>
									<option value="" hidden>- Pilih Wilayah -</option>
									<?php foreach ($wilayah as $wilayah):?>
									<option value="<?=$wilayah["id"]?>"><?=$wilayah["nama"]?></option>
									<?php endforeach ?>
								</select>
							</div>

							<div class="form-group mt-3 mb-0">
								<label class="float-left pt-2 pb-3 text-start">
                	<input id="login-policy" type="checkbox" name="ketentuan" required> Setuju dengan syarat dan ketentuan yang berlaku
              	</label>
								<div class="form-row w-100">
									<a href="javascript: history.back()" class="btn btn-outline-secondary col-4 me-3">Kembali</a>
									<input type="submit" name="login" class="btn btn-primary float-right col-6" value="Submit" />
								</div>
							</div>
							
						</form>
					</div>
					<div class="row">
						<p class="text-weight-bold">
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>

  <!--Waves Container-->
  <div class="align-self-end">
    <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
    viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
    <defs>
    <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
    </defs>
    <g class="parallax">
    <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(13, 110, 253,0.5" />
    <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(13, 110, 253,0.3)" />
    <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(13, 110, 253,0.1)" />
    <use xlink:href="#gentle-wave" x="48" y="7" fill="rgba(13, 110, 253,0.8)" />
    </g>
    </svg>
  </div>
  <!--Waves end-->

  <script src="<?= base_url('myassets/bootstrap-5.3.0/js/bootstrap.bundle.min.js')?>"></script>
	<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#inputPassword');
 
    togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
    });
	</script>
</body>
</html>