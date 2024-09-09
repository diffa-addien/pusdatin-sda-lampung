<?php
// var_dump($data_gis);
$nama_gis = explode('/',$URL_gis);
// var_dump($nama_gis);die;

?>
<?= $this->extend('view_admin/frame/empty_layout') ?>
<?= $this->section('head') ?>
<!-- Leaflet Search-->
<link rel="stylesheet" href="<?= base_url('myassets/leaflet-search/src/leaflet-search.css')?>">
<style>
  .w-px-190{
    width: 190px
  }
  .svh{
    height: calc(100vh - 50px); 
    height: calc(100svh - 50px); 
    width: 100vw;
  }
  .img-pop{
    width: 100%;
    max-height: 150px;
    object-fit: cover;
  }
  .leaflet-popup-content-wrapper {
    max-width: 300px;
    padding: 2px;
  }
  .leaflet-popup-content{
    width: 260px;
    margin: 3px;
  } 
  .leaflet-popup-content table{
    display: block;
    width: 100%;
    max-height: 35vh;
    overflow-x:scroll;
  }
  #kategori{
    max-height: 35vh;
    overflow-x: hidden;
  }
  .count-wrap{
    background-color: rgba(0,0,0,0);
  }
</style>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<!-- Custom tabs (Charts with tabs)-->
<div class="card p-0">
  <div class="card-header py-2 pl-3" style="height: 50px">
    <h3 class="card-title">
      <a href="javascript:history.back()" type="button" class="btn btn-sm btn-outline-secondary px-3 mr-2"><i class="fas fa-chevron-left"></i> Kembali</a> 
      <span class="text-nowrap position-absolute" style="display: inline-block; top: 12px; left: 120px; overflow: hidden">
        <i class="fas fa-map mx-1"></i>
        GIS Viewer: <?= "[".$judul."] ".end($nama_gis)?>
      </span>
    </h3>
    <div class="card-tools pr-sm-1 position-absolute bg-white" style="right:17px">
      <div class="btn-group">
        <a href="<?=base_url($URL_gis)?>" title="Download File" type="button" class="btn btn-sm btn-outline-primary" download>Download</a>
      </div>
    </div>
  </div><!-- /.card-header -->
  <div class="card-body overflow-hidden p-0" style="height: calc(100vh - 50px);">
    <div id="map" class="m-0 p-0 svh"></div>
  </div><!-- /.card-body -->
</div>
<?= $this->endSection('content') ?>

<?= $this->section('script') ?>
<!-- Leaflet Search Plugins -->
<script src="<?= base_url('myassets/leaflet-search/dist/leaflet-search.min.js')?>"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-omnivore/0.3.4/leaflet-omnivore.min.js"></script>

<script>
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

var kosong = L.geoJson({"type": "FeatureCollection","features": []});

// var stylePetak = {
//   fillColor: 'blue',
//   fillOpacity: 0.5,
//   weight: 2,
// }

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

var geojsonMarkerOptions = {
  radius: 6,
  fillColor: "#ff7800",
  color: "#000",
  weight: 1,
  opacity: 1,
  fillOpacity: 0.4
};

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

var customLayer = L.geoJson(null, {
  style: stylePetak,
  onEachFeature: function onEachFtr(feature, layer) {
    var popupcontent = [];
    for (var prop in feature.properties) {
      if (prop == 'judul_data'){break;}
      popupcontent.push('<tr><td>' + prop + '</td><td>:</td><td> ' + feature.properties[prop] + '</td></tr>');
    }
    layer.bindPopup('<h5>' +feature.properties.judul_data+ '</h5><table>' + popupcontent.join("") + '</table>');
    layer.on({
      mouseover: highlightFeature,
      mouseout: resetHighlight,
    });
  }
});

<?php
// For SDA Provinsi ============================================================================
$dir_prov_geojson  = "uploads/sda_provinsi/geografis/";
$dir_prov_img      = "uploads/sda_provinsi/gambar/";
$dir_prov_doc      = "uploads/sda_provinsi/dokumen/";

$cekGambar = "";
if(!empty($sda_p['gambar'])){
  $cekGambar = "<img src=\"".base_url().$dir_prov_img.$sda_p['gambar']."\" class=\"img-pop border\">";
}
?>
try {
  <?php
    if (TRUE) {
      $extension = get_extensi($URL_gis);

      if($extension == "kml"){
        echo "
          var customLayer = L.geoJson(null, {
            style: stylePetak,
            onEachFeature: function onEachFtr(feature, layer) {
              var popupcontent = [];
              for (var prop in feature.properties) {
                if(prop){
                  popupcontent.push('<tr><td>' + prop + '</td><td>:</td><td> ' + feature.properties[prop] + '</td></tr>');
                }
              }
              layer.bindPopup('<h5>Data Dalam GIS</h5>$cekGambar<table class=\"table table-sm\">' + popupcontent.join(\"\") + '</table>');
              layer.on({
                mouseover: highlightFeature,
                mouseout: resetHighlight,
              });
            }
          });
          var grabDataGis = omnivore.kml('".base_url($URL_gis)."', null, customLayer).addTo(map);    
        ";

      }else{
        $petakJSON = json_decode(file_get_contents(realpath($URL_gis)))->features;
        // echo "var data = ";
        // echo "console.log('File :".$count++."');";
        echo "
        var grabDataGis = L.geoJson(".json_encode($petakJSON).", {
          style: stylePetak,
          onEachFeature: function (feature, layer) {
            var popupcontent = [];
            for (var prop in feature.properties) {
              popupcontent.push('<tr><td>' + prop + '</td><td>:</td><td> ' + feature.properties[prop] + '</td></tr>');
            }
            layer.bindPopup('<h5>Data dalam GIS</h5>".$cekGambar."<table class=\"table table-sm\">' + popupcontent.join(\"\") + '</table>');
            layer.on({
              mouseover: highlightFeature,
              mouseout: resetHighlight,
            });
          }
        }).addTo(map);;";
      }
    }
    
    ?>
} catch (err) {
  console.log(err.message);
}


// Custom Control ===================================================================================
var baseLayers = {
  "Street": osm,
  "Satellite": mapbox
};

// Custom Control ===================================================================================

L.control.layers(baseLayers, null, {
  collapsed: false
}).addTo(map);

// add a scale at at your map.
L.control.scale({imperial: false}).addTo(map);

setTimeout(function () {
  try{
    map.fitBounds(grabDataGis.getBounds(), {padding: [50, 50]});
    console.log("getBounds success in first try");
  } catch {
    alert("Perhatian! File GIS ini mungkin membutuhkan waktu lebih lama untuk dimuat");
  }
}, 2000);
  
</script>
<?= $this->endSection('script') ?>