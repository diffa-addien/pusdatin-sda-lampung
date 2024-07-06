<?php
$col_jenis = array_column($data_kab, 'jenis');
if (!empty(array_count_values($col_jenis)['kota'])) {
    $j_kota = array_count_values($col_jenis)['kota'];
} else { $j_kota = 0;}
if (!empty(array_count_values($col_jenis)['kabupaten'])) {
    $j_kab = array_count_values($col_jenis)['kabupaten'];
} else { $j_kab = 0;}
if (!empty(array_count_values($col_jenis)['kampus'])) {
  $j_kam = array_count_values($col_jenis)['kampus'];
} else { $j_kam = 0;}

$col_role = array_column($data_akun, 'role');
if (!empty(array_count_values($col_role)['kontributor'])) {
  $j_kontributor = array_count_values($col_role)['kontributor'];
} else { $j_kontributor = 0;}
?>
<?=$this->extend('view_publik/frame/p_layout')?>
<?=$this->section('head')?>
<style>
.svh{min-height: calc(85vh - 4rem - 2rem); min-height: calc(85svh - 4rem - 2rem);}
.hero-title{}
.hide-desktop{display:none}
.hero-btn{padding: 7px 20px 7px 20px; max-width:100%;}

.waves{position:relative;width:100%;height:15vh;margin-bottom:-7px;min-height:100px;max-height:150px}
.parallax>use{animation:25s cubic-bezier(.55,.5,.45,.5) infinite move-forever}
.parallax>use:first-child{animation-delay:-2s;animation-duration:7s}
.parallax>use:nth-child(2){animation-delay:-3s;animation-duration:10s}
.parallax>use:nth-child(3){animation-delay:-4s;animation-duration:13s}
.parallax>use:nth-child(4){animation-delay:-5s;animation-duration:20s}
.scrolling-wrapper{
	overflow-x: auto;
}
.logo_wilayah{
  height: 200px;
  object-fit: contain
}

.floating {
	animation-name: floating;
	animation-duration: 3s;
	animation-iteration-count: infinite;
	animation-timing-function: ease-in-out;
	margin-left: 30px;
	margin-top: 5px;
}

.leftLst, .righttLst{
  -webkit-user-select: none; /* Safari */
  -ms-user-select: none; /* IE 10 and IE 11 */
  user-select: none;
}

@keyframes floating {
	0% { transform: translate(0, 0px); }
	50% { transform: translate(0, 15px); }
	100% { transform: translate(0, -0px); }
}

@keyframes move-forever {
  0% {
   transform: translate3d(-90px,0,0);
  }
  100% {
    transform: translate3d(85px,0,0);
  }
}

@media (max-width: 768px) {
  .waves {
    height:15vh;
    min-height:38px;max-height:42px;
  }
  h1 {
    font-size:24px;
  }
  .logo_wilayah{
    height: 125px;
    object-fit: contain
  }
}
@media (max-width: 575px){
  .hero-title{padding: 40px 10px 35px 10px}
  .hide-desktop{display:block}
  .hide-mobile{display:none}
  .hero-btn{max-width:100%; font-size:90%}
}
</style>

