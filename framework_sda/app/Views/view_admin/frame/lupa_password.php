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
	.svh{min-height: 90vh; min-height: 90svh;}
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
	form{
		padding: 0 2em;
	}
	.form__input{
		width: 90%;
		border:0px solid transparent;
		border-radius: 0;
		border-bottom: 1px solid #aaa;
		padding: 1em .5em .5em;
		padding-left: 2em;
		outline:none;
		margin:1.0em auto;
		transition: all .5s ease;
	}
	.form__input:focus{
		border-bottom-color: #008080;
		box-shadow: 0 0 5px rgba(0,80,80,.4); 
		border-radius: 4px;
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
	<div class="container-fluid d-flex align-items-center justify-content-center svh">
		<div class="row main-content bg-primary text-center">
			<div class="col-md-4 text-center company__info bg-primary">
				<span class="company__logo"><h2><i class="fas fa-faucet"></i></h2></span>
				<h4 class="company_title"><?=profil_sistem("nama_sistem")?></h4>
			</div>
			<div class="col-md-8 col-xs-12 col-sm-12 login_form ">
				<div class="container-fluid text-start pb-1">
          <div class="pt-3 text-start">
					  <h5 class="my-3 fw-bolder">Petunjuk Lupa Password</h5>
            <p class="mb-3">Silahkan hubungi email: <a href="mailto:<?=profil_sistem("email")?>"><?=profil_sistem("email")?></a> lalu sebutkan kendala yang ada, bahwa anda lupa password dengan meyertakan data akun anda seperti username, email, dan role anda.</p>
          </div>
          <a href="javascript: history.back()" class="btn btn-outline-secondary col-4 mb-4">Kembali</a>
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