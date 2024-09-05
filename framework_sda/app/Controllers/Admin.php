<?php

namespace App\Controllers;

use App\Models\M_Akun;
use App\Models\M_Wilayah;
use App\Models\M_Kategori;
use App\Models\M_ProfilSistem;
use App\Models\M_SDAWilayah;
use App\Models\M_SDAProvinsi;

class Admin extends _BaseController
{
    public function __construct()
    {
        $this->M_Akun = new M_Akun();
        $this->M_ProfilSistem = new M_ProfilSistem();
        $this->M_Wilayah = new M_Wilayah();
        $this->M_Kategori = new M_Kategori();
        $this->M_SDAWilayah = new M_SDAWilayah();
        $this->M_SDAProvinsi = new M_SDAProvinsi();
    }

    // View Controllers ====================================================================================
    public function index()
    {
        $count_SDA_kab = $this->M_SDAWilayah->countAll();
        $count_SDA_prov = $this->M_SDAProvinsi->countAll();
        $data_kab = $this->M_Wilayah->findAll();
        $data_akun = $this->M_Akun->findAll();
        $data_kat = $this->M_Kategori->findAll();

        $SDA_kab = $this->M_SDAWilayah->orderBy('id', 'DESC')->limit(15)->findAll();
        $SDA_prov = $this->M_SDAProvinsi->orderBy('id', 'DESC')->limit(15)->findAll();
        
        $geo_kosong = file_get_contents(realpath("geojson_kosong.geojson"));
        $geo_kosong = json_decode($geo_kosong)->features;

        $data = [
            'title' => "Dasbor",
            'layerProv' => $geo_kosong, 'layerKosong' => $geo_kosong, 'irigasi' => $geo_kosong,
            'SDA_kab' => $SDA_kab, 'SDA_prov' => $SDA_prov, 'data_akun' => $data_akun, 'data_kat' => $data_kat, 'data_kab' => $data_kab,
            'count_sda_kab' => $count_SDA_kab, 'count_sda_prov' => $count_SDA_prov,
            'library' => [''],
        ];

        return view('view_admin/dashboard', $data);
    }

    public function maps()
    {
        $kategori = $this->M_Kategori->select('id as fisrtKat')->first();
        if(!empty($this->request->getVar("kategori"))){
            $kategori = $this->request->getVar("kategori");
        } else {$kategori = $kategori["fisrtKat"];}
        if(!empty($this->request->getVar("tahun"))){
            $tahun = $this->request->getVar("tahun");
        } else {$tahun = date('Y');}

        $SDA_wilayah = $this->M_SDAWilayah->query("SELECT * FROM data_sda_wilayah WHERE tahun = $tahun AND id_kategori = $kategori")->getResultArray();
        $SDA_prov   = $this->M_SDAProvinsi->query("SELECT * FROM data_sda_provinsi WHERE tahun = $tahun AND id_kategori = $kategori")->getResultArray();
        $data_kat   = $this->M_Kategori->findAll();
        $getTahun   = $this->M_Wilayah->query("SELECT DISTINCT tahun FROM data_sda_wilayah UNION SELECT DISTINCT tahun FROM data_sda_provinsi")->getResultArray();

        // var_dump($SDA_wilayah);
        // die;

        $data = [
            'title' => "Maps", 'kategori_now' =>  $kategori, 'tahun_now' =>  $tahun,
            'SDA_wilayah' => $SDA_wilayah, 'SDA_prov' => $SDA_prov, 'data_kat' => $data_kat,
            'getTahun' => $getTahun,
            'library' => [''],
        ];

        return view('view_admin/maps', $data);
    }

    public function profil_sistem()
    {
        $data = [
            'title' => "Pengaturan Profil Sistem",
        ];
        return view('view_admin/profil_sistem', $data);
    }

    public function ganti_password()
    {
        $data = [
            'title' => "Ganti Password",
        ];
        return view('view_admin/ganti_password', $data);
    }

    public function profil_akun()
    {
        $data_akun = $this->M_Akun->find(session()->get('username'));
        $data = [
            'title' => "Pengaturan Profil Akun",
            'akun'  => $data_akun
        ];

        return view('view_admin/profil_akun', $data);
    }

    public function kelola_akun()
    {
        $data_akun = $this->M_Akun->findAll();
        $data_kota = $this->M_Wilayah->findAll();
        $data = [
            'title' => "Kelola Akun",
            'data_akun' => $data_akun, 'kota' => $data_kota,
            'library' => [''],
        ];

        return view('view_admin/kelola_akun/tabel_akun', $data);
    }

    public function form_tambah_akun()
    {
        $data_kota = $this->M_Wilayah->findAll();
        $data = [
            'title' => "Form Tambah Akun",
            'kota' => $data_kota
        ];
        return view('view_admin/kelola_akun/form_tambah', $data);
    }
    public function form_ubah_akun($username)
    {
        $data_kota = $this->M_Wilayah->findAll();
        $data_akun = $this->M_Akun->find($username);
        $data = [
            'title' => "Form Ubah Akun",
            'akun' => $data_akun, 'kota' => $data_kota
        ];
        return view('view_admin/kelola_akun/form_ubah', $data);
    }
    public function detail_akun($username)
    {
        $data_akun = $this->M_Akun->find($username);
        $data = [
            'title' => "Detail Akun: " . $data_akun["nama_lengkap"],
            'akun' => $data_akun,
        ];
        return view('view_admin/kelola_akun/detail_akun', $data);
    }

    public function kelola_wilayah()
    {
        $data_kabupaten = $this->M_Wilayah->findAll();
        $data = [
            'title' => "Kelola Wilayah",
            'data_kab' => $data_kabupaten,
            'library' => [''],
        ];
        return view('view_admin/kelola_wilayah/tabel_wilayah', $data);
    }
    public function form_tambah_wilayah()
    {
        $data = [
            'title' => "Form Tambah Wilayah",
        ];
        return view('view_admin/kelola_wilayah/form_tambah', $data);
    }
    public function form_ubah_wilayah($id)
    {
        $data_kota = $this->M_Wilayah->find($id);
        $data = [
            'title' => "Form Ubah Data Wilayah",
            'kota' => $data_kota,
        ];
        return view('view_admin/kelola_wilayah/form_ubah', $data);
    }

