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
        <h1 class="p-6 fw-bolder">Pusat Data Sumber Daya Air Provinsi Lampung</h1>
        <p class="py-2">
        Selamat datang di sistem! Kami sangat senang Anda berkunjung. Jika Anda memiliki pertanyaan, jangan ragu untuk menghubungi kami.
        </p>
        <span class="mb-3">
          <a href="javascript: scrollke('mainmenu')" class="btn btn-warning btn-lg btn-block rounded-0 text-center" style="width:240px; max-width:100%">Selengkapnya <i class="fas fa-chevron-circle-down"></i></a>
        </span>
      </div>
      <div class="col-md-6 text-center mb-4 mb-sm-0" style="">
        <img src="<?=base_url('myassets/lampungbnr.png')?>" style="max-height:75vh; width:85%;" class="text-center floating p-0">
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
          <img src="<?=base_url("uploads/data_provinsi/".profil_sistem('logo_provinsi'))?>" class="w-25">
          <?php }else{?>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 300" data-imageid="full-inbox-0" imageName="Empty Inbox" class="illustrations_image" style="width: 209px;"><g id="_296_empty_inbox_outline" data-name="#296_empty_inbox_outline"><path d="M287.57,149.09l-32.58-44a7.2,7.2,0,0,0-5.8-2.92H150.81a7.2,7.2,0,0,0-5.8,2.92l-32.58,44v53.62a11,11,0,0,0,11,11H276.59a11,11,0,0,0,11-11Z" fill="#093f68"/><path d="M276.59,214.69H123.41a12,12,0,0,1-12-12V149.09a1,1,0,0,1,.19-.6l32.58-44a8.26,8.26,0,0,1,6.61-3.33h98.38a8.26,8.26,0,0,1,6.61,3.33l32.58,44a1,1,0,0,1,.19.6v53.62A12,12,0,0,1,276.59,214.69ZM113.43,149.42v53.29a10,10,0,0,0,10,10H276.59a10,10,0,0,0,10-10V149.42l-32.38-43.75a6.25,6.25,0,0,0-5-2.52H150.81a6.25,6.25,0,0,0-5,2.52Z" fill="#093f68"/><path d="M287.57,149.09v53.62a11,11,0,0,1-11,11H123.41a11,11,0,0,1-11-11V149.09h47.41l4.46,22a8.75,8.75,0,0,0,8.58,7h54.84a8.78,8.78,0,0,0,8.62-7.15l4.12-21.91Z" fill="#68e1fd" class="target-color"/><path d="M276.58,214.69H123.41a12,12,0,0,1-12-12V149.09a1,1,0,0,1,1-1h47.41a1,1,0,0,1,1,.8l4.46,22a7.77,7.77,0,0,0,7.6,6.23h54.84a7.77,7.77,0,0,0,7.63-6.34l4.12-21.91a1,1,0,0,1,1-.81h47.11a1,1,0,0,1,1,1v53.62A12,12,0,0,1,276.58,214.69Zm-163.15-64.6v52.62a10,10,0,0,0,10,10H276.58a10,10,0,0,0,10-10V150.09H241.29l-4,21.09a9.78,9.78,0,0,1-9.6,8H172.88a9.77,9.77,0,0,1-9.56-7.83L159,150.09Z" fill="#093f68"/><path d="M150.9,191.86H131.26a1,1,0,0,1,0-2H150.9a1,1,0,0,1,0,2Z" fill="#093f68"/><path d="M164.5,89a2,2,0,0,1-1.59-.8l-13.61-18a2,2,0,0,1,3.2-2.41l13.6,18a2,2,0,0,1-.39,2.8A2,2,0,0,1,164.5,89Z" fill="#dfeaef"/><path d="M228.94,89a2.05,2.05,0,0,1-1.21-.41,2,2,0,0,1-.39-2.8l13.61-18a2,2,0,0,1,3.19,2.41l-13.6,18A2,2,0,0,1,228.94,89Z" fill="#dfeaef"/><path d="M198.29,83a2,2,0,0,1-2-2V56.15a2,2,0,0,1,4,0V81A2,2,0,0,1,198.29,83Z" fill="#dfeaef"/><rect x="231.96" y="184.22" width="65.37" height="34.09" rx="3.89" fill="#ffbc0e"/><path d="M293.44,219.32H235.85a4.9,4.9,0,0,1-4.89-4.89V188.11a4.9,4.9,0,0,1,4.89-4.89h57.59a4.9,4.9,0,0,1,4.89,4.89v26.32A4.9,4.9,0,0,1,293.44,219.32Zm-57.59-34.1a2.89,2.89,0,0,0-2.89,2.89v26.32a2.89,2.89,0,0,0,2.89,2.89h57.59a2.9,2.9,0,0,0,2.89-2.89V188.11a2.9,2.9,0,0,0-2.89-2.89Z" fill="#093f68"/><path d="M241.81,194.5h7.66v2.3h-5.18v2.1h4.89v2.29h-4.89v2.3h5.46v2.29h-7.94Z" fill="#093f68"/><path d="M251.44,198h2.3v1.05h0a1.59,1.59,0,0,1,.32-.44,2,2,0,0,1,.49-.4,3,3,0,0,1,.65-.29,2.92,2.92,0,0,1,.8-.11,3.06,3.06,0,0,1,1.44.33,2.15,2.15,0,0,1,.95,1.06,2.55,2.55,0,0,1,1-1.07,3.46,3.46,0,0,1,2.77-.06,2.27,2.27,0,0,1,.84.72,3,3,0,0,1,.45,1.07,6,6,0,0,1,.13,1.31v4.57h-2.39v-4.51a1.83,1.83,0,0,0-.23-.93.87.87,0,0,0-.82-.39,1.54,1.54,0,0,0-.69.14,1.1,1.1,0,0,0-.45.37,1.67,1.67,0,0,0-.24.56,2.87,2.87,0,0,0-.07.67v4.09h-2.39v-4.09c0-.14,0-.31,0-.51a1.94,1.94,0,0,0-.12-.58,1,1,0,0,0-.31-.46,1,1,0,0,0-.63-.19,1.47,1.47,0,0,0-.74.17,1.1,1.1,0,0,0-.44.44,1.86,1.86,0,0,0-.2.63,5.87,5.87,0,0,0,0,.74v3.85h-2.39Z" fill="#093f68"/><path d="M265.52,198h2.2v1h0a2.4,2.4,0,0,1,.38-.42,2.2,2.2,0,0,1,.54-.39,3.66,3.66,0,0,1,.67-.29,2.9,2.9,0,0,1,.79-.11,4.13,4.13,0,0,1,1.56.29,3.74,3.74,0,0,1,1.2.83,3.79,3.79,0,0,1,.77,1.27,4.61,4.61,0,0,1,.27,1.61,5,5,0,0,1-.24,1.55,4.25,4.25,0,0,1-.71,1.31,3.36,3.36,0,0,1-1.1.92,3.13,3.13,0,0,1-1.48.34,4,4,0,0,1-1.4-.23,2.18,2.18,0,0,1-1.06-.79h0v4.46h-2.39Zm2.2,3.87a2,2,0,0,0,.5,1.42,1.85,1.85,0,0,0,1.41.54,1.82,1.82,0,0,0,1.41-.54,2.27,2.27,0,0,0,0-2.84,1.82,1.82,0,0,0-1.41-.54,1.85,1.85,0,0,0-1.41.54A2,2,0,0,0,267.72,201.91Z" fill="#093f68"/><path d="M280.61,200H278.5v2.58a3.45,3.45,0,0,0,0,.58,1.08,1.08,0,0,0,.14.46.76.76,0,0,0,.34.29,1.48,1.48,0,0,0,.61.11c.13,0,.3,0,.51,0a.88.88,0,0,0,.47-.19v2a3.44,3.44,0,0,1-.83.19,6.15,6.15,0,0,1-.85.05,4.33,4.33,0,0,1-1.11-.13,2.5,2.5,0,0,1-.89-.4,1.86,1.86,0,0,1-.6-.73,2.47,2.47,0,0,1-.22-1.08V200h-1.53V198h1.53v-2.29h2.39V198h2.11Z" fill="#093f68"/><path d="M286.28,207c-.16.41-.32.78-.47,1.1a2.35,2.35,0,0,1-.56.8,2.19,2.19,0,0,1-.87.5,4.75,4.75,0,0,1-1.38.16,5.63,5.63,0,0,1-1.79-.28l.32-2a2.71,2.71,0,0,0,1.11.24,2,2,0,0,0,.66-.09,1,1,0,0,0,.42-.26,1.5,1.5,0,0,0,.28-.4l.24-.56.17-.45L281,198h2.58l2,5.11h0l1.71-5.11h2.45Z" fill="#093f68"/></g></svg>
          <?php } ?>
        <!-- </div> -->
      </div>

      <div class="col-md-6 d-flex flex-column justify-content-center">
        <!-- <div class="animateme" data-easing="easeinout" data-when="enter" data-opacity="0"
          data-from="0.3" data-to="0" data-translatex="200"> -->
          <h2>Sumber Daya Air Provinsi</h2>
          <p class="fs-5 fw-light">Data sumber daya air yang dikelola oleh Pemerintah Provinsi Lampung.</p>
          <a href="<?=base_url('publik/data_provinsi/?layout=maps')?>" class="btn btn-lg btn-outline-primary pt-1">Lihat Sumber Data Air Provinsi</a>
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
        <img src="<?=base_url('uploads/data_wilayah/gambar/' . $kab['gambar'])?>" class="card-img-top logo_wilayah p-1" alt="...">
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