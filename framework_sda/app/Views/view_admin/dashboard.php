<?= $this->extend('view_admin/frame/a_layout') ?>
<?= $this->section('head') ?>
<!-- Font Awesome -->
<link rel="stylesheet" href="<?= base_url('myassets/leaflet-search/src/leaflet-search.css')?>">
  
<style>

.leaflet-popup-content-wrapper {
  max-width: 300px;
  padding: 2px;
  border-radius:5px
}
.leaflet-popup-content{
  width: 260px;
  margin: 3px;
} 
.leaflet-popup-content img{
  width: 100%;
  max-height: 150px;
  object-fit: cover;
}
table{
  display: block;
  width: 100%;
  max-height: 30vh;
  overflow-x:scroll;
}
.control-wrapper {
  width: 200px;
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Small boxes (Stat box) -->
<div class="row ml-0">
  <div class="col-9 p-0 bg-transparent m-0">
    <div class="row m-0 p-0 bg-white rounded shadow-sm elevation-1">
      <div class="col-md-4 col-4 m-0">
        <!-- small box -->
        <div class="small-box shadow-none m-0">
          <div class="inner">
            <p>Total Data</p>
            <?php $total_sda = $count_sda_kab+$count_sda_prov; ?>
            <h3><?=$total_sda?></h3>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-md-4 col-4 m-0">
        <!-- small box -->
        <div class="small-box shadow-none m-0">
          <div class="inner">
            <p>Kategori Data</p>
            <h3><?=count($data_kat)?></h3>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-md-4 col-4 m-0">
        <!-- small box -->
        <div class="small-box shadow-none m-0">
          <div class="inner">
          <p>Kota / Kampus</p>
            <h3><?=count($data_kab)?></h3>
            
          </div>
          <div class="icon">
            <i class="fas fa-city"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
    </div>
  </div>
  <div class="col-3">
    <!-- small box -->
    <div class="small-box bg-primary elevation-1">
      <div class="inner">
        <h3><?=count($data_akun)?></h3>

        <p>Admin / Operator </p>
      </div>
      <div class="icon">
        <i class="fas fa-users-cog text-light"></i>
      </div>
    </div>
  </div>
  <!-- ./col -->
</div>
<!-- /.row -->

<!-- Main row -->
<div>
  <!-- Left col -->
  <section class="">
    <!-- Custom tabs (Charts with tabs)-->
    <div class="card p-0">
      <div class="card-header">
        <h3 class="card-title">
          <i class="fas fa-map mr-1 pt-1"></i>
          Gambaran Umum (Maps)
        </h3>
        <div class="card-tools">
          <div class="btn-group">
            <a href="<?=base_url('Admin/maps')?>" type="button" class="btn btn-tool">
              <i class="fas fa-expand mr-2"></i>Selengkapnya
            </a>
          </div>
        </div>
      </div><!-- /.card-header -->
      <div class="card-body overflow-hidden p-1" style="height: 85vh;">
        <div id="map" style="height: 95vh; width: 99vw;"></div>

      </div><!-- /.card-body -->
    </div>
    <!-- /.card -->
  </section>
  <!-- /.Left col -->
</div>
<!-- /.row (main row) -->
<?= $this->endSection() ?>

<?= $this->section('script') ?>

<!-- Leaflet Search Plugins -->
<script src="<?= base_url('myassets/leaflet-search/dist/leaflet-search.min.js')?>"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-omnivore/0.3.4/leaflet-omnivore.min.js"></script>
 
<script type="text/javascript">
var layerProvinsi = <?= json_encode($layerProv) ?>;
var layerKosong = <?= json_encode($layerKosong) ?>;
var layerIrigasi = <?= json_encode($irigasi) ?>;

var map = L.map('map', {
  minZoom: 6,
  maxZoom: 19,
}).setView([-4.8728473, 105.266670], 8);

var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
  maxZoom: 19,
  attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

var mapbox = L.tileLayer(
  'https://api.mapbox.com/styles/v1/diffa/clisec3rq001b01pn6qpw2g7f/tiles/256/{z}/{x}/{y}@2x?access_token=pk.eyJ1IjoiZGlmZmEiLCJhIjoiY2xmbDlrb3UxMDBpODNycGt4c3I5OTlreSJ9.H2dlO_QTqo6q2hcndh5lRg', {
    maxZoom: 19,
    attribution: '&copy; <a href="https://www.mapbox.com/about/maps/">Mapbox</a>'
  });

var lampung = L.geoJson(layerProvinsi, {
    style: {
      fillOpacity: 0,
      weight: '2',
    }
  }),
  kosong = L.geoJson(layerKosong);

var irigasi = L.geoJson(layerIrigasi, {
  style: {
    fillOpacity: 0,
    weight: '2',
  }
});

var geojsonMarkerOptions = {
  radius: 6,
  fillColor: "#ff7800",
  color: "#000",
  weight: 1,
  opacity: 1,
  fillOpacity: 0.4
};

function stylePetak(feature) {
  return {
    fillColor: getColor(feature.properties.fill),
    fillOpacity: 0.7,
    weight: 1,
  };
}

function getColor(d) {
    if(d){
      return d;
    }else{
      return "blue";
    }
}

function highlightFeature(e) {
  var layer = e.target;
  layer.setStyle({
    weight: 3,
    fillOpacity: 0.9
  });
}

function resetHighlight(e) {
  var layer = e.target;
  layer.setStyle({
    weight: 1,
    fillOpacity: 0.7
  });
}

function zoomToFeature(e) {
  try{
    map.fitBounds(e.target.getBounds());
  }
  catch (err) {
    console.log(err.message);
    var latLngs = [e.target.getLatLng()];
    var markerBounds = L.latLngBounds(latLngs);
    map.fitBounds(markerBounds).setZoom(15);
  }
}

function onEachFtr(feature, layer) {
  var popupcontent = [];
  for (var prop in feature.properties) {
    if (prop == 'judul_data'){break;}
    popupcontent.push('<tr><td>' + prop + '</td><td>: ' + feature.properties[prop] + '</td></tr>');
  }
  layer.bindPopup('<h5>' +feature.properties.judul_data+ '</h5><table>' + popupcontent.join("") + '</table>');
  layer.on({
    mouseover: highlightFeature,
    mouseout: resetHighlight,
    click: zoomToFeature(layer)
  });
}

var customLayer = L.geoJson(null, {
  style: stylePetak,
  onEachFeature: function onEachFtr(feature, layer) {
    var popupcontent = [];
    for (var prop in feature.properties) {
      if (prop == 'judul_data'){break;}
      popupcontent.push('<tr><td>' + prop + '</td><td>: ' + feature.properties[prop] + '</td></tr>');
    }
    layer.bindPopup('<h5>' +feature.properties.judul_data+ '</h5><table>' + popupcontent.join("") + '</table>');
    layer.on({
      mouseover: highlightFeature,
      mouseout: resetHighlight,
      click: zoomToFeature
    });
  }
});

<?php
$dir_geojson  = "uploads/sda_wilayah/geografis/";
$dir_img      = "uploads/sda_wilayah/gambar/";
$dir_doc      = "uploads/sda_wilayah/dokumen/";
$hitPetak = $hitGaris = $hitTitik = 0;
foreach($SDA_kab as $sda) { 
  $cekGambar = "";
  if(!empty($sda['gambar'])){
    $cekGambar = "<img src=\"".$dir_img.$sda['gambar']."\" class=\"w-100 border\">";
  }
?>
try {
  <?php
    if (!empty($sda["geojson_petak"])) {
      $extension = "geojson";
      $file_name = $sda["geojson_petak"];
      $temp = explode('.',$file_name);
      $extension = end($temp);

      if($extension == "kml"){
        echo "
          var customLayer = L.geoJson(null, {
            style: stylePetak,
            onEachFeature: function onEachFtr(feature, layer) {
              var popupcontent = [];
              feature.properties.judul_data = '".$sda["judul_data"]."';
              for (var prop in feature.properties) {
                if (prop == 'judul_data'){break;}
                popupcontent.push('<tr><td>' + prop + '</td><td>: ' + feature.properties[prop] + '</td></tr>');
              }
              layer.bindPopup('<h5>' +feature.properties.judul_data+ '</h5><table>' + popupcontent.join(\"\") + '</table>');
              layer.on({
                mouseover: highlightFeature,
                mouseout: resetHighlight,
                click: zoomToFeature
              });
            }
          });
          var layerPetak".++$hitPetak." = omnivore.kml('".base_url($dir_geojson).$sda["geojson_petak"]."', null, customLayer).addTo(map);    
        ";
      } else {
        $petakJSON = json_decode(file_get_contents(realpath($dir_geojson.$sda["geojson_petak"])))->features;
        foreach($petakJSON as $index=>$feature){
          $petakJSON[$index]->properties->deskripsi = $sda["isi_data"];
          $petakJSON[$index]->properties->judul_data = $sda["judul_data"];
        }

        // echo "var data = ";
        // echo "console.log('File :".$count++."');";
        echo "
        var layerPetak".++$hitPetak." = L.geoJson(".json_encode($petakJSON).", {
          style: stylePetak,
          onEachFeature: function (feature, layer) {
            var popupcontent = [];
            for (var prop in feature.properties) {
              if (prop == 'judul_data'){break;}
              popupcontent.push('<tr><td>' + prop + '</td><td>: ' + feature.properties[prop] + '</td></tr>');
            }
            layer.bindPopup('<h5>' +feature.properties.judul_data+ '</h5>".$cekGambar."<table>' + popupcontent.join(\"\") + '</table>');
            layer.on({
              mouseover: highlightFeature,
              mouseout: resetHighlight,
              click: zoomToFeature
            });
          }
        });";
      }
    }
    if (!empty($sda["geojson_garis"])) {
      $extension = "geojson";
      $file_name = $sda["geojson_garis"];
      $temp = explode('.',$file_name);
      $extension = end($temp);

      if($extension == "kml"){
        echo "
          var customLayer = L.geoJson(null, {
            style: stylePetak,
            onEachFeature: function onEachFtr(feature, layer) {
              var popupcontent = [];
              feature.properties.judul_data = '".$sda["judul_data"]."';
              for (var prop in feature.properties) {
                if (prop == 'judul_data'){break;}
                popupcontent.push('<tr><td>' + prop + '</td><td>: ' + feature.properties[prop] + '</td></tr>');
              }
              layer.bindPopup('<h5>' +feature.properties.judul_data+ '</h5><table>' + popupcontent.join(\"\") + '</table>');
              layer.on({
                mouseover: highlightFeature,
                mouseout: resetHighlight,
                click: zoomToFeature
              });
            }
          });
          var layerGaris".++$hitGaris." = omnivore.kml('".base_url($dir_geojson).$sda["geojson_garis"]."', null, customLayer).addTo(map);    
        ";
      }else{
        $garisJSON = json_decode(file_get_contents(realpath($dir_geojson.$sda["geojson_garis"])))->features;
        foreach($garisJSON as $index=>$feature){
          $garisJSON[$index]->properties->deskripsi = $sda["isi_data"];
          $garisJSON[$index]->properties->judul_data = $sda["judul_data"];
        }

        // echo "var data = ";
        // echo "console.log('File :".$count++."');";
        echo "
        var layerGaris".++$hitGaris." = L.geoJson(".json_encode($garisJSON).", {
          style: stylePetak,
          onEachFeature: function (feature, layer) {
            var popupcontent = [];
            for (var prop in feature.properties) {
                if (prop == 'judul_data' ){break;}
                popupcontent.push('<tr><td>' + prop + '</td><td>: ' + feature.properties[prop] + '</td></tr>');
            }
            layer.bindPopup('<h5>' +feature.properties.judul_data+ '</h5>".$cekGambar."<table>' + popupcontent.join(\"\") + '</table>');
            layer.on({
              click: zoomToFeature
            });
          }
        });";
      }
    }
    if (!empty($sda["geojson_titik"])) {
      $extension = "geojson";
      $file_name = $sda["geojson_titik"];
      $temp = explode('.',$file_name);
      $extension = end($temp);

      if($extension == "kml"){
        echo "
          var customLayer = L.geoJson(null, {
            onEachFeature: function onEachFtr(feature, layer) {
              var popupcontent = [];
              feature.properties.judul_data = '".$sda["judul_data"]."';
              for (var prop in feature.properties) {
                if (prop == 'judul_data'){break;}
                popupcontent.push('<tr><td>' + prop + '</td><td>: ' + feature.properties[prop] + '</td></tr>');
              }
              layer.bindPopup('<h5>' +feature.properties.judul_data+ '</h5><table>' + popupcontent.join(\"\") + '</table>');
              layer.on({
                mouseover: highlightFeature,
                mouseout: resetHighlight,
                click: zoomToFeature
              });
            }
          });
          var layerTitik".++$hitTitik." = omnivore.kml('".base_url($dir_geojson).$sda["geojson_titik"]."', null, customLayer).addTo(map);    
        ";
      }else{
        $titikJSON = json_decode(file_get_contents(realpath($dir_geojson.$sda["geojson_titik"])))->features;
        foreach($titikJSON as $index=>$feature){
          $titikJSON[$index]->properties->deskripsi = $sda["isi_data"];
          $titikJSON[$index]->properties->judul_data = $sda["judul_data"];
        }

        // echo "var data = ";
        // echo "console.log('File checked');";
        echo "
        var layerTitik".++$hitTitik." = L.geoJSON(".json_encode($titikJSON).", {
          onEachFeature: function (feature, layer) {
            var popupcontent = [];
            for (var prop in feature.properties) {
              if (prop == 'judul_data' ){break;}
              popupcontent.push('<tr><td>' + prop + '</td><td>: ' + feature.properties[prop] + '</td></tr>');
            }
            layer.bindPopup('<h5>'+feature.properties.judul_data+'</h5>".$cekGambar."<table>' + popupcontent.join(\"\") + '</table>');
            layer.on({
              click: zoomToFeature
            });
          }
        });";
      }
    }
    ?>
} catch (err) {
  console.log(err.message);
}
<?php } ?>

<?php
$dir_prov_geojson  = "uploads/sda_provinsi/geografis/";
$dir_prov_img      = "uploads/sda_provinsi/gambar/";
$dir_prov_doc      = "uploads/sda_provinsi/dokumen/";

foreach($SDA_prov as $sda_p) {
  $cekGambar = "";
  if(!empty($sda_p['gambar'])){
    $cekGambar = "<img src=\"".$dir_prov_img.$sda_p['gambar']."\" class=\"w-100 border\">";
  }
?>
try {
  <?php
    if (!empty($sda_p["geojson_petak"])) {
      $extension = "geojson";
      $file_name = $sda_p["geojson_petak"];
      $temp = explode('.',$file_name);
      $extension = end($temp);

      if($extension == "kml"){
        echo "
          var customLayer = L.geoJson(null, {
            style: stylePetak,
            onEachFeature: function onEachFtr(feature, layer) {
              var popupcontent = [];
              feature.properties.judul_data = '".$sda_p["judul_data"]."';
              for (var prop in feature.properties) {
                if (prop == 'judul_data'){break;}
                popupcontent.push('<tr><td>' + prop + '</td><td>: ' + feature.properties[prop] + '</td></tr>');
              }
              layer.bindPopup('<h5>' +feature.properties.judul_data+ '</h5>$cekGambar<table>' + popupcontent.join(\"\") + '</table>');
              layer.on({
                mouseover: highlightFeature,
                mouseout: resetHighlight,
                click: zoomToFeature
              });
            }
          });
          var layerPetak".++$hitPetak." = omnivore.kml('".base_url($dir_prov_geojson).$sda_p["geojson_petak"]."', null, customLayer).addTo(map);    
        ";

      }else{
        $petakJSON = json_decode(file_get_contents(realpath($dir_prov_geojson.$sda_p["geojson_petak"])))->features;
        foreach($petakJSON as $index=>$feature){
          $petakJSON[$index]->properties->deskripsi = $sda_p["isi_data"];
          $petakJSON[$index]->properties->judul_data = $sda_p["judul_data"];
        }

        // echo "var data = ";
        // echo "console.log('File :".$count++."');";
        echo "
        var layerPetak".++$hitPetak." = L.geoJson(".json_encode($petakJSON).", {
          style: stylePetak,
          onEachFeature: function (feature, layer) {
            var popupcontent = [];
            for (var prop in feature.properties) {
              if (prop == 'judul_data'){break;}
              popupcontent.push('<tr><td>' + prop + '</td><td>: ' + feature.properties[prop] + '</td></tr>');
            }
            layer.bindPopup('<h5>' +feature.properties.judul_data+ '</h5>".$cekGambar."<table>' + popupcontent.join(\"\") + '</table>');
            layer.on({
              mouseover: highlightFeature,
              mouseout: resetHighlight,
              click: zoomToFeature
            });
          }
        });";
      }
    }
    if (!empty($sda_p["geojson_garis"])) {
      $extension = "geojson";
      $file_name = $sda_p["geojson_garis"];
      $temp = explode('.',$file_name);
      $extension = end($temp);

      if($extension == "kml"){
        echo "
          var customLayer = L.geoJson(null, {
            style: stylePetak,
            onEachFeature: function onEachFtr(feature, layer) {
              var popupcontent = [];
              feature.properties.judul_data = '".$sda_p["judul_data"]."';
              for (var prop in feature.properties) {
                if (prop == 'judul_data'){break;}
                popupcontent.push('<tr><td>' + prop + '</td><td>: ' + feature.properties[prop] + '</td></tr>');
              }
              layer.bindPopup('<h5>' +feature.properties.judul_data+ '</h5>$cekGambar<table>' + popupcontent.join(\"\") + '</table>');
              layer.on({
                mouseover: highlightFeature,
                mouseout: resetHighlight,
                click: zoomToFeature
              });
            }
          });
          var layerGaris".++$hitGaris." = omnivore.kml('".base_url($dir_prov_geojson).$sda_p["geojson_garis"]."', null, customLayer).addTo(map);    
        ";
      }else{
        $garisJSON = json_decode(file_get_contents(realpath($dir_prov_geojson.$sda_p["geojson_garis"])))->features;
        foreach($garisJSON as $index=>$feature){
          $garisJSON[$index]->properties->deskripsi = $sda_p["isi_data"];
          $garisJSON[$index]->properties->judul_data = $sda_p["judul_data"];
        }

        // echo "var data = ";
        // echo "console.log('File :".$count++."');";
        echo "
        var layerGaris".++$hitGaris." = L.geoJson(".json_encode($garisJSON).", {
          style: stylePetak,
          onEachFeature: function (feature, layer) {
            var popupcontent = [];
            for (var prop in feature.properties) {
                if (prop == 'judul_data' ){break;}
                popupcontent.push('<tr><td>' + prop + '</td><td>: ' + feature.properties[prop] + '</td></tr>');
            }
            layer.bindPopup('<h5>' +feature.properties.judul_data+ '</h5>".$cekGambar."<table>' + popupcontent.join(\"\") + '</table>');
            layer.on({
              click: zoomToFeature
            });
          }
        }).addTo(map);";
      }
    }
    if (!empty($sda_p["geojson_titik"])) {
      $extension = "geojson";
      $file_name = $sda_p["geojson_titik"];
      $temp = explode('.',$file_name);
      $extension = end($temp);

      if($extension == "kml"){
        echo "
          var customLayer = L.geoJson(null, {
            onEachFeature: function onEachFtr(feature, layer) {
              var popupcontent = [];
              feature.properties.judul_data = 'Titik ".$sda_p["judul_data"]."';
              for (var prop in feature.properties) {
                if (prop == 'judul_data'){break;}
                popupcontent.push('<tr><td>' + prop + '</td><td>: ' + feature.properties[prop] + '</td></tr>');
              }
              layer.bindPopup('<h5>' +feature.properties.judul_data+ '</h5>$cekGambar<table>' + popupcontent.join(\"\") + '</table>');
              layer.on({
                mouseover: highlightFeature,
                mouseout: resetHighlight,
                click: zoomToFeature
              });
            }
          });
          var layerTitik".++$hitTitik." = omnivore.kml('".base_url($dir_prov_geojson).$sda_p["geojson_titik"]."', null, customLayer).addTo(map);    
        ";
      }else{
        $titikJSON = json_decode(file_get_contents(realpath($dir_prov_geojson.$sda_p["geojson_titik"])))->features;
        foreach($titikJSON as $index=>$feature){
          $titikJSON[$index]->properties->deskripsi = $sda_p["isi_data"];
          $titikJSON[$index]->properties->judul_data = $sda_p["judul_data"];
        }

        // echo "var data = ";
        // echo "console.log('File checked');";
        echo "
        var layerTitik".++$hitTitik." = L.geoJSON(".json_encode($titikJSON).", {
          onEachFeature: function (feature, layer) {
            var popupcontent = [];
            for (var prop in feature.properties) {
              if (prop == 'judul_data' ){break;}
              popupcontent.push('<tr><td>' + prop + '</td><td>: ' + feature.properties[prop] + '</td></tr>');
            }
            layer.bindPopup('<h5>'+feature.properties.judul_data+'</h5>".$cekGambar."<table>' + popupcontent.join(\"\") + '</table>');
            layer.on({
              click: zoomToFeature
            });
          }
        }).addTo(map);";
      }
    }
    ?>
} catch (err) {
  console.log(err.message);
}
<?php } ?>

var city = L.marker([-4.8728473, 105.266670], {}).bindPopup('<a href="' +
  "https://www.google.com/search?client=firefox-b-d&q=Lampung" + '" target="_blank">' + "Lokasi 1" + '</a>');
city2 = L.marker([-4.7728473, 105.186670], {}).bindPopup('<a href="' +
  "https://www.google.com/search?client=firefox-b-d&q=Lampung" + '" target="_blank">' + "Lokasi 2" + '</a>');
city3 = L.marker([-4.7728473, 105.566670], {
  //icon: L.BeautifyIcon.icon(options)
}).bindPopup('<a href="' + "https://www.google.com/search?client=firefox-b-d&q=Lampung" + '" target="_blank">' +
  "Lokasi 3" + '</a>');

var citymarkers = L.layerGroup([city, city2, city3]);
var Geograph = L.layerGroup([lampung, kosong]);
var Irigasi = L.layerGroup([kosong]).addTo(map);

var grupPetak = L.layerGroup([kosong<?php for($i=1; $i<=$hitPetak; $i++){echo ", layerPetak".$i;}?>]).addTo(map);
var grupGaris = L.layerGroup([kosong<?php for($i=1; $i<=$hitGaris; $i++){echo ", layerGaris".$i;}?>]).addTo(map);
var grupTitik = L.layerGroup([kosong<?php for($i=1; $i<=$hitTitik; $i++){echo ", layerTitik".$i;}?>]).addTo(map);

var grupAll = L.layerGroup([kosong<?php for($i=1; $i<=$hitPetak; $i++){echo ", layerPetak".$i;}; for($i=1; $i<=$hitGaris; $i++){echo ", layerGaris".$i;} for($i=1; $i<=$hitTitik; $i++){echo ", layerTitik".$i;}?>]);

//<?php for($i=1; $i<=$hitPetak; $i++){echo "console.log('".$hitPetak.": '+layerPetak".$i.");";}?>

var baseLayers = {
  "Street": osm,
  "Satellite": mapbox
};

var overlayMaps = {
  '<i class="fas fa-map-marker"></i> Titik': grupTitik,
  '<i class="fas fa-wave-square"></i> Saluran': grupGaris,
  '<i class="fas fa-object-ungroup"></i> Petak': grupPetak,
};

L.control.layers(baseLayers, overlayMaps, {
  collapsed: false
}).addTo(map);

var searchControl = new L.Control.Search({
  layer: grupAll,  // Determines the name of variable, which includes our GeoJSON layer!
  propertyName: "judul_data",
  marker: false,
  moveToLocation: function(mTarget, title, map) {
    //map.fitBounds( latlng.layer.getBounds() );
    // var zoom = map.getBoundsZoom(latlng.layer.getBounds());
    // map.setView(latlng, zoom); // access the zoom
    try{
      var zoom = map.getBoundsZoom(mTarget.layer.getBounds());
      map.setView(mTarget, zoom); // access the zoom
    }
    catch (err) {
      console.log(err.message);
      var latLngs = [mTarget.layer.getLatLng()];
      var markerBounds = L.latLngBounds(latLngs);
      map.fitBounds(markerBounds);
      map.setZoom(15);
    }
  }
});

searchControl.on('search:locationfound', function(e) {
  //console.log('search:locationfound', );
  //map.removeLayer(this._markerSearch)
  e.layer.setStyle({fillColor: '#3f0', color: '#0f0'});
  if(e.layer._popup)
    e.layer.openPopup();
}).on('search:collapsed', function(e) {
  featuresLayer.eachLayer(function(layer) {   //restore feature color
    featuresLayer.resetStyle(layer);
  }); 
});

map.addControl( searchControl );  //inizialize search control

// add a scale at at your map.
var scale = L.control.scale({imperial: false}).addTo(map); 

// add button penghitung
L.Control.counter = L.Control.extend({
  options: {
    position: 'bottomright'
  },
  onAdd: function(map) {
    var container = L.DomUtil.create('div', 'leaflet-bar p-0 count-wrap');

    var button = L.DomUtil.create('div', 'px-1', container);
    button.innerHTML = 'Menampilkan 30 data masuk terbaru';

    L.DomEvent.disableClickPropagation(container);

    return container;
  },
  onRemove: function(map) {},
});

var dataCounter = new L.Control.counter();
dataCounter.addTo(map);

// // Get the label.
// var metres = scale._getRoundNum(map.containerPointToLatLng([0, map.getSize().y / 2 ]).distanceTo( map.containerPointToLatLng([scale.options.maxWidth,map.getSize().y / 2 ])))
// label = metres < 1000 ? metres + ' m' : (metres / 1000) + ' km';

// console.log(label);

// L.Control.lapis2 = L.Control.extend({
//   options: {
//     position: 'bottomleft'
//   },
//   onAdd: function(map) {
//     var container = L.DomUtil.create('div', 'leaflet-bar control-wrapper row');
//     var button = L.DomUtil.create('a', 'leaflet-control-button col btn btn-sm p-0 m-0 ', container);
//     button.innerHTML = "Save";
//     button.href = "?data=irigasi";
//     var button2 = L.DomUtil.create('a', 'leaflet-control-button col btn btn-sm p-0 m-0  ', container);
//     button2.innerHTML = "New";
//     button2.href = "?data=sumur";

//     L.DomEvent.disableClickPropagation(button, button2);
//     L.DomEvent.on(button, 'click', function() {
//       console.log('click');
//     });

//     container.title = "Title";

//     return container;
//   },
//   onRemove: function(map) {},
// });
// var control = new L.Control.lapis2()
// control.addTo(map);


// L.Control.Watermarks = L.Control.extend({
//   onAdd: function(map) {
//       var img = L.DomUtil.create('img');

//       img.src = 'https://leafletjs.com/docs/images/logo.png';
//       img.style.width = '200px';

//       return img;
//   },

//   onRemove: function(map) {
//       // Nothing to do here
//   }
// });

// L.control.watermarks = function(opts) {
//   return new L.Control.Watermarks(opts);
// }

// L.control.watermarks({ position: 'topleft' }).addTo(map);

// TEST TOMBOL KOSONG
// L.Control.tombol = L.Control.extend({
//   options: {
//     position: 'topright'
//   },
//   onAdd: function(map) {
//     var container = L.DomUtil.create('div', 'leaflet-bar leaflet-control');
//     var button = L.DomUtil.create('a', 'leaflet-control-button', container);
//     L.DomEvent.disableClickPropagation(button);
//     L.DomEvent.on(button, 'click', function() {
//       console.log('click');
//     });

//     container.title = "Title";

//     return container;
//   },
//   onRemove: function(map) {},
// });
// var control = new L.Control.tombol()
// control.addTo(map);

// Fungsi CARD
$(window).on("load", function() {
  $("#map").css({
    "width": "100%",
    "height": "100%"
  });
});
</script>
<?= $this->endSection() ?>