<?php
use App\Models\M_ProfilSistem;
use App\Models\M_Kategori;
use App\Models\M_SDAWilayah;
use App\Models\M_Akun;

function profil_sistem($konteks){
  $M_ProfilSistem = new M_ProfilSistem;
  $profil_sistem = $M_ProfilSistem->findAll();

  if($konteks == "nama_sistem"){
    return $profil_sistem[0]["nama_sistem"];
  }else if($konteks == "logo_sistem"){
    return $profil_sistem[0]["logo_sistem"];
  }else if($konteks == "nama_provinsi"){
    return $profil_sistem[0]["nama_provinsi"];
  }else if($konteks == "logo_provinsi"){
    return $profil_sistem[0]["logo_provinsi"];
  }else if($konteks == "no_tlp"){
    return $profil_sistem[0]["no_tlp"];
  }else if($konteks == "email"){
    return $profil_sistem[0]["email"];
  }
}

function get_extensi($file_name){
  $temp = explode('.',$file_name);
  $extension = end($temp);

  if(preg_match('(pdf|doc|docx|ppt|pptx|xlsx|zip|geojson|kml)', $extension) === 0) {
    $extension = "Lainnya";
  } 

  return $extension;
}

function dokumen_link($doc, $tipe, $dir){
  if($dir == "provinsi"){
    $directory = "uploads/sda_provinsi/dokumen/";
  }else{
    $directory = "uploads/sda_wilayah/dokumen/";
  }

  if($tipe == "upload"){
    return base_url($directory.$doc);
  }else{
    return $doc;
  }
}

function getSize($doc, $tipe, $dir){
  if($dir == "provinsi"){
    $directory = "uploads/sda_provinsi/dokumen/";
  }else{
    $directory = "uploads/sda_wilayah/dokumen/";
  }

  if($tipe == "upload"){
    $link = realpath($directory.$doc);
    $mb = filesize($link) / 1000000;
    $kb = filesize($link) / 1000;
    if($mb >= 1){
      return round($mb, 2)." MB";
    }else{
      return round($kb, 1)." KB";
    }
  }else{
    return "-";
  }
}

function get_kategoriById($id){
  $M_Kategori = new M_Kategori;
  $model = $M_Kategori->find($id);
  $namaKategori = $model["nama"];

  return $namaKategori;
}

function getNamaByUser($user){
  $M_Akun = new M_Akun;
  $model = $M_Akun->find($user);
  $nama = $model["nama_lengkap"];

  return $nama;
}

function count_sda_wilayah($wilayah){
  $M_SDAWilayah = new M_SDAWilayah;
  $model = $M_SDAWilayah->query('SELECT id FROM data_sda_wilayah where id_wilayah = '.$wilayah)->getResultArray();
  $count = count($model);

  return $count;
}

function cekSesiUnduh($link){
  if(!session()->get('role')){
    return base_url('Publik/pemberitahuan');
  }else{
    return $link;
  }
}

?>