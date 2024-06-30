<?php

namespace App\Controllers;
use CodeIgniter\HTTP\Request;

use App\Models\M_Akun;
use App\Models\M_Wilayah;
use App\Models\M_Kategori;
use App\Models\M_SDAWilayah;
use App\Models\M_SDAProvinsi;

class Publik extends _BaseController
{
    public function __construct()
    {
        $this->M_Akun = new M_Akun();
        $this->M_Wilayah = new M_Wilayah();
        $this->M_Kategori = new M_Kategori();
        $this->M_SDAProvinsi = new M_SDAProvinsi();
        $this->M_SDAWilayah = new M_SDAWilayah();

        //FOR Maintenance
        if(getenv("REMOTE_ADDR")=="114.79.6.73"){
            echo "yes :".getenv("REMOTE_ADDR");
        }else{
            echo "Server sedang dalam maintenance...";
            die;
        }
        

    }

    public function index()
    {
        $data_akun  = $this->M_Akun->findAll();
        $data_kab   = $this->M_Wilayah->findAll();
        $data_kat   = $this->M_Kategori->findAll();
        $sda_kab    = $this->M_SDAWilayah->findAll();
        $sda_prov   = $this->M_SDAProvinsi->findAll();

        $data = [
            "title" => "Pusdatin Sumber Daya Air Provinsi Lampung",
            "data_kab" => $data_kab, "sda_kab" => $sda_kab, "sda_prov" => $sda_prov, "data_kat" => $data_kat,
            "data_akun" => $data_akun,
        ];

        return view('view_publik/beranda', $data);
    }

    public function tentang_sistem()
    {
        $data = [
            "title" => "Tentang Sistem"
        ];

        return view('view_publik/tentang-sistem', $data);
    }
    
    public function hubungi_kami()
    {
        $data = ["title" => "Hubungi Kami"];

        return view('view_publik/hubungi-kami', $data);
    }

    public function pemberitahuan()
    {
        $data = ["title" => "Pemberitahuan!"];

        return view('view_publik/attention_download', $data);
    }

    public function data_provinsi()
    {
        if(empty($_GET['layout'])){
            return redirect()->to(base_url('Publik'));
        } else if($_GET['layout'] == "maps"){
            $kategori = $this->M_Kategori->select('id as fisrtKat')->first();
            if(!empty($this->request->getVar("kategori"))){
                $kategori = $this->request->getVar("kategori");
            } else {$kategori = $kategori["fisrtKat"];}
            if(!empty($this->request->getVar("tahun"))){
                $tahun = $this->request->getVar("tahun");
            } else {$tahun = date('Y');}

            $SDA_prov   = $this->M_SDAProvinsi->query("SELECT * FROM data_sda_provinsi WHERE tahun = $tahun AND id_kategori = $kategori")->getResultArray();
            $data_kat   = $this->M_Kategori->findAll();
            $getTahun   = $this->M_Wilayah->query("SELECT DISTINCT tahun FROM data_sda_wilayah UNION SELECT DISTINCT tahun FROM data_sda_provinsi")->getResultArray();

            $data = [
            "title" => "SDA: Provinsi", 'kategori_now' =>  $kategori, 'tahun_now' =>  $tahun,
            "sda_prov" => $SDA_prov, 'data_kat' => $data_kat,'getTahun' => $getTahun,
            "jenis" => "Data Provinsi", "nama" => "Lampung"
            ];

            return view('view_publik/provinsi/maps-provinsi', $data);
        } else if($_GET['layout'] == "list"){
            if(!empty($this->request->getVar("kategori"))){
                $kategori_value = $this->request->getVar("kategori");
                $kategori = "id_kategori = ".$this->request->getVar('kategori');
            } else {$kategori = "TRUE"; $kategori_value = "";}
            if(!empty($this->request->getVar("tahun"))){
                $tahun_value = $this->request->getVar("tahun");
                $tahun = "tahun = ".$this->request->getVar('tahun');
            } else {$tahun = "TRUE"; $tahun_value = "";}
            if(!empty($this->request->getVar("query"))){
                $query_value = $this->request->getVar("query");
                $query = "judul_data like '%".$this->request->getVar("query")."%'";
            } else {$query = "TRUE"; $query_value = "";}

            $starttime = microtime(true);

            $SDA_prov   = $this->M_SDAProvinsi->query("SELECT * FROM data_sda_provinsi WHERE $query AND $tahun AND $kategori")->getResultArray();
            $data_kat   = $this->M_Kategori->findAll();
            $getTahun   = $this->M_SDAProvinsi->query("SELECT DISTINCT tahun FROM data_sda_provinsi")->getResultArray();
            
            $endtime = microtime(true);
            $duration = $endtime - $starttime;

            $data = [
                "title" => "SDA: Provinsi",
                "sda_prov" => $SDA_prov,
                "jenis" => "Data Provinsi", "nama" => "Lampung",
                'data_kat' => $data_kat,'getTahun' => $getTahun,
                "query" => $query_value, "tahun" => $tahun_value, "kategori" => $kategori_value,
                "duration"=> $duration
            ];

            return view('view_publik/provinsi/data-provinsi', $data);
        }
    }