    public function kelola_kategori()
    {
        $data_Kategori = $this->M_Kategori->findAll();
        $jumlah = $this->M_Kategori->countAll();
        $data = [
            'title' => "Kelola Kategori",
            'data_kat' => $data_Kategori, 'total' => $jumlah,
            'library' => [''],
        ];
        return view('view_admin/kelola_kategori/tabel_kategori', $data);
    }

    public function sda_provinsi()
    {
        $sda_prov = $this->M_SDAProvinsi->findAll();
        $data = [
            'title' => "Data SDA Provinsi",
            'sda_prov' => $sda_prov,
            'library' => ['datatables'],
        ];

        return view('view_admin/sda_provinsi/tabel_sda_provinsi', $data);
    }

    public function form_tambah_sda_prov()
    {
        $kategori = $this->M_Kategori->findAll();
        $data = [
            'title' => "Form Tambah Data Provinsi",
            'kategori' => $kategori
        ];
        return view('view_admin/sda_provinsi/form_tambah', $data);
    }

    public function form_ubah_sda_prov($id)
    {
        $kategori = $this->M_Kategori->findAll();
        $data_SDA = $this->M_SDAProvinsi->find($id);
        $data = [
            'title' => "Form Ubah Data Provinsi",
            'kategori' => $kategori,
            'data_SDA' => $data_SDA
        ];
        return view('view_admin/sda_provinsi/form_ubah', $data);
    }

    public function sda_wilayah($id)
    {
        if($id=="pilih"){
            $data_wilayah = $this->M_Wilayah->findAll();
            $data = [
                'title' => "Data SDA Wilayah",
                'data_wilayah' => $data_wilayah,
            ];
            return view('view_admin/sda_wilayah/tabel_sda_wilayah', $data);
        }else{
            $kota = $this->M_Wilayah->find($id);
            $data_wilayah = $this->M_SDAWilayah->query('SELECT * FROM data_sda_wilayah WHERE id_wilayah='.$id.'')->getResultArray();
            
            $data = [
                'title' => "Data ".$kota["nama"], 'id' => $id,
                'data_wilayah' => $data_wilayah,
                'library' => ['datatables'],
            ];
            return view('view_admin/sda_wilayah/tabel_data_sda', $data);
        }
    }

    public function form_tambah_sda_wilayah($id)
    {
        $kota = $this->M_Wilayah->find($id);
        $kategori = $this->M_Kategori->findAll();
        $data = [
            'title' => "Form Tambah Data: ".$kota["nama"], 'kota' => $kota,
            'kategori' => $kategori
        ];
        return view('view_admin/sda_wilayah/form_tambah', $data);
    }

    public function form_ubah_sda_wilayah($id)
    {
        $data_SDA = $this->M_SDAWilayah->find($id);
        $kota = $this->M_Wilayah->find($data_SDA["id_wilayah"]);
        $kategori = $this->M_Kategori->findAll();
        $data = [
            'title' => "Form Ubah Data: ".$kota["nama"], 'kota' => $kota,
            'kategori' => $kategori,
            'data_SDA' => $data_SDA,
        ];
        return view('view_admin/sda_wilayah/form_ubah', $data);
    }

    // Action DB Controllers ==================================================================================

    public function save_profil()
    {
        $dir_img = "uploads/data_provinsi/";
        $logo_sis_fix = $this->request->getVar("logo_sis_lama");
        $logo_prov_fix = $this->request->getVar("logo_prov_lama");

        if($this->request->getFile('logo_sis')->isValid()){
            // die;
            $validationRule = [
                'logo_sis' => [
                    'label' => 'Error Image: ',
                    'rules' => [
                        'uploaded[logo_sis]',
                        'mime_in[logo_sis,image/jpg,image/jpeg,image/png]',
                        'max_size[logo_sis,3000]'
                    ],
                ],
            ];
            if (!$this->validate($validationRule)) {
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }
            $img = $this->request->getFile('logo_sis');
            $extent = explode('.',$img->getName());
            $extent = end($extent);
            $check = realpath($dir_img.$logo_sis_fix);
            if (is_file($check)){unlink($check);}
            $logo_sis_fix = "logo_sistem_".date('Ymd-his').".".$extent;
            $img->move($dir_img, $logo_sis_fix);
        }

        if($this->request->getFile('logo_prov')->isValid()){
            // die;
            $validationRule = [
                'logo_prov' => [
                    'label' => 'Error Image: ',
                    'rules' => [
                        'uploaded[logo_prov]',
                        'mime_in[logo_prov,image/jpg,image/jpeg,image/png]',
                        'max_size[logo_prov,3000]'
                    ],
                ],
            ];
            if (!$this->validate($validationRule)) {
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }
            $img = $this->request->getFile('logo_prov');
            $extent = explode('.',$img->getName());
            $extent = end($extent);
            $check = realpath($dir_img.$logo_prov_fix);
            if (is_file($check)){unlink($check);}
            $logo_prov_fix = "logo_provinsi_".date('Ymd-his').".".$extent;
            $img->move($dir_img, $logo_prov_fix);
        }
        

        $this->M_ProfilSistem->save([
            'id' => "1",
            'nama_sistem' => $this->request->getVar('nama_sistem'),
            'logo_sistem' => $logo_sis_fix,
            'no_tlp' => $this->request->getVar('no_tlp'),
            'email' => $this->request->getVar('email'),
            'nama_provinsi' => $this->request->getVar('nama_provinsi'),
            'logo_provinsi' => $logo_prov_fix,
        ]);

        session()->setFlashdata([
            "icon" => "success", "pesan" => "Profil Sistem Berhasil Diperbarui",
        ]);
        return redirect()->to(base_url('Admin/profil_sistem'));
    }

