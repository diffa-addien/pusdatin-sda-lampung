<?php
use App\Models\M_ProfilSistem;
use App\Models\M_Kategori;

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

  return $extension;
}

function get_kategoriById($id){
  $M_Kategori = new M_Kategori;
  $model = $M_Kategori->find($id);
  $namaKategori = $model["nama"];

  return $namaKategori;
}

?>