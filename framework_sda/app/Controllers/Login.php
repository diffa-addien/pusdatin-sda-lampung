<?php

namespace App\Controllers;

class Login extends _BaseController
{

    public function index()
    {
        $ModelAkun = new \App\Models\M_Akun();
        $login = $this->request->getPost('login');
        if ($login) {
            $user_log = $this->request->getPost('user_log');
            $password = $this->request->getPost('password');

            if ($user_log == '' or $password == '') {
                $err = " Masukan username dan Password";
            }

            if (empty($err)) {
                $verif_username = $ModelAkun->where("username", $user_log)->first();

                if (!empty($verif_username)) {
                    $data_akun = $verif_username;
                    if (!password_verify($password, $data_akun['password'])) {
                        $err = "Password salah";
                    }
                } else {
                    $err = "username salah";
                }

                if (empty($err)) {
                    if ($verif_username["status"] != "aktif") {
                        $err = "Mohon maaf, akun anda belum bisa digunakan";
                    }
                }
            }

            if (empty($err)) {
                $dataSesi = [
                    'username' => $data_akun['username'],
                    'nama' => $data_akun['nama_lengkap'],
                    'role' => $data_akun['role'],
                    'wilayah' => $data_akun['wilayah'],
                ];
                session()->set($dataSesi);
                return redirect()->to(base_url('admin'));
            }
            if ($err) {
                session()->setFlashdata('username', $user_log);
                session()->setFlashdata('pesan', $err);
                return redirect()->to(base_url('Login'));
            }
        }

        $data = [
            'title' => 'Login',
        ];

        return view('view_admin/frame/login', $data);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('Login'));
    }

    public function cekPassword()
    {
        $ModelAkun = new \App\Models\M_Akun();
        $data_akun = $ModelAkun->where("username", $_POST['user'])->first();
        $password = $_POST['pw_lama'];

        if (password_verify($password, $data_akun['password'])) {
            return "1";
        } else {
            return "0";
        }
    }

    public function gantiPassword()
    {
        if ($this->request->getVar('pw_baru') != $this->request->getVar('pw_baru_konfir')) {
            $err = "Konfirmasi Password Salah";
            session()->setFlashdata([
              "icon" => "error", "pesan" => "Kofirmasi password baru tidak sama",
            ]);
            return redirect()->to(base_url('Admin/ganti_password'));
        }

        $ModelAkun = new \App\Models\M_Akun();

        $ModelAkun->save([
          'username' => session()->get('username'),
          'password' => password_hash($this->request->getVar('pw_baru'), PASSWORD_DEFAULT),
        ]);

        session()->setFlashdata([
            "icon" => "success", "pesan" => "Password Berhasil diubah",
        ]);
        return redirect()->to(base_url('Admin/ganti_password'));
    }

    public function lupa_password()
    {
        $data = [
            'title' => "Lupa Password",
        ];

        return view('view_admin/frame/lupa_password', $data);
    }

    public function v_register()
    {
        $ModelWilayah = new \App\Models\M_Wilayah();
        $getWilayah = $ModelWilayah->findAll();
        $data = [
            'title' => "Registrasi", "wilayah" => $getWilayah,
        ];

        return view('view_admin/frame/register', $data);
    }

    public function tambah_akun()
    {
        if (!empty($this->request->getVar('status'))) {
            $status = $this->request->getVar('status');
            $redirect = redirect()->to(base_url('Login/v_register'));
        } else {
            $status = "aktif";
            $redirect = redirect()->to(base_url('Admin/form_tambah_akun'));
        }

        $getUser = $this->request->getVar('username');
        $ModelAkun = new \App\Models\M_Akun();
        $dataAkun = $ModelAkun->query("SELECT * FROM akun where username='" . $getUser . "'")->getResult();

        if (!empty($dataAkun)) {
            session()->setFlashdata([
                "icon" => "error", "pesan" => "Maaf, username sudah digunakan",
            ]);
            return $redirect;
        }

        $modelValue = $ModelAkun->insert([
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'role' => $this->request->getVar('role'),
            'wilayah' => $this->request->getVar('val_wilayah'),
            'status' => $status,
            'tanggal_dibuat' => date('Y-m-d'),
        ]);

        session()->setFlashdata([
            "icon" => "success", "pesan" => "Akun berhasil ditambahkan",
        ]);

        return $redirect;

    }

}