    public function save_profil_akun($username)
    {
        $dir_img = "uploads/akun/foto_profil/";
        $foto_profil = $this->request->getVar("foto_lama");

        if($this->request->getFile('foto_profil')->isValid()){
            $validationRule = [
                'foto_profil' => [
                    'label' => 'Error Image: ',
                    'rules' => [
                        'uploaded[foto_profil]',
                        'mime_in[foto_profil,image/jpg,image/jpeg,image/png]',
                        'max_size[foto_profil,3000]'
                    ],
                ],
            ];
            if (!$this->validate($validationRule)) {
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->back()->withInput();
            }
            $img = $this->request->getFile('foto_profil');
            $extent = explode('.',$img->getName());
            $extent = end($extent);
            $check = realpath($dir_img.$foto_profil);
            if (is_file($check)){unlink($check);}
            $foto_profil = $username."-foto_profil.".$extent;
            $img->move($dir_img, $foto_profil);
        }

        $this->M_Akun->save([
            'username' => $username,
            'foto' => $foto_profil,
            'email' => $this->request->getVar('email'),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
        ]);

        session()->setFlashdata([
            "icon" => "success", "pesan" => "Profil Berhasil Diperbarui",
        ]);
        return redirect()->to(base_url('Admin/profil_akun'));
    }

    public function terima_akun($username)
    {
        $this->M_Akun->save([
            'username' => $username,
            'status' => "aktif",
        ]);

        session()->setFlashdata([
            "icon" => "success", "pesan" => "Akun telah diterima",
        ]);
        return redirect()->to(base_url('Admin/kelola_akun'));
    }
    public function ubah_akun()
    {
        $this->M_Akun->save([
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'role' => $this->request->getVar('role'),
            'wilayah' => $this->request->getVar('val_wilayah'),
            'tanggal_dibuat' => date('Y-m-d'),
        ]);

        session()->setFlashdata([
            "icon" => "success", "pesan" => "Akun berhasil diubah",
        ]);
        return redirect()->to(base_url('Admin/kelola_akun'));
    }
    public function ubah_pw($id)
    {
        if ($this->request->getVar('pw_baru') != $this->request->getVar('pw_baru_konfir')) {
            $err = "Konfirmasi Password Salah";
            session()->setFlashdata([
              "icon" => "error", "pesan" => "Password Konfirmasi tidak sama",
            ]);
            return redirect()->back();
        }

        $ModelAkun = new \App\Models\M_Akun();

        $ModelAkun->save([
          'username' => $id,
          'password' => password_hash($this->request->getVar('pw_baru'), PASSWORD_DEFAULT),
        ]);

        session()->setFlashdata([
            "icon" => "success", "pesan" => "Password Berhasil diubah",
        ]);
        return redirect()->back();
    }
    public function hapus_akun($id)
    {
        $this->M_Akun->delete($id);

        session()->setFlashdata([
            "icon" => "success", "pesan" => "Akun telah dihapus",
        ]);
        return redirect()->to(base_url('Admin/kelola_akun'));
    }

