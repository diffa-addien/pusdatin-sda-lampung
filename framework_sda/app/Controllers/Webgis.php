<?php

namespace App\Controllers;
use CodeIgniter\HTTP\Request;

use App\Models\M_Akun;
use App\Models\M_Wilayah;
use App\Models\M_Kategori;
use App\Models\M_SDAWilayah;
use App\Models\M_SDAProvinsi;

class Webgis extends _BaseController
{
    public function __construct()
    {
        $this->M_Akun = new M_Akun();
        $this->M_Wilayah = new M_Wilayah();
        $this->M_Kategori = new M_Kategori();
        $this->M_SDAProvinsi = new M_SDAProvinsi();
        $this->M_SDAWilayah = new M_SDAWilayah();
    }

    public function index()
    {
        $data_akun  = $this->M_Akun->findAll();
        $data_kab   = $this->M_Wilayah->orderBy('nama', 'ASC')->findAll();
        $data_kat   = $this->M_Kategori->findAll();
        $sda_kab    = $this->M_SDAWilayah->findAll();
        $sda_prov   = $this->M_SDAProvinsi->findAll();

        $data = [
            "title" => "Pusdatin Sumber Daya Air Provinsi Lampung",
            "data_kab" => $data_kab, "sda_kab" => $sda_kab, "sda_prov" => $sda_prov, 
            "data_kat" => $data_kat, "data_akun" => $data_akun,
        ];

        return redirect()->to(base_url());
    }

    public function viewer()
    {
        $geo_kosong = file_get_contents(realpath("geojson_kosong.geojson"));
        $geo_kosong = json_decode($geo_kosong)->features;

        $gis = $this->request->getVar("gis");
        // var_dump($gis);die;
        $data_gis = file_get_contents(realpath($gis));
        $judul = $this->request->getVar("judul");

        $data = [
            "title" => "Pusdatin: GIS Viewer", "data_gis" => $data_gis,
            "URL_gis" => $gis, "judul" => $judul
        ];

        return view('view_publik/gis-viewer', $data);
    }

}