    public function data_wilayah($idWilayah)
    {
        if(empty($_GET['layout'])){
            return redirect()->to(base_url('Publik'));
        } else if($_GET['layout'] == "maps"){
            $data_wilayah = $this->M_Wilayah->find($idWilayah);
            $SDA_wilayah = $this->M_SDAWilayah->find($idWilayah);

            $kategori = $this->M_Kategori->select('id as fisrtKat')->first();
            if(!empty($this->request->getVar("kategori"))){
                $kategori = $this->request->getVar("kategori");
            } else {$kategori = $kategori["fisrtKat"];}
            if(!empty($this->request->getVar("tahun"))){
                $tahun = $this->request->getVar("tahun");
            } else {$tahun = date('Y');}

            $data_wilayah = $this->M_Wilayah->find($idWilayah);
            $SDA_wilayah = $this->M_SDAProvinsi->query("SELECT * FROM data_sda_wilayah WHERE id_wilayah = $idWilayah AND tahun = $tahun AND id_kategori = $kategori")->getResultArray();
            $data_kat   = $this->M_Kategori->findAll();
            $getTahun   = $this->M_Wilayah->query("SELECT DISTINCT tahun FROM data_sda_wilayah UNION SELECT DISTINCT tahun FROM data_sda_provinsi")->getResultArray();

            $data = [
                "title" => "SDA: ".$data_wilayah["nama"], 'kategori_now' =>  $kategori, 'tahun_now' =>  $tahun,
                "sda_wilayah" => $SDA_wilayah, "data_wilayah" => $data_wilayah, 'data_kat' => $data_kat,'getTahun' => $getTahun,
                "jenis" => $data_wilayah["jenis"], "nama" => $data_wilayah["nama"]
            ];

            return view('view_publik/wilayah/maps-wilayah', $data);
        } else if($_GET['layout'] == "list"){
            if(!empty($this->request->getVar("kategori"))){
                $kategori_value = $this->request->getVar("kategori");
                $kategori = "id_kategori = ".$this->request->getVar('kategori');
            } else {$kategori = "TRUE"; $kategori_value = "";}
            if(!empty($this->request->getVar("tahun"))){
                $tahun_value = $this->request->getVar("tahun");
                $tahun = "tahun = ".$this->request->getVar('tahun');
            } else {$tahun = "TRUE"; $tahun_value = "";}
            if(!empty($this->request->getVar("query"))){
                $query_value = $this->request->getVar("query");
                $query = "judul_data like '%".$this->request->getVar("query")."%'";
            } else {$query = "TRUE"; $query_value = "";}
            
            $starttime = microtime(true);

            $data_wilayah = $this->M_Wilayah->find($idWilayah);
            $SDA_wilayah = $this->M_SDAWilayah->query("SELECT * FROM data_sda_wilayah where id_wilayah='".$idWilayah."' AND $query AND $tahun AND $kategori")->getResultArray();
            $data_kat   = $this->M_Kategori->findAll();
            $getTahun   = $this->M_SDAWilayah->query("SELECT DISTINCT tahun FROM data_sda_wilayah")->getResultArray();

            $endtime = microtime(true);
            $duration = $endtime - $starttime;

            $data = [
                "title" => "SDA: ".$data_wilayah["nama"],
                "jenis" => $data_wilayah["jenis"], "nama" => $data_wilayah["nama"],
                "sda_wilayah" => $SDA_wilayah,
                'data_kat' => $data_kat,'getTahun' => $getTahun,
                "query" => $query_value, "tahun" => $tahun_value, "kategori" => $kategori_value,
                "duration"=> $duration
            ];

            return view('view_publik/wilayah/data-wilayah', $data);
        }
    }
}