    public function tambah_wilayah()
    {   
        $getData = $this->M_Wilayah->select('max(id) as lastID')->first();
        $ID = $getData["lastID"] + 1;
        $validationRule = [
            'gambar' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[gambar]',
                    'max_size[gambar,1000]'
                ],
            ],
        ];
        if (!$this->validate($validationRule)) {
            session()->setFlashdata('error', $this->validator->listErrors());

            return redirect()->back()->withInput();
        }
        $img = $this->request->getFile('gambar');
        $nama = "Gambar_kota_".$ID.".".$img->guessExtension();
        $check = base_url('uploads/data_wilayah/gambar/'.$nama);
        $readFile =  './uploads/data_wilayah/gambar/'.$nama;

        if (is_readable($readFile)){
            unlink($readFile); // Hapus duplicate
        }

        $img->move('uploads/data_wilayah/gambar/', $nama);

        $this->M_Wilayah->insert([
            'id' => $ID,
            'nama' => $this->request->getVar('kota'),
            'jenis' => $this->request->getVar('jenis'),
            'gambar' => $nama,
            'latitude' => $this->request->getVar('lat'),
            'longitude' => $this->request->getVar('long'),
        ]);

        session()->setFlashdata([
            "icon" => "success", "pesan" => "Wilayah berhasil ditambahkan",
        ]);
        return redirect()->to(base_url('Admin/kelola_wilayah'));
    }

    public function ubah_wilayah()
    { 
        $nama = $this->request->getVar("nama_tadi");
        $ID = $this->request->getVar("id");
        if(strlen($_FILES['gambar']['name']) > 0){
            $validationRule = [
                'gambar' => [
                    'label' => 'Image File',
                    'rules' => [
                        'uploaded[gambar]',
                        'max_size[gambar,1000]'
                    ],
                ],
            ];
            if (!$this->validate($validationRule)) {
                session()->setFlashdata('error', $this->validator->listErrors());
    
                return redirect()->back()->withInput();
            }
            // Menghapus Gambar Sebelumnya
            $check = base_url('uploads/data_wilayah/gambar/'.$nama);
            $readFile =  realpath('uploads/data_wilayah/gambar/'.$nama);
            if (is_file($readFile)){
                unlink($readFile); 
            }
            // Upload Gambar Baru
            $img = $this->request->getFile('gambar');
            $nama = "Gambar_kota_".$ID."_".date('Ymd-his').".".$img->guessExtension();
            $img->move('uploads/data_wilayah/gambar/', $nama);
        }

        $this->M_Wilayah->save([
            'id' => $ID,
            'nama' => $this->request->getVar('kota'),
            'jenis' => $this->request->getVar('jenis'),
            'gambar' => $nama,
            'latitude' => $this->request->getVar('lat'),
            'longitude' => $this->request->getVar('long'),
        ]);

        session()->setFlashdata([
            "icon" => "success", "pesan" => "Data wilayah berhasil diubah",
        ]);
        return redirect()->to(base_url('Admin/kelola_wilayah'));
    }

    public function hapus_kabupaten($id)
    {
        $file = $this->M_Wilayah->find($id);

        // Menghapus Gambar Sebelumnya
        $readFile =  realpath('uploads/data_wilayah/gambar/'.$file["gambar"]);
        if (is_file($readFile)){
            unlink($readFile); 
        }

        $this->M_Wilayah->delete($id);

        session()->setFlashdata([
            "icon" => "success", "pesan" => "Wilayah telah dihapus",
        ]);
        return redirect()->to(base_url('Admin/kelola_wilayah'));
    }

    public function tambah_kategori()
    {
        $getData = $this->M_Kategori->select('max(id) as lastID')->first();
        $ID = $getData["lastID"] + 1;
        $this->M_Kategori->insert([
            'id' => $ID,
            'nama' => $this->request->getVar('nama'),
        ]);

        session()->setFlashdata([
            "icon" => "success", "pesan" => "Kategori baru berhasil tambahkan",
        ]);
        return redirect()->to(base_url('Admin/kelola_kategori'));
    }
    public function ubah_kategori($id)
    {
        $this->M_Kategori->save([
            'id' => $id,
            'nama' => $this->request->getVar('nama'),
        ]);

        session()->setFlashdata([
            "icon" => "success", "pesan" => "Nama kategori berhasil diubah",
        ]);
        return redirect()->to(base_url('Admin/kelola_kategori'));
    }
    public function hapus_kategori($id)
    {
        $this->M_Kategori->delete($id);

        session()->setFlashdata([
            "icon" => "success", "pesan" => "Kategori telah dihapus",
        ]);
        return redirect()->to(base_url('Admin/kelola_kategori'));
    }

    public function tambah_sda_wilayah()
    {
        $dir_geojson    = "uploads/sda_wilayah/geografis/";
        $dir_img        = "uploads/sda_wilayah/gambar/";
        $dir_doc        = "uploads/sda_wilayah/dokumen/";

        $namaGambar=$namaGjsonPetak=$namaGjsonGaris=$namaGjsonTitik=$namaDokumen = "";
        $ket_dokumen = "";
        $tipe_dokumen = $this->request->getVar('tipe_dokumen');
        if(!empty($this->request->getVar('doc'))){
            $ket_dokumen = $ket_dokumen.$this->request->getVar('doc')."; ";
        }
        if(!empty($this->request->getVar('excel'))){
            $ket_dokumen = $ket_dokumen.$this->request->getVar('excel')."; ";
        }
        if(!empty($this->request->getVar('ppt'))){
            $ket_dokumen = $ket_dokumen.$this->request->getVar('ppt')."; ";
        }
        if(!empty($this->request->getVar('gambar_ket'))){
            $ket_dokumen = $ket_dokumen.$this->request->getVar('gambar_ket');
        }

        $getData = $this->M_SDAWilayah->select('max(id) as lastID')->first();
        $ID = $getData["lastID"] + 1;
        
        $validationRule = [
            'judul_data' => ['label' => 'Nama Data', 'rules' => ['required', 'max_length[150]']],
            'gambar' => ['label' => 'Gambar: ','rules' => ['mime_in[gambar,image/jpg,image/jpeg,image/png]','max_size[gambar,2040]']],
            'upload_dokumen' => ['rules' => ['ext_in[upload_dokumen,pdf,doc,docx,ppt,pptx,xlsx,zip]','max_size[upload_dokumen,10400]'],
                'errors' => [
                    'ext_in' => 'Input dokumen hanya boleh (pdf,ppt,doc,excel,zip)',
                ]],
            'geojson_titik' => ['label' => 'GIS Titik/Lokasi: ','rules' => ['ext_in[geojson_titik,kml,geojson]','max_size[geojson_titik,17000]']],
            'geojson_garis' => ['label' => 'GIS Garis/Saluran: ','rules' => ['ext_in[geojson_garis,kml,geojson]','max_size[geojson_garis,17000]']],
            'geojson_petak' => ['label' => 'GIS Petak/Polygon: ','rules' => ['ext_in[geojson_petak,kml,geojson]','max_size[geojson_petak,17000]']],
        ];
        if (!$this->validate($validationRule)){
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        
        if($this->request->getFile('gambar')->isValid()){
            $img = $this->request->getFile('gambar');
            $extent = explode('.',$img->getName());
            $extent = end($extent);
            $namaGambar = "Gambar_Data_".$ID."_".date('Ymd-his').".".$extent;
            $img->move($dir_img, $namaGambar, true);
        }
        
        if($tipe_dokumen=="upload"){
            if($this->request->getFile('upload_dokumen')->isValid()){
                $dok = $this->request->getFile('upload_dokumen');
                $extent = explode('.',$dok->getName());
                $extent = end($extent);
                $namaDokumen = "ID".$ID."_Dokumen_".date('Ymd-his').".".$extent;
                $dok->move($dir_doc, $namaDokumen, true);
            }
        }else{
            $namaDokumen = $this->request->getVar('link_dokumen');
        }

        if($this->request->getFile('geojson_titik')->isValid()){
            $geo_titik = $this->request->getFile('geojson_titik');
            $extent = explode('.',$geo_titik->getName());
            $extent = end($extent);
            $namaGjsonTitik = "ID".$ID."_Titik_".date('Ymd-his').".".$extent;
            $geo_titik->move($dir_geojson, $namaGjsonTitik, true);
        }
        if($this->request->getFile('geojson_petak')->isValid()){
            $geo_petak = $this->request->getFile('geojson_petak');
            $extent = explode('.',$geo_petak->getName());
            $extent = end($extent);
            $namaGjsonPetak = "ID".$ID."_Petak_".date('Ymd-his').".".$extent;
            $geo_petak->move($dir_geojson, $namaGjsonPetak, true);
        }
        if($this->request->getFile('geojson_garis')->isValid()){
            $geo_garis = $this->request->getFile('geojson_garis');
            $extent = explode('.',$geo_garis->getName());
            $extent = end($extent);
            $namaGjsonGaris = "ID".$ID."_Garis_".date('Ymd-his').".".$extent;
            $geo_garis->move($dir_geojson, $namaGjsonGaris, true);
        }
        

        $this->M_SDAWilayah->insert([
            'id' => $ID,
            'judul_data' => $this->request->getVar('judul_data'),
            'isi_data' => $this->request->getVar('isi'),
            'id_kategori' => $this->request->getVar('id_kategori'),
            'id_wilayah' => $this->request->getVar('id_wilayah'),
            'gambar' => $namaGambar,
            'dokumen' => $namaDokumen,
            'tipe_dokumen' => $tipe_dokumen,
            'ket_dokumen' => $ket_dokumen,
            'geojson_titik' => $namaGjsonTitik,
            'geojson_garis' => $namaGjsonGaris,
            'geojson_petak' => $namaGjsonPetak,
            'diupload_oleh' => session()->get('username'),
            'tahun' => $this->request->getVar('tahun'),
        ]);

        session()->setFlashdata([
            "icon" => "success", "pesan" => "Data berhasil ditambahkan",
        ]);
        return redirect()->to(base_url('Admin/sda_wilayah/'.$this->request->getVar('id_wilayah')));
    }

    public function ubah_sda_wilayah($id)
    {
        $dir_geojson    = "uploads/sda_wilayah/geografis/";
        $dir_img        = 'uploads/sda_wilayah/gambar/';
        $dir_doc        = "uploads/sda_wilayah/dokumen/";

        $data = $this->M_SDAWilayah->find($id);

        $namaGambar     = $this->request->getVar('gambar_sebelumnya');
        $namaDokumen    = $this->request->getVar('dokumen_sebelumnya');
        $namaGjsonPetak = $this->request->getVar('geopetak_sebelumnya');
        $namaGjsonGaris = $this->request->getVar('geogaris_sebelumnya');
        $namaGjsonTitik = $this->request->getVar('geotitik_sebelumnya');
        $ket_dokumen = "";
        $tipe_dokumen = $this->request->getVar('tipe_dokumen');
        if(!empty($this->request->getVar('doc'))){
            $ket_dokumen = $ket_dokumen.$this->request->getVar('doc').";";
        }
        if(!empty($this->request->getVar('excel'))){
            $ket_dokumen = $ket_dokumen.$this->request->getVar('excel').";";
        }
        if(!empty($this->request->getVar('ppt'))){
            $ket_dokumen = $ket_dokumen.$this->request->getVar('ppt').";";
        }
        if(!empty($this->request->getVar('gambar_ket'))){
            $ket_dokumen = $ket_dokumen.$this->request->getVar('gambar_ket');
        }
        if($ket_dokumen == ""){
            $ket_dokumen = $this->request->getVar('ket_sebelumnya');
        }

        $ID = $id;

        $validationRule = [
            'judul_data' => ['label' => 'Nama Data', 'rules' => ['required', 'max_length[150]']],
            'gambar' => ['label' => 'Gambar: ','rules' => ['mime_in[gambar,image/jpg,image/jpeg,image/png]','max_size[gambar,2040]']],
            'upload_dokumen' => ['rules' => ['ext_in[upload_dokumen,pdf,doc,docx,ppt,pptx,xlsx,zip]','max_size[upload_dokumen,10400]'],
                'errors' => [
                    'ext_in' => 'Input dokumen hanya boleh (pdf,ppt,doc,excel,zip)',
                ]],
            'geojson_titik' => ['label' => 'GIS Titik/Lokasi: ','rules' => ['ext_in[geojson_titik,kml,geojson]','max_size[geojson_titik,17000]']],
            'geojson_garis' => ['label' => 'GIS Garis/Saluran: ','rules' => ['ext_in[geojson_garis,kml,geojson]','max_size[geojson_garis,17000]']],
            'geojson_petak' => ['label' => 'GIS Petak/Polygon: ','rules' => ['ext_in[geojson_petak,kml,geojson]','max_size[geojson_petak,17000]']],
        ];
        if (!$this->validate($validationRule)) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        
        if($this->request->getFile('gambar')->isValid()){
            // Menghapus File Sebelumnya
            $check = realpath($dir_img.$data["gambar"]);
            if (is_file($check)){
                unlink($check);
            }
            // Upload File Baru
            $img = $this->request->getFile('gambar');
            $extent = explode('.',$img->getName());
            $extent = end($extent);
            $namaGambar = "Gambar_Data_".$ID."_".date('Ymd-his').".".$extent;
            $img->move($dir_img, $namaGambar, true);
        }

        if($tipe_dokumen=="upload"){
            if($this->request->getFile('upload_dokumen')->isValid()){
                // Menghapus File Sebelumnya
                $check = realpath($dir_doc.$data["dokumen"]);
                if (is_file($check)){
                    unlink($check);
                }
                // Upload File Baru
                $dok = $this->request->getFile('upload_dokumen');
                $extent = explode('.',$dok->getName());
                $extent = end($extent);
                $namaDokumen = "ID".$ID."_Dokumen_".date('Ymd-his').".".$extent;
                $dok->move($dir_doc, $namaDokumen, true);
            }
        }else if(!empty($this->request->getVar('link_dokumen'))){
            $namaDokumen = $this->request->getVar('link_dokumen');
        }else{
            $tipe_dokumen = $this->request->getVar('tipe_sebelumnya');
        }

        if($this->request->getFile('geojson_titik')->isValid()){
            // Menghapus File Sebelumnya
            $check = realpath($dir_geojson.$data["geojson_titik"]);
            if (is_file($check)){
                unlink($check);
            }
            // Upload File Baru
            $geo_titik = $this->request->getFile('geojson_titik');
            $extent = explode('.',$geo_titik->getName());
            $extent = end($extent);
            $namaGjsonTitik = "ID".$ID."_Titik_".date('Ymd-his').".".$extent;
            $geo_titik->move($dir_geojson, $namaGjsonTitik, true);
        }
        if($this->request->getFile('geojson_petak')->isValid()){
            // Menghapus File Sebelumnya
            $check = realpath($dir_geojson.$data["geojson_petak"]);
            if (is_file($check)){
                unlink($check);
            }
            // Upload File Baru
            $geo_petak = $this->request->getFile('geojson_petak');
            $extent = explode('.',$geo_petak->getName());
            $extent = end($extent);
            $namaGjsonPetak = "ID".$ID."_Petak_".date('Ymd-his').".".$extent;
            $geo_petak->move($dir_geojson, $namaGjsonPetak, true);
        }
        if($this->request->getFile('geojson_garis')->isValid()){
            // Menghapus File Sebelumnya
            $check = realpath($dir_geojson.$data["geojson_garis"]);
            if (is_file($check)){
                unlink($check);
            }
            // Upload File Baru
            $geo_garis = $this->request->getFile('geojson_garis');
            $extent = explode('.',$geo_garis->getName());
            $extent = end($extent);
            $namaGjsonGaris = "ID".$ID."_Garis_".date('Ymd-his').".".$extent;
            $geo_garis->move($dir_geojson, $namaGjsonGaris, true);
        }

        $this->M_SDAWilayah->save([
            'id' => $ID,
            'judul_data' => $this->request->getVar('judul_data'),
            'isi_data' => $this->request->getVar('isi'),
            'id_kategori' => $this->request->getVar('id_kategori'),
            'id_wilayah' => $this->request->getVar('id_wilayah'),
            'gambar' => $namaGambar,
            'dokumen' => $namaDokumen,
            'ket_dokumen' => $ket_dokumen,
            'geojson_titik' => $namaGjsonTitik,
            'geojson_garis' => $namaGjsonGaris,
            'geojson_petak' => $namaGjsonPetak,
            'diupload_oleh' => session()->get('username'),
            'tahun' => $this->request->getVar('tahun'),
        ]);

        session()->setFlashdata([
            "icon" => "success", "pesan" => "Data berhasil diubah",
        ]);
        return redirect()->to(base_url('Admin/sda_wilayah/'.$this->request->getVar('id_wilayah')));
    }

    public function hapus_sda_wilayah($id)
    {
        $dir_geojson    = "uploads/sda_wilayah/geografis/";
        $dir_img        = 'uploads/sda_wilayah/gambar/';
        $dir_doc        = "uploads/sda_wilayah/dokumen/";

        $data = $this->M_SDAWilayah->find($id);
        
        $check = realpath($dir_img.$data["gambar"]);
        if (is_file($check)){
            unlink($check); // Hapus
        }
        $check = realpath($dir_doc.$data["dokumen"]);
        if (is_file($check)){
            unlink($check); // Hapus
        }
        $check = realpath($dir_geojson.$data["geojson_petak"]);
        if (is_file($check)){
            unlink($check); // Hapus
        }
        $check = realpath($dir_geojson.$data["geojson_garis"]);
        if (is_file($check)){
            unlink($check); // Hapus
        }
        $check = realpath($dir_geojson.$data["geojson_titik"]);
        if (is_file($check)){
            unlink($check); // Hapus
        }

        session()->setFlashdata([
            "icon" => "success", "pesan" => "Data telah dihapus",
        ]);

        $this->M_SDAWilayah->delete($id);

        return redirect()->to(base_url('Admin/sda_wilayah/'.$data["id_wilayah"]));
    }

    public function tambah_sda_prov()
    {
        $dir_geojson    = "uploads/sda_provinsi/geografis/";
        $dir_img        = 'uploads/sda_provinsi/gambar/';
        $dir_doc        = "uploads/sda_provinsi/dokumen/";

        $namaGambar=$namaGjsonPetak=$namaGjsonGaris=$namaGjsonTitik=$namaDokumen = "";
        $ket_dokumen = "";
        $tipe_dokumen = $this->request->getVar('tipe_dokumen');
        if(!empty($this->request->getVar('doc'))){
            $ket_dokumen = $ket_dokumen.$this->request->getVar('doc').";";
        }
        if(!empty($this->request->getVar('excel'))){
            $ket_dokumen = $ket_dokumen.$this->request->getVar('excel').";";
        }
        if(!empty($this->request->getVar('ppt'))){
            $ket_dokumen = $ket_dokumen.$this->request->getVar('ppt').";";
        }
        if(!empty($this->request->getVar('gambar_ket'))){
            $ket_dokumen = $ket_dokumen.$this->request->getVar('gambar_ket');
        }

        $getData = $this->M_SDAProvinsi->select('max(id) as lastID')->first();
        $ID = $getData["lastID"] + 1; // ID identification
        
        $validationRule = [
            'judul_data' => ['label' => 'Nama Data', 'rules' => ['required', 'max_length[150]']],
            'gambar' => ['label' => 'Gambar: ','rules' => ['mime_in[gambar,image/jpg,image/jpeg,image/png]','max_size[gambar,2040]']],
            'upload_dokumen' => ['rules' => ['ext_in[upload_dokumen,pdf,doc,docx,ppt,pptx,xlsx,zip]','max_size[upload_dokumen,10400]'],
                'errors' => [
                    'ext_in' => 'Input dokumen hanya boleh (pdf,ppt,doc,excel,zip)',
                ]],
            'geojson_titik' => ['label' => 'GIS Titik/Lokasi: ','rules' => ['ext_in[geojson_titik,kml,geojson]','max_size[geojson_titik,17000]']],
            'geojson_garis' => ['label' => 'GIS Garis/Saluran: ','rules' => ['ext_in[geojson_garis,kml,geojson]','max_size[geojson_garis,17000]']],
            'geojson_petak' => ['label' => 'GIS Petak/Polygon: ','rules' => ['ext_in[geojson_petak,kml,geojson]','max_size[geojson_petak,17000]']],
        ];
        if (!$this->validate($validationRule)) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        
        if($this->request->getFile('gambar')->isValid()){
            $img = $this->request->getFile('gambar');
            $extent = explode('.',$img->getName());
            $extent = end($extent);
            $namaGambar = "Gambar_Data_".$ID."_".date('Ymd-his').".".$extent;
            $img->move($dir_img, $namaGambar, true);
        }
        if($tipe_dokumen=="upload"){
            if($this->request->getFile('upload_dokumen')->isValid()){
                $dok = $this->request->getFile('upload_dokumen');
                $extent = explode('.',$dok->getName());
                $extent = end($extent);
                $namaDokumen = "ID".$ID."_Dokumen_".date('Ymd-his').".".$extent;
                $dok->move($dir_doc, $namaDokumen, true);
            }
        }else{
            $namaDokumen = $this->request->getVar('link_dokumen');
        }

        if($this->request->getFile('geojson_titik')->isValid() && ! $this->request->getFile('geojson_titik')->hasMoved()){
            $geo_titik = $this->request->getFile('geojson_titik');
            $extent = explode('.',$geo_titik->getName());
            $extent = end($extent);
            $namaGjsonTitik = "ID".$ID."_Titik_".date('Ymd-his').".".$extent;
            $geo_titik->move($dir_geojson, $namaGjsonTitik, true);
        }
        if($this->request->getFile('geojson_petak')->isValid()){
            $geo_petak = $this->request->getFile('geojson_petak');
            $extent = explode('.',$geo_petak->getName());
            $extent = end($extent);
            $namaGjsonPetak = "ID".$ID."_Petak_".date('Ymd-his').".".$extent;
            $geo_petak->move($dir_geojson, $namaGjsonPetak, true);
            // $file->move(directory, rename?, replace?);
        }
        if($this->request->getFile('geojson_garis')->isValid()){
            $geo_garis = $this->request->getFile('geojson_garis');
            $extent = explode('.',$geo_garis->getName());
            $extent = end($extent);
            $namaGjsonGaris = "ID".$ID."_Garis_".date('Ymd-his').".".$extent;
            $geo_garis->move($dir_geojson, $namaGjsonGaris, true);
        }

        $this->M_SDAProvinsi->insert([
            'id' => $ID,
            'judul_data' => $this->request->getVar('judul_data'),
            'isi_data' => $this->request->getVar('isi'),
            'id_kategori' => $this->request->getVar('id_kategori'),
            'gambar' => $namaGambar,
            'dokumen' => $namaDokumen,
            'tipe_dokumen' => $tipe_dokumen,
            'ket_dokumen' => $ket_dokumen,
            'geojson_titik' => $namaGjsonTitik,
            'geojson_garis' => $namaGjsonGaris,
            'geojson_petak' => $namaGjsonPetak,
            'diupload_oleh' => session()->get('username'),
            'tahun' => $this->request->getVar('tahun'),
        ]);

        session()->setFlashdata([
            "icon" => "success", "pesan" => "Data berhasil ditambahkan",
        ]);
        return redirect()->to(base_url('Admin/sda_provinsi/'));
    }

    public function ubah_sda_prov($id)
    {
        $dir_geojson    = "uploads/sda_provinsi/geografis/";
        $dir_img        = 'uploads/sda_provinsi/gambar/';
        $dir_doc        = "uploads/sda_provinsi/dokumen/";

        $data = $this->M_SDAProvinsi->find($id);

        $namaGambar     = $this->request->getVar('gambar_sebelumnya');
        $namaDokumen    = $this->request->getVar('dokumen_sebelumnya');
        $namaGjsonPetak = $this->request->getVar('geopetak_sebelumnya');
        $namaGjsonGaris = $this->request->getVar('geogaris_sebelumnya');
        $namaGjsonTitik = $this->request->getVar('geotitik_sebelumnya');

        $ket_dokumen = "";
        $tipe_dokumen = $this->request->getVar('tipe_dokumen');
        if(!empty($this->request->getVar('doc'))){
            $ket_dokumen = $ket_dokumen.$this->request->getVar('doc').";";
        }
        if(!empty($this->request->getVar('excel'))){
            $ket_dokumen = $ket_dokumen.$this->request->getVar('excel').";";
        }
        if(!empty($this->request->getVar('ppt'))){
            $ket_dokumen = $ket_dokumen.$this->request->getVar('ppt').";";
        }
        if(!empty($this->request->getVar('gambar_ket'))){
            $ket_dokumen = $ket_dokumen.$this->request->getVar('gambar_ket');
        }

        if($ket_dokumen == ""){
            $ket_dokumen = $this->request->getVar('ket_sebelumnya');
        }

        $ID = $id;
        
        $validationRule = [
            'judul_data' => ['label' => 'Nama Data', 'rules' => ['required', 'max_length[150]']],
            'gambar' => ['label' => 'Gambar: ','rules' => ['mime_in[gambar,image/jpg,image/jpeg,image/png]','max_size[gambar,2040]']],
            'upload_dokumen' => ['rules' => ['ext_in[upload_dokumen,pdf,doc,docx,ppt,pptx,xlsx,zip]','max_size[upload_dokumen,10400]'],
                'errors' => [
                    'ext_in' => 'Input dokumen hanya boleh (pdf,ppt,doc,excel,zip)',
                ]],
            'geojson_titik' => ['label' => 'GIS Titik/Lokasi: ','rules' => ['ext_in[geojson_titik,kml,geojson]','max_size[geojson_titik,17000]']],
            'geojson_garis' => ['label' => 'GIS Garis/Saluran: ','rules' => ['ext_in[geojson_garis,kml,geojson]','max_size[geojson_garis,17000]']],
            'geojson_petak' => ['label' => 'GIS Petak/Polygon: ','rules' => ['ext_in[geojson_petak,kml,geojson]','max_size[geojson_petak,17000]']],
        ];
        if (!$this->validate($validationRule)) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        if($this->request->getFile('gambar')->isValid()){
            // Hapus File Sebelumnya
            $check = realpath($dir_img.$data["gambar"]);
            if (is_file($check)){
                unlink($check);
            }
            // Upload File Baru 
            $img = $this->request->getFile('gambar');
            $extent = explode('.',$img->getName());
            $extent = end($extent);
            $namaGambar = "Gambar_Data_".$ID."_".date('Ymd-his').".".$extent;
            $img->move($dir_img, $namaGambar, true);
        }

        if($tipe_dokumen=="upload"){
            if($this->request->getFile('upload_dokumen')->isValid()){
                // Hapus File Sebelumnya
                $check = realpath($dir_doc.$data["dokumen"]);
                if (is_file($check)){
                    unlink($check);
                }
                // Upload File Baru
                $dok = $this->request->getFile('upload_dokumen');
                $extent = explode('.',$dok->getName());
                $extent = end($extent);
                $namaDokumen = "ID".$ID."_Dokumen_".date('Ymd-his').".".$extent;
                $dok->move($dir_doc, $namaDokumen, true);
            }
        }else if(!empty($this->request->getVar('link_dokumen'))){
            $namaDokumen = $this->request->getVar('link_dokumen');
        }else{
            $tipe_dokumen = $this->request->getVar('tipe_sebelumnya');
        }

        if($this->request->getFile('geojson_titik')->isValid()){
            // Hapus File Sebelumnya
            $check = realpath($dir_geojson.$data["geojson_titik"]);
            if (is_file($check)){
                unlink($check);
            }
            // Upload File Baru
            $geo_titik = $this->request->getFile('geojson_titik');
            $extent = explode('.',$geo_titik->getName());
            $extent = end($extent);
            $namaGjsonTitik = "ID".$ID."_Titik_".date('Ymd-his').".".$extent;
            $geo_titik->move($dir_geojson, $namaGjsonTitik, true);
        }
        if($this->request->getFile('geojson_petak')->isValid()){
            // Hapus File Sebelumnya
            $check = realpath($dir_geojson.$data["geojson_petak"]);
            if (is_file($check)){
                unlink($check);
            }
            // Upload File Baru
            $geo_petak = $this->request->getFile('geojson_petak');
            $extent = explode('.',$geo_petak->getName());
            $extent = end($extent);
            $namaGjsonPetak = "ID".$ID."_Petak_".date('Ymd-his').".".$extent;
            $geo_petak->move($dir_geojson, $namaGjsonPetak, true);
        }
        if($this->request->getFile('geojson_garis')->isValid()){
            // Hapus File Sebelumnya
            $check = realpath($dir_geojson.$data["geojson_garis"]);
            if (is_file($check)){
                unlink($check);
            }
            // Upload File Baru
            $geo_garis = $this->request->getFile('geojson_garis');
            $extent = explode('.',$geo_garis->getName());
            $extent = end($extent);
            $namaGjsonGaris = "ID".$ID."_Garis_".date('Ymd-his').".".$extent;
            $geo_garis->move($dir_geojson, $namaGjsonGaris, true);
        }

        $this->M_SDAProvinsi->save([
            'id' => $ID,
            'judul_data' => $this->request->getVar('judul_data'),
            'isi_data' => $this->request->getVar('isi'),
            'id_kategori' => $this->request->getVar('id_kategori'),
            'gambar' => $namaGambar,
            'dokumen' => $namaDokumen,
            'tipe_dokumen' => $tipe_dokumen,
            'ket_dokumen' => $ket_dokumen,
            'geojson_titik' => $namaGjsonTitik,
            'geojson_garis' => $namaGjsonGaris,
            'geojson_petak' => $namaGjsonPetak,
            'diupload_oleh' => session()->get('username'),
            'tahun' => $this->request->getVar('tahun'),
        ]);

        session()->setFlashdata([
            "icon" => "success", "pesan" => "Data berhasil diubah",
        ]);
        return redirect()->to(base_url('Admin/sda_provinsi/'));
    }

    public function hapus_sda_prov($id)
    {
        $dir_geojson    = "uploads/sda_provinsi/geojson/";
        $dir_img        = 'uploads/sda_provinsi/gambar/';
        $dir_doc        = "uploads/sda_provinsi/dokumen/";

        $data = $this->M_SDAProvinsi->find($id);

        $check = realpath($dir_img.$data["gambar"]);
        if (is_file($check)){
            unlink($check); // Hapus
        }
        $check = realpath($dir_doc.$data["dokumen"]);
        if (is_file($check)){
            unlink($check); // Hapus
        }
        $check = realpath($dir_geojson.$data["geojson_petak"]);
        if (is_file($check)){
            unlink($check); // Hapus
        }
        $check = realpath($dir_geojson.$data["geojson_garis"]);
        if (is_file($check)){
            unlink($check); // Hapus
        }
        $check = realpath($dir_geojson.$data["geojson_titik"]);
        if (is_file($check)){
            unlink($check); // Hapus
        }

        $this->M_SDAProvinsi->delete($id);

        session()->setFlashdata([
            "icon" => "success", "pesan" => "Data telah dihapus",
        ]);

        session()->setFlashdata([
            "icon" => "success", "pesan" => "Data telah dihapus",
        ]);

        return redirect()->to(base_url('Admin/sda_provinsi/'));
    }

}