<style>
.MultiCarousel { float: left; overflow: hidden; padding: 15px; width: 100%; position:relative; }
.MultiCarousel .MultiCarousel-inner { transition: 1s ease all; float: left; }
.MultiCarousel .MultiCarousel-inner .item { float: left; overflow:hidden; }
.MultiCarousel .MultiCarousel-inner .item img{ width: 100%; height: 150px;object-fit: cover }
.MultiCarousel .MultiCarousel-inner .item > div { text-align: center; padding:2px; margin:10px; background-color:whiteSmoke;border-radius: 10px; overflow:hidden}
.MultiCarousel .leftLst, .MultiCarousel .rightLst { position:absolute; border-radius:50%;top:calc(50% - 20px); }
.MultiCarousel .leftLst { left:0; }
.MultiCarousel .rightLst { right:0; }
.MultiCarousel .leftLst.over, .MultiCarousel .rightLst.over { pointer-events: none; background:#ccc; }
</style>
<?=$this->endSection('head')?>

<?=$this->section('content')?>
<div class="container-fluid bg-primary p-0 mb-3">
  <div class="container d-flex flex-column justify-content-center text-light p-6 svh">
    <div class="row">
      <div class="col-md-6 d-flex flex-column justify-content-center text-sm-start text-center">
        <h1 class="p-6 hero-title">Pusat Data dan Informasi Sumber Daya Air Provinsi Lampung</h1>
        <p class="py-2 hide-mobile">
        Selamat datang di sistem! Kami sangat senang Anda berkunjung. Jika Anda memiliki pertanyaan, jangan ragu untuk menghubungi kami.
        </p>
        <span class="mb-3 hide-mobile">
          <a href="javascript: scrollke('mainmenu')" class="btn btn-warning rounded-0 hero-btn">Selengkapnya <i class="fas fa-chevron-circle-down"></i></a>
        </span>
      </div>
      <div class="col-md-6 text-center mb-4 mb-sm-0" style="">
        <img src="<?=base_url('myassets/lampungbnr.png')?>" alt="demographic image" style="max-height:75vh; width:85%;" class="text-center floating mb-5 p-0">
        <span class="mb-0 hide-desktop">
          <a href="javascript: scrollke('mainmenu')" class="btn btn-warning rounded-0 hero-btn">Selengkapnya <i class="fas fa-chevron-circle-down"></i></a>
        </span>
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
    <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
    <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
    <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
    <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
    </g>
    </svg>
  </div>
  <!--Waves end ------------------------------------------------------------------------------------------------------------------------------------------------ -->
</div>

<div class="container mb-1" id="mainmenu">
  <!-- <div class="scrollme"> -->
    <div class="row text-sm-start text-center border-bottom mb-4 py-3">

      <div class="col-md-6 text-center">
        <!-- <div class="animateme" data-easing="easeinout" data-when="enter" data-opacity="0"
          data-from="0.3" data-to="0" data-translatex="-200"> -->
          <?php if(!empty(profil_sistem('logo_provinsi'))){?>
          <img src="<?=base_url("uploads/data_provinsi/".profil_sistem('logo_provinsi'))?>" alt="Logo Provinsi" class="w-25">
          <?php }else{?>
          <img src="<?=base_url('myassets/default-img/no-image.svg')?>" alt="Logo provinsi tidak ditemukan" class="w-25">
            
          <?php } ?>
        <!-- </div> -->
      </div>

      <div class="col-md-6 d-flex flex-column justify-content-center">
        <!-- <div class="animateme" data-easing="easeinout" data-when="enter" data-opacity="0"
          data-from="0.3" data-to="0" data-translatex="200"> -->
          <h2>Sumber Daya Air Provinsi</h2>
          <p class="fs-5 fw-light">Data sumber daya air yang dikelola oleh Pemerintah Provinsi Lampung.</p>
          <a href="<?=base_url('publik/data_provinsi/?layout=maps')?>" class="btn btn-lg btn-outline-primary">Lihat Sumber Data Air Provinsi</a>
        <!-- </div> -->
      </div>

    </div>
  <!-- </div> -->

  <div class="scrollme">
    <!-- <div class="animateme" data-easing="easeinout" data-when="enter" data-opacity="0"
      data-from="0.8"
      data-to="0"
      data-translatex="-200"> -->
      <h2 class="mb-1">Telusuri Kota</h2>
      <span class="d-inline-block px-3 py-1 mt-2 bg-primary-subtle"><?=$j_kota?> Kota</span> <span class="d-inline-block px-3 py-1 mt-2 bg-primary-subtle"><?=$j_kab?> Kabupaten</span>
      <p class="fs-5 fw-light mt-2">Lihat data sumber daya air berdasarkan kota, sumber daya yang dikelompokkan ini dikelola oleh Pemerintah Daerah Tingkat 2.</p>
      
    <!-- </div> -->
  </div>

  <!-- <div class="container overflow-hidden my-3" >
	  <div class="row scrollme">
		  <div class="MultiCarousel animateme" data-items="2,4,5,6" data-slide="1" id="MultiCarousel"
        data-interval="1000" data-easing="easeinout" data-when="enter" data-opacity=".3" data-from="0.6" data-to="0" data-translatex="200">
        <div class="MultiCarousel-inner">

          <?php foreach ($data_kab as $kab) {?>
            <div class="item">
              <div class="shadow-sm">
                <div class="my-0" style=""><img src="<?=base_url('uploads/data_wilayah/gambar/' . $kab['gambar'])?>" class="card-img-top mt-auto" alt='<?=$kab["nama"]?>'></div>
                <p class="bg-primary-subtle mb-0"><a class="d-inline-block text-black px-1 py-2" style="text-decoration: none;" href="<?=base_url('publik/data_wilayah/' . $kab['id'])?>"><?=$kab["nama"]?></a></p>
              </div>
            </div>
          <?php }?>

        </div>
        <button class="btn btn-primary leftLst"><i class="fa fa-arrow-left"></i></button>
        <button class="btn btn-primary rightLst"><i class="fa fa-arrow-right"></i></button>
      </div>
    </div>
  </div> -->

  <div class="scrolling-wrapper row flex-row flex-nowrap mt-0 pb-4 pt-0 border-bottom pb-5 mb-3">
    <?php 
    foreach ($data_kab as $kab) {
      if($kab["jenis"] == "kota" || $kab["jenis"] == "kabupaten"){
    ?>
    <div class="col-4 col-md-3 col-lg-2">
      <div class="card shadow">
        <img src="<?=base_url('uploads/data_wilayah/gambar/' . $kab['gambar'])?>" onerror="this.src='<?=base_url('myassets/default-img/no-image.svg')?>'" class="card-img-top logo_wilayah p-1" alt="...">
        <div class="card-body p-0">
          <a href="<?=base_url('publik/data_wilayah/'.$kab['id'].'?layout=maps')?>" class="btn btn-primary p-1 pb-2 pt-1 rounded-top-0 w-100"><?=$kab['nama']?></a>
        </div>
      </div>
    </div>
    <?php 
      }
    }?>
  </div>

  <div class="scrollme">
      <h2 class="mb-1">Telusuri Kampus</h2>
      <span class="d-inline-block px-3 py-1 mt-2 bg-primary-subtle"><?=$j_kam?> Kampus</span>
      <p class="fs-5 fw-light mt-2">Lihat data sumber daya air berdasarkan kampus, sumber daya yang dikelompokkan ini dikelola oleh pihak kampus.</p>  
  </div>

  <div class="scrolling-wrapper row flex-row flex-nowrap mt-0 pb-4 pt-0">
    <?php 
    foreach ($data_kab as $kam) {
      if($kam["jenis"] == "kampus"){
    ?>
    <div class="col-4 col-md-3 col-lg-2">
      <div class="card shadow">
        <img src="<?=base_url('uploads/data_wilayah/gambar/' . $kam['gambar'])?>" class="card-img-top logo_wilayah p-1" alt="...">
        <div class="card-body p-0">
          <a href="<?=base_url('publik/data_wilayah/'.$kam['id'].'?layout=maps')?>" class="btn btn-primary p-1 pb-2 pt-1 rounded-top-0 w-100"><?=$kam['nama']?></a>
        </div>
      </div>
    </div>
    <?php 
      }
    }
    ?>
  </div>

</div>

<div class="py-3 pt-4 bg-footer border-bottom mb-0">
  <div class="container-sm mb-0">
    <div class="text-start" style="width: 100%; height: 20px; border-bottom: 1px solid #ddd; text-align: center; margin-bottom: 40px">
      <span class="border" style="font-size: 23px; background-color: #F5F8FD; padding: 5px 15px;">
        Statistik Sistem <!--Padding is optional-->
      </span>
    </div>
    <div class="row mb-3">
      <div class="col-md-3 col-6 ps-md-3">
        <div class="fw-light">Sumber Daya Air Provinsi</div>
        <span class="fs-1"><span data-purecounter-end="<?=count($sda_prov)?>" class="purecounter">0</span> <small>data</small></span>
      </div>
      <div class="col-md-3 col-6 ps-md-3">
        <div class="fw-light">Sumber Daya Air Daerah</div>
        <span class="fs-1"><span data-purecounter-end="<?=count($sda_kab)?>" class="purecounter">0</span>  <small>data</small></span>
      </div>
      <div class="col-md-3 col-6 ps-md-3">
        <div class="fw-light">Jumlah Kontributor</div>
        <span class="fs-1"><span data-purecounter-end="<?=$j_kontributor?>" class="purecounter">0</span> <small>orang</small></span>
      </div>
      <div class="col-md-3 col-6 ps-md-3">
        <div class="fw-light">Kategori Data</div>
        <span class="fs-1"><span data-purecounter-end="<?=count($data_kat)?>" class="purecounter">0</span> <small>kategori</small></span>
      </div>
    </div>
  </div>
</div>


<?=$this->endSection('content')?>

<?=$this->section('script')?>
<script src="<?=base_url('myassets/scrollme-master/jquery.scrollme.js')?>"></script>
<script>
$(document).ready(function () {
  var itemsMainDiv = ('.MultiCarousel');
  var itemsDiv = ('.MultiCarousel-inner');
  var itemWidth = "";

  $('.leftLst, .rightLst').click(function () {
      var condition = $(this).hasClass("leftLst");
      if (condition)
          click(0, this);
      else
          click(1, this)
  });

  ResCarouselSize();

  $(window).resize(function () {
      ResCarouselSize();
  });

  //this function define the size of the items
  function ResCarouselSize() {
      var incno = 0;
      var dataItems = ("data-items");
      var itemClass = ('.item');
      var id = 0;
      var btnParentSb = '';
      var itemsSplit = '';
      var sampwidth = $(itemsMainDiv).width();
      var bodyWidth = $('body').width();
      $(itemsDiv).each(function () {
          id = id + 1;
          var itemNumbers = $(this).find(itemClass).length;
          btnParentSb = $(this).parent().attr(dataItems);
          itemsSplit = btnParentSb.split(',');
          $(this).parent().attr("id", "MultiCarousel" + id);


          if (bodyWidth >= 1200) {
              incno = itemsSplit[3];
              itemWidth = sampwidth / incno;
          }
          else if (bodyWidth >= 992) {
              incno = itemsSplit[2];
              itemWidth = sampwidth / incno;
          }
          else if (bodyWidth >= 480) {
              incno = itemsSplit[1];
              itemWidth = sampwidth / incno;
          }
          else {
              incno = itemsSplit[0];
              itemWidth = sampwidth / incno;
          }
          $(this).css({ 'transform': 'translateX(0px)', 'width': itemWidth * itemNumbers });
          $(this).find(itemClass).each(function () {
              $(this).outerWidth(itemWidth);
          });

          $(".leftLst").addClass("over");
          $(".rightLst").removeClass("over");

      });
  }


  //this function used to move the items
  function ResCarousel(e, el, s) {
      var leftBtn = ('.leftLst');
      var rightBtn = ('.rightLst');
      var translateXval = '';
      var divStyle = $(el + ' ' + itemsDiv).css('transform');
      var values = divStyle.match(/-?[\d\.]+/g);
      var xds = Math.abs(values[4]);
      if (e == 0) {
          translateXval = parseInt(xds) - parseInt(itemWidth * s);
          $(el + ' ' + rightBtn).removeClass("over");

          if (translateXval <= itemWidth / 2) {
              translateXval = 0;
              $(el + ' ' + leftBtn).addClass("over");
          }
      }
      else if (e == 1) {
          var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
          translateXval = parseInt(xds) + parseInt(itemWidth * s);
          $(el + ' ' + leftBtn).removeClass("over");

          if (translateXval >= itemsCondition - itemWidth / 2) {
              translateXval = itemsCondition;
              $(el + ' ' + rightBtn).addClass("over");
          }
      }
      $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
  }

  //It is used to get some elements from btn
  function click(ell, ee) {
      var Parent = "#" + $(ee).parent().attr("id");
      var slide = $(Parent).attr("data-slide");
      ResCarousel(ell, Parent, slide);
  }
});

function scrollke(id){
  var reqId = "#"+id;
  window.scrollTo(0, $(reqId).offset().top-85);
}
</script>

<!-- Browser -->
<script src="<?= base_url('myassets/purecounterjs/dist/purecounter.js')?>"></script>
<script>
  new PureCounter();
</script>

<?=$this->endSection('script')?>