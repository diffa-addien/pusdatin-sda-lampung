<?= $this->extend('view_publik/frame/p_layout') ?>
<?= $this->section('head') ?>

<style>
* {
  /* outline: 1px solid red; */
}

.responsive-container-block {
  min-height: 75px;
  height: fit-content;
  width: 100%;
  display: flex;
  flex-wrap: wrap;
  justify-content: flex-start;
}

.responsive-container-block.bigContainer {
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

.ultimateImg {
  width: 50%;
  position: relative;
}

.mainImg {
  color: black;
  width: 100%;
  height: auto;
  border-radius: 8px;
}

.allText {
  width: 40%;
  padding-right: 25px;
}

.responsive-container-block.container {
  justify-content: center;
  align-items: center;
  max-width: 1320px;
}

.responsive-container-block.container.bottomContainer {
  flex-direction: row-reverse;
  position: static;
}

.purpleBox {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  max-width: 430px;
  padding: 20px;
  position: absolute;
  bottom: -40px;
  left: -20px;
  border-radius: 8px;
}

@media (max-width: 599px) {
  .responsive-container-block.container {
    padding-top: 10px;
    padding-right: 0px;
    padding-bottom: 10px;
    padding-left: 0px;
    width: 100%;
    max-width: 100%;
  }

  .responsive-container-block.bigContainer {
    padding-top: 10px;
    padding-right: 25px;
    padding-bottom: 10px;
    padding-left: 25px;
  }

  .allText {
    margin-top: 20px;
    padding: 0 20px;
    width: 100%;
  }

  .ultimateImg {
    padding: 10px;
    width: 100%;
    position: static;
  }

  .mainImg {
    width: 100%;
    border-radius: 5px 5px 0 0;
  }

  .purpleBox {
    border-radius: 0 0 5px 5px;
    position: static;
    max-width: 100%;
    border-top: none;
  }

  .responsive-container-block.bigContainer {
    padding: 10px;
  }
}
</style>

<?= $this->endSection()?>

<?= $this->section('content') ?>
<div class="container-fluid p-0 mb-3">
  <div class="container responsive-container-block bottomContainer pt-3 mt-3 mb-5 " style="min-height: 75vh;">
    <div class="ultimateImg">
      <img class="mainImg shadow" src="<?=base_url('myassets/GSG_Unila.jpg')?>">
      <div class="purpleBox shadow bg-primary pb-1">
        <p class="text-white">
          <?=profil_sistem("nama_sistem")?> dikembangkan dan dikelola oleh Universitas Lampung, data yang disimpan pada sistem ini merupakan
          kontribusi dari beberapa pihak.
        </p>
      </div>
    </div>
    <div class="allText bottomText">
      <p class="fs-4 text-primary">
        <?=profil_sistem("nama_sistem")?>
      </p>
      <p class="fs-3 subHeadingText">
        Sistem Informasi Pusat Data Sumber Daya Air Provinsi Lampung
      </p>
      <p class="text-blk description">
      Kami berkomitmen untuk menjadi pusat data sumber daya air di Provinsi Lampung yang memiliki potensi untuk memberikan banyak manfaat bagi masyarakat dan lingkungan. Dengan menyediakan informasi akurat dan mudah diakses.
      <br/><br/>
      Sistem ini diharapkan dapat membantu meningkatkan pengelolaan sumber daya air, meningkatkan ketahanan air, mendukung pembangunan berkelanjutan, meningkatkan transparansi dan akuntabilitas, dan meningkatkan kesadaran publik.
      </p>
      Ada Pertanyaan?<br class="mb-2"/>
      <a href="<?=base_url('hubungi-kami')?>" class="btn btn-outline-primary rounded-0">
        Hubungi Kami
      </a>
    </div>
  </div>
  <div class="container text-center mb-5">
    <h4 class="my-4">Release notes</h4>
    <div>Versi 1.0.0 - 09/10/2023 - Sistem diluncurkan pertama kali - <a href="https://www.linkedin.com/in/diffa-addien-aziz-790726222/">Diffa Addien Aziz</a></div>
  </div>
</div>
<?= $this->endSection()?>

<?= $this->section('script') ?>

<?= $this->endSection()?>