<?php
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$CurPageURL = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];  
?>
<?= $this->extend('view_publik/frame/maps_layout') ?>

<?= $this->section('content') ?>
<div class="z-1 p-0 border">
  <div id="map" class="svh"></div>
</div>
</div>
<?= $this->endSection()?>

<?= $this->section('script') ?>
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

var stylePetak = {
  fillColor: 'blue',
  fillOpacity: 0.5,
  weight: 2,
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
    fillOpacity: 0.7
  });
}

function resetHighlight(e) {
  var layer = e.target;
  layer.setStyle(stylePetak);
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
$dir_geojson  = "uploads/sda_provinsi/geografis/";
$dir_img      = "uploads/sda_provinsi/gambar/";
$dir_doc      = "uploads/sda_provinsi/dokumen/";
$hitPetak = $hitGaris = $hitTitik = 0;

foreach($sda_prov as $sda) { 
  $cekGambar = "";
  if(!empty($sda['gambar'])){
    $cekGambar = "<img src=\"".base_url().$dir_img.$sda['gambar']."\" class=\"img-pop border\">";
  }
?>
try {
  <?php
    if (!empty($sda["geojson_petak"])) {
      $extension = get_extensi($sda["geojson_petak"]);
      if($extension == "kml"){
        echo "
          var customLayer = L.geoJson(null, {
            style: stylePetak,
            onEachFeature: function onEachFtr(feature, layer) {
              var popupcontent = [];
              feature.properties.deskripsi = '".$sda["isi_data"]."';
              feature.properties.judul_data = '".$sda["judul_data"]."';
              for (var prop in feature.properties) {
                if (prop == 'judul_data'){
                  break;
                }
                popupcontent.push('<tr><td>' + prop + '</td><td>:</td><td> ' + feature.properties[prop] + '</td></tr>');
              }
              layer.bindPopup('<h5>' +feature.properties.judul_data+ '</h5>".$cekGambar."<table class=\"table table-sm\">' + popupcontent.join(\"\") + '</table>');
              layer.on({
                mouseover: highlightFeature,
                mouseout: resetHighlight,
              });
            }
          });
          var layerPetak".++$hitPetak." = omnivore.kml('".base_url($dir_geojson.$sda["geojson_petak"])."', null, customLayer).addTo(map);    
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
              if (prop == 'judul_data'){
                break;
              }
              popupcontent.push('<tr><td>' + prop + '</td><td>:</td><td> ' + feature.properties[prop] + '</td></tr>');
            }
            layer.bindPopup('<h5>' +feature.properties.judul_data+ '</h5>".$cekGambar."<table class=\"table table-sm\">' + popupcontent.join(\"\") + '</table>');
            layer.on({
              mouseover: highlightFeature,
              mouseout: resetHighlight,
            });
          }
        });";
      }
    }
    if (!empty($sda["geojson_garis"])) {
      $extension = get_extensi($sda["geojson_garis"]);
      if($extension == "kml"){
        echo "
          var customLayer = L.geoJson(null, {
            style: stylePetak,
            onEachFeature: function onEachFtr(feature, layer) {
              var popupcontent = [];
              feature.properties.deskripsi = '".$sda["isi_data"]."';
              feature.properties.judul_data = '".$sda["judul_data"]."';
              for (var prop in feature.properties) {
                if (prop == 'judul_data'){

                  break;
                }
                popupcontent.push('<tr><td>' + prop + '</td><td>:</td><td> ' + feature.properties[prop] + '</td></tr>');
              }
              layer.bindPopup('<h5>' +feature.properties.judul_data+ '</h5>$cekGambar<<table class=\"table table-sm\">' + popupcontent.join(\"\") + '</table>');
              layer.on({
                mouseover: highlightFeature,
                mouseout: resetHighlight,
              });
            }
          });
          var layerGaris".++$hitGaris." = omnivore.kml('".base_url($dir_geojson.$sda["geojson_garis"])."', null, customLayer).addTo(map);    
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
                if (prop == 'judul_data' ){

                  break;
                }
                popupcontent.push('<tr><td>' + prop + '</td><td>:</td><td> ' + feature.properties[prop] + '</td></tr>');
            }
            layer.bindPopup('<h5>' +feature.properties.judul_data+ '</h5>".$cekGambar."<table class=\"table table-sm\">' + popupcontent.join(\"\") + '</table>');
          }
        });";
      }
    }
    if (!empty($sda["geojson_titik"])) {
      $extension = get_extensi($sda["geojson_titik"]);
      if($extension == "kml"){
        echo "
          var customLayer = L.geoJson(null, {
            pointToLayer: function (feature, latlng) {
              return L.circleMarker(latlng, geojsonMarkerOptions);
            },
            onEachFeature: function onEachFtr(feature, layer) {
              var popupcontent = [];
              feature.properties.deskripsi = '".$sda["isi_data"]."';
              feature.properties.judul_data = '".$sda["judul_data"]."';
              for (var prop in feature.properties) {
                if (prop == 'judul_data'){
                  break;
                }
                popupcontent.push('<tr><td>' + prop + '</td><td>:</td><td> ' + feature.properties[prop] + '</td></tr>');
              }
              layer.bindPopup('<h5>' +feature.properties.judul_data+ '</h5>$cekGambar<table class=\"table table-sm\">' + popupcontent.join(\"\") + '</table>');
              layer.on({
                mouseover: highlightFeature,
                mouseout: resetHighlight,
              });
            }
          });
          var layerTitik".++$hitTitik." = omnivore.kml('".base_url($dir_geojson.$sda["geojson_titik"])."', null, customLayer).addTo(map);    
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
          pointToLayer: function (feature, latlng) {
              return L.circleMarker(latlng, geojsonMarkerOptions);
          },
          onEachFeature: function (feature, layer) {
            var popupcontent = [];
            for (var prop in feature.properties) {
              if (prop == 'judul_data' ){
                break;
              }
              popupcontent.push('<tr><td>' + prop + '</td><td>:</td><td> ' + feature.properties[prop] + '</td></tr>');
            }
            layer.bindPopup('<h5>'+feature.properties.judul_data+'</h5>".$cekGambar."<table class=\"table table-sm\">' + popupcontent.join(\"\") + '</table>');
          }
        });";
      }
    }
    ?>
} catch (err) {
  console.log(err.message);
}
<?php } ?>

var grupPetak = L.layerGroup([kosong<?php for($i=1; $i<=$hitPetak; $i++){echo ", layerPetak".$i;}?>]).addTo(map);
var grupGaris = L.layerGroup([kosong<?php for($i=1; $i<=$hitGaris; $i++){echo ", layerGaris".$i;}?>]).addTo(map);
var grupTitik = L.layerGroup([kosong<?php for($i=1; $i<=$hitTitik; $i++){echo ", layerTitik".$i;}?>]).addTo(map);

var grupAll = L.layerGroup([kosong<?php for($i=1; $i<=$hitPetak; $i++){echo ", layerPetak".$i;}; for($i=1; $i<=$hitGaris; $i++){echo ", layerGaris".$i;} for($i=1; $i<=$hitTitik; $i++){echo ", layerTitik".$i;}?>]);

var baseLayers = {
  "Street": osm,
  "Satellite": mapbox
};

var overlayMaps = {
  '<i class="fas fa-map-marker"></i> Titik': grupTitik,
  '<i class="fas fa-wave-square"></i> Saluran': grupGaris,
  '<i class="fas fa-object-ungroup"></i> Petak': grupPetak,
};

// CONTROL AREA ========================================================================


// add a scale at at your map.
var scale = L.control.scale({imperial: false}).addTo(map); 

// add Search Control
var searchControl = new L.Control.Search({
  layer: grupAll,  // Determines the name of variable, which includes our GeoJSON layer!
  propertyName: "judul_data",
  marker: false,
  moveToLocation: function(mTarget, title, map) {
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
  featuresLayer.eachLayer(function(layer) {   
    //restore feature color
    featuresLayer.resetStyle(layer);
  }); 
});

// inizialize search control
map.addControl(searchControl);  

// add button kategori
L.Control.kategori = L.Control.extend({
  options: {
    position: 'bottomleft'
  },
  onAdd: function(map) {
    var container = L.DomUtil.create('div', 'leaflet-bar p-0 bg-white w-px-190');

    var button = L.DomUtil.create('div', 'py-0', container);
    button.innerHTML = ""+
    '<div class="card-header p-2" data-bs-toggle="collapse" data-bs-target="#kategori" role="button">'+
      '<div class="mb-0" style="font-size: 15px">Kategori: <i class="fas fa-arrow-right"></i> <?=get_kategoriById($kategori_now)?></div>'+ 
    '</div>'+
    '<div id="kategori" class="collapse p-0">'
      <?php foreach($data_kat as $kategori): ?>
      +'<form action="<?=$CurPageURL?>" method="post">'
        +'<input type="hidden" name="tahun" value="<?=$tahun_now?>"/>'
        +'<button type="submit" name="kategori" class="py-1 w-100 rounded-0 btn btn-sm btn-light" value="<?=$kategori["id"]?>"><?=$kategori["nama"]?></button>'
      +'</form>'
      <?php endforeach?>
    +'</div>';

    L.DomEvent.disableClickPropagation(container);

    return container;
  },
  onRemove: function(map) {},
});

// add button tahun
L.Control.tahun = L.Control.extend({
  options: {
    position: 'topright'
  },
  onAdd: function(map) {
    var container = L.DomUtil.create('div', 'leaflet-bar p-0 bg-white');

    var button = L.DomUtil.create('div', 'px-1', container);
    button.innerHTML = ""
    +'<form action="<?=$CurPageURL?>" method="post" style="position: relative;">'
    +'<input type="hidden" name="kategori" value="<?=$kategori_now?>" required/>'
    +'<label for="tahun"> Tahun: </label>'
    +'<select name="tahun" id="tahun" class="border-0 p-1" onchange="this.form.submit()" required>'
      +'<option value="" hidden> <?=$tahun_now?> </option>'
        <?php foreach ($getTahun as $tahun): ?>
          +'<option value="<?=$tahun["tahun"]?>"><?=$tahun["tahun"]?></option>'
        <?php endforeach ?>
        +'</select>'
      +'</form>';

    L.DomEvent.disableClickPropagation(container);

    return container;
  },
  onRemove: function(map) {},
});

// add button penghitung
L.Control.counter = L.Control.extend({
  options: {
    position: 'bottomright'
  },
  onAdd: function(map) {
    var container = L.DomUtil.create('div', 'leaflet-bar p-0 count-wrap');

    var button = L.DomUtil.create('div', 'px-1', container);
    button.innerHTML = 'Menemukan: <?=count($sda_prov)?> Data';

    L.DomEvent.disableClickPropagation(container);

    return container;
  },
  onRemove: function(map) {},
});

var kategoriControl = new L.Control.kategori();
kategoriControl.addTo(map);
var tahunControl = new L.Control.tahun();
tahunControl.addTo(map);
var dataCounter = new L.Control.counter();
dataCounter.addTo(map);

L.control.layers(baseLayers, overlayMaps, {
  collapsed: true
}).addTo(map);


</script>

<?= $this->endSection()?>