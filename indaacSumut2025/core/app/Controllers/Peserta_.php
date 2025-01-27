<?php

namespace App\Controllers;

use Picqer;


class Peserta_ extends BaseController
{
    public function login()
    {
        $session    = session();
        $username   = $this->request->getPost('username');
        $password   = $this->request->getPost('password');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.register.co.id/api/LoginAkun',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
            "username" : "' . $username . '",
            "password" : "' . $password . '"
        }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $hasilResponse = json_decode($response, true);
        // Logika 
        if ($httpcode == 400) {
            $ses_data = [
                'status'        => "Gagal",
                'keterangan'    => $hasilResponse['messages']
            ];
            $session->set($ses_data);
            return redirect()->back();
        } else {
            if ($hasilResponse['data']['idHakAkses'] != 4) {
                if ($hasilResponse['data']['idHakAkses'] == 6) {
                    $ses_data = [
                        'status'        => "Berhasil",
                        'keterangan'    => $hasilResponse['messages'],
                        'username'      => $hasilResponse['data']['username'],
                        'idAkun'        => $hasilResponse['data']['idAkun'],
                        'event'         => $hasilResponse['data']['event'],
                        'statusPenjaga' => $hasilResponse['data']['statusPenjaga'],
                        'token'         => $hasilResponse['data']['token'],
                        'statusLogin'   => "1"
                    ];
                    $session->set($ses_data);
                    if ($hasilResponse['data']['statusPenjaga'] == 0) {
                        return redirect()->to(base_url() . 'UpdatePenjagaStand');
                    } else {
                        return redirect()->to(base_url() . 'DashboardStand');
                    }
                }
                $ses_data = [
                    'status'        => "Gagal",
                    'keterangan'    => "Akun yang dimasukkan bukan akun peserta"
                ];
                $session->set($ses_data);
                return redirect()->back();
            } else {
                $ses_data = [
                    'status'        => "Berhasil",
                    'keterangan'    => $hasilResponse['messages'],
                    'username'      => $hasilResponse['data']['username'],
                    'kodePeserta'   => $hasilResponse['data']['kodePeserta'],
                    'namaPeserta'   => $hasilResponse['data']['namaPeserta'],
                    'event'         => $hasilResponse['data']['event'],
                    'namaEvent'     => $hasilResponse['data']['namaEvent'],
                    'idPeserta'     => $hasilResponse['data']['idPeserta'],
                    'hakAkses'      => $hasilResponse['data']['idHakAkses'],
                    'token'         => $hasilResponse['data']['token'],
                    'statusLogin'   => "1"
                ];
            }
            $session->set($ses_data);
            return redirect()->to(base_url() . 'Dashboard');
        }
    }

    public function loginOperator()
    {
        $session    = session();
        $username   = $this->request->getPost('username');
        $password   = $this->request->getPost('password');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.register.co.id/api/LoginAkun',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
            "username" : "' . $username . '",
            "password" : "' . $password . '"
        }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $hasilResponse = json_decode($response, true);
        // Logika 
        if ($httpcode == 400) {
            $ses_data = [
                'status'        => "Gagal",
                'keterangan'    => $hasilResponse['messages']
            ];
            $session->set($ses_data);
            return redirect()->back();
        } else {
            $ses_data = [
                'status'                => "Berhasil",
                'keterangan'            => $hasilResponse['messages'],
                'namaOperator'          => $hasilResponse['data']['namaOperator'],
                'username'              => $hasilResponse['data']['username'],
                'event'                 => $hasilResponse['data']['event'],
                'namaEvent'             => $hasilResponse['data']['namaEvent'],
                'idOperator'            => $hasilResponse['data']['idOperator'],
                'hakAkses'              => $hasilResponse['data']['idHakAkses'],
                'namaHakAkses'          => $hasilResponse['data']['namaHakAkses'],
                'token'                 => $hasilResponse['data']['token'],
                'statusLogin'           => "1"
            ];
            $session->set($ses_data);
            return redirect()->to(base_url() . 'DashboardOperator');
        }
    }
    public function konfirmasiPembayaranPeserta($idPeserta = null, $status = null)
    {
        $session   = session();
        $username  = $session->get('username');
        $token     = $session->get('token');

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.register.co.id/api/KonfirmasiPembayaranPeserta/' . $idPeserta . '/' . $status . '/' . $username,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token
            ),
        ));
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $hasilResponse = json_decode($response, true);
        // Logika 
        if ($httpcode == 400) {
            $ses_data = [
                'status'        => "Gagal",
                'keterangan'    => $hasilResponse['messages']
            ];
            $session->set($ses_data);
            return redirect()->back();
        } else {
            $ses_data = [
                'status'                => "Berhasil",
                'keterangan'            => $hasilResponse['messages'],
            ];
            $session->set($ses_data);
            return redirect()->back();
        }
    }
    public function updateJenisPeserta($idPeserta = null)
    {
        $session      = session();
        $username     = $session->get('username');
        $token        = $session->get('token');
        $peserta      = $this->request->getPost('peserta');
        $panitia      = $this->request->getPost('panitia');
        $moderator    = $this->request->getPost('moderator');
        $stand        = $this->request->getPost('stand');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.register.co.id/api/UpdateJenisPeserta',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "usernameAkses" : "' . $username . '",
                "idPeserta" : "' . $idPeserta . '",
                "peserta" : "' . $peserta . '",
                "panitia" : "' . $panitia . '",
                "moderator" : "' . $moderator . '",
                "stand" : "' . $stand . '"
            }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $hasilResponse = json_decode($response, true);
        // Logika 
        if ($httpcode == 400) {
            $ses_data = [
                'status'        => "Gagal",
                'keterangan'    => $hasilResponse['messages']
            ];
            $session->set($ses_data);
            return redirect()->back();
        } else {
            $ses_data = [
                'status'                => "Berhasil",
                'keterangan'            => $hasilResponse['messages'],
            ];
            $session->set($ses_data);
            return redirect()->back();
        }
    }
    public function editDataPeserta($idPeserta = null)
    {
        $session                = session();
        $username               = $session->get('username');
        $token                  = $session->get('token');
        $usernamePeserta        = $this->request->getPost('username');
        $nikPeserta             = $this->request->getPost('nikPeserta');
        $namaPeserta            = $this->request->getPost('namaPeserta');
        $nomorTeleponPeserta    = $this->request->getPost('nomorTeleponPeserta');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.register.co.id/api/EditPeserta/' . $idPeserta,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "usernameAkses" : "' . $username . '",
                "usernamePeserta" : "' . $usernamePeserta . '",
                "nikPeserta" : "' . $nikPeserta . '",
                "namaPeserta" : "' . $namaPeserta . '",
                "nomorTeleponPeserta" : "' . $nomorTeleponPeserta . '"
            }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $hasilResponse = json_decode($response, true);
        // Logika 
        if ($httpcode == 400) {
            $ses_data = [
                'status'        => "Gagal",
                'keterangan'    => $hasilResponse['messages']
            ];
            $session->set($ses_data);
            return redirect()->back();
        } else {
            $ses_data = [
                'status'                => "Berhasil",
                'keterangan'            => $hasilResponse['messages'],
            ];
            $session->set($ses_data);
            return redirect()->back();
        }
    }
    public function editProfil($idPeserta = null)
    {
        $session         = session();
        $username        = $session->get('username');
        $token           = $session->get('token');
        $namaPeserta     = $this->request->getPost('namaPeserta');
        $emailPeserta    = $this->request->getPost('emailPeserta');
        $namaKlinik      = $this->request->getPost('namaKlinik');
        $alamatKlinik    = $this->request->getPost('alamatKlinik');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.register.co.id/api/EditProfil/' . $idPeserta,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "usernameAkses" : "' . $username . '",
                "namaPeserta" : "' . $namaPeserta . '",
                "emailPeserta" : "' . $emailPeserta . '",
                "namaKlinik" : "' . $namaKlinik . '",
                "alamatKlinik" : "' . $alamatKlinik . '"
            }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $hasilResponse = json_decode($response, true);
        // Logika 
        if ($httpcode == 400) {
            $ses_data = [
                'status'        => "Gagal",
                'keterangan'    => $hasilResponse['messages']
            ];
            $session->set($ses_data);
            return redirect()->back();
        } else {
            $ses_data = [
                'status'                => "Berhasil",
                'keterangan'            => $hasilResponse['messages'],
            ];
            $session->set($ses_data);
            return redirect()->back();
        }
    }
    public function HapusPeserta($idPeserta = null)
    {
        $session   = session();
        $username  = $session->get('username');
        $token     = $session->get('token');

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.register.co.id/api/HapusPeserta/' . $idPeserta  . '/' . $username,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token
            ),
        ));
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $hasilResponse = json_decode($response, true);
        // Logika 
        if ($httpcode == 400) {
            $ses_data = [
                'status'        => "Gagal",
                'keterangan'    => $hasilResponse['messages']
            ];
            $session->set($ses_data);
            return redirect()->back();
        } else {
            $ses_data = [
                'status'                => "Berhasil",
                'keterangan'            => $hasilResponse['messages'],
            ];
            $session->set($ses_data);
            return redirect()->back();
        }
    }
    public function konfirmasiKehadiran()
    {
        $session   = session();
        $username  = $session->get('username');
        $token     = $session->get('token');
        $kodePeserta = $this->request->getPost('kodePeserta');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.register.co.id/api/KonfirmasiKehadiran/' . $kodePeserta . '/' . $username,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token
            ),
        ));
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $hasilResponse = json_decode($response, true);
        // Logika 
        if ($httpcode == 400) {
            $ses_data = [
                'status'        => "Gagal",
                'keterangan'    => $hasilResponse['messages']
            ];
            $session->set($ses_data);
            return redirect()->back();
        } else if ($httpcode == 202) {
            $ses_data = [
                'status'        => "Peringatan",
                'keterangan'    => $hasilResponse['messages']
            ];
            $session->set($ses_data);
            return redirect()->back();
        } else {
            $ses_data = [
                'status'                => "Berhasil",
                'keterangan'            => $hasilResponse['messages'],
            ];
            $session->set($ses_data);
            return redirect()->back();
            // return redirect()->to(base_url() . 'TampilDataKehadiran');
        }
    }
    public function konfirmasiMasuk()
    {
        $session   = session();
        $token     = $session->get('token');
        $id        = $this->request->getPost('id');
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.register.co.id/api/KonfirmasiMasukRuangan/' . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token
            ),
        ));
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $hasilResponse = json_decode($response, true);
        // Logika 
        if ($httpcode == 400) {
            $ses_data = [
                'status'        => "Gagal",
                'keterangan'    => $hasilResponse['messages']
            ];
            $session->set($ses_data);
            return redirect()->back();
        } else if ($httpcode == 202) {
            $ses_data = [
                'status'        => "Peringatan",
                'keterangan'    => $hasilResponse['messages']
            ];
            $session->set($ses_data);
            return redirect()->back();
        } else {
            $ses_data = [
                'status'                => "Berhasil",
                'keterangan'            => $hasilResponse['messages'],
            ];
            $session->set($ses_data);
            return redirect()->back();
            // return redirect()->to(base_url() . 'TampilDataKehadiran');
        }

        return view('tampilDataPeserta', compact('data'));
    }
    public function keluar()
    {
        $session     = session();
        $session->destroy();
        return redirect()->to(base_url());
    }
    public function updateFotoProfil($idPeserta = null)
    {
        $session   = session();
        $username  = $session->get('username');
        $token     = $session->get('token');
        $foto      = $this->request->getFile('foto');

        // Pengecekan Untuk Foto Peserta
        if ($foto->getError() != 4) {
            $validasiFoto = $this->validate([
                'foto' => [
                    'uploaded[foto]',
                    'mime_in[foto,application/pdf,image/jpeg,image/png]',
                    'max_size[foto,7168]',
                ],
            ]);
            if ($validasiFoto == false) {
                $ses_data = [
                    'status'  => "Gagal",
                    'waktu'    => "File terlalu besar atau tipe file tidak sesuai, file max 1,5 mb dan tipe data jpg/jpeg, silahkan coba lagi"
                ];
                $session->set($ses_data);
                return redirect()->back();
            }
            $fotoUpload = curl_file_create($foto->getRealPath(), 'application/pdf,image/jpeg', $foto->getName());
        } else {
            $fotoUpload = curl_file_create(base_url() . 'kosong.jpg', 'application/pdf,image/jpeg', 'kosong.jpg');
        }

        $post = [
            'usernameAkses' => $username,
            'foto'          => $fotoUpload
        ];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.register.co.id/api/UpdateFotoProfil/' . $idPeserta,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token
            ),
            CURLOPT_POSTFIELDS => $post,
        ));
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $hasilResponse = json_decode($response, true);

        // Logika 
        if ($httpcode == 400) {
            $ses_data = [
                'status'        => "Gagal",
                'keterangan'    => $hasilResponse['messages']
            ];
            $session->set($ses_data);
            return redirect()->back();
        } else {
            $ses_data = [
                'status'        => "Berhasil",
                'keterangan'    => $hasilResponse['messages']
            ];
            $session->set($ses_data);
            return redirect()->back();
        }
    }

    // Proses Penjaga Stand / Booth
    public function tambahBooth()
    {
        $session        = session();
        $token          = $session->get('token');
        $usernameAkses  = $session->get('username');
        $user1          = $this->request->getPost('user1');
        $user2          = $this->request->getPost('user2');
        $user3          = $this->request->getPost('user3');
        $namaPerusahaan = $this->request->getPost('perusahaan');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.register.co.id/api/PendaftaranPenjagaStand',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => '{
                "usernameAkses" : "' . $usernameAkses . '",
                "user1" : "' . $user1 . '",
                "user2" : "' . $user2 . '",
                "user3" : "' . $user3 . '",
                "perusahaan" : "' . $namaPerusahaan . '"
            }',
        ));
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $hasilResponse = json_decode($response, true);
        // Logika 
        if ($httpcode == 400) {
            $ses_data = [
                'status'        => "Gagal",
                'keterangan'    => $hasilResponse['messages']
            ];
            $session->set($ses_data);
            return redirect()->back();
        } else {
            $ses_data = [
                'status'        => "Berhasil",
                'keterangan'    => $hasilResponse['messages']
            ];
            $session->set($ses_data);
            return redirect()->back();
        }
    }
    public function updateBooth($idPenjagaStand = null)
    {
        $session        = session();
        $token          = $session->get('token');
        $berkasKTP      = $this->request->getFile('berkasKTP');
        // Pengecekan Untuk Foto Peserta
        if ($berkasKTP->getError() != 4) {
            $validasiBerkasKTP = $this->validate([
                'berkasKTP' => [
                    'uploaded[berkasKTP]',
                    'mime_in[berkasKTP,application/pdf,image/jpeg,image/png]',
                    'max_size[berkasKTP,7168]',
                ],
            ]);
            if ($validasiBerkasKTP == false) {
                $ses_data = [
                    'status'  => "Gagal",
                    'messages'    => "File terlalu besar atau tipe file tidak sesuai, file max 1,5 mb dan tipe data jpg/jpeg, silahkan coba lagi"
                ];
                $session->set($ses_data);
                return redirect()->back();
            }
            $berkasKTPUpload = curl_file_create($berkasKTP->getRealPath(), 'application/pdf,image/jpeg', $berkasKTP->getName());
        } else {
            $berkasKTPUpload = curl_file_create(base_url() . 'kosong.jpg', 'application/pdf,image/jpeg', 'kosong.jpg');
        }
        $post = [
            'berkasKTP'      => $berkasKTPUpload
        ];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.register.co.id/api/UpdatePenjagaStand/' . $idPenjagaStand,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token
            ),
            CURLOPT_POSTFIELDS => $post,
        ));
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $hasilResponse = json_decode($response, true);
        // Logika 
        if ($httpcode == 400) {
            $ses_data = [
                'status'        => "Gagal",
                'keterangan'    => $hasilResponse['messages']
            ];
            $session->set($ses_data);
            return redirect()->back();
        } else {
            $ses_data = [
                'status'        => "Berhasil",
                'keterangan'    => $hasilResponse['messages']
            ];
            $session->set($ses_data);
            return redirect()->back();
        }
    }
    public function hapusPenjagaStand($idPenjagaStand = null)
    {
        $session   = session();
        $username  = $session->get('username');
        $token     = $session->get('token');

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.register.co.id/api/HapusPenjagaStand/' . $idPenjagaStand  . '/' . $username,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token
            ),
        ));
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $hasilResponse = json_decode($response, true);
        // Logika 
        if ($httpcode == 400) {
            $ses_data = [
                'status'        => "Gagal",
                'keterangan'    => $hasilResponse['messages']
            ];
            $session->set($ses_data);
            return redirect()->back();
        } else {
            $ses_data = [
                'status'                => "Berhasil",
                'keterangan'            => $hasilResponse['messages'],
            ];
            $session->set($ses_data);
            return redirect()->back();
        }
    }
    public function cekBarcodePenjagaBooth()
    {
        $session   = session();
        $username  = $session->get('username');
        $token     = $session->get('token');
        $barcode   = $this->request->getPost('barcode');

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.register.co.id/api/CekBarcodePenjagaBooth/' . $barcode,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token
            ),
        ));
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $hasilResponse = json_decode($response, true);
        // Logika 
        if ($httpcode == 400) {
            $ses_data = [
                'status'        => "Gagal",
                'keterangan'    => $hasilResponse['messages']
            ];
            $session->set($ses_data);
            return redirect()->back();
        } else {
            $ses_data = [
                'status'                => "Berhasil",
                'keterangan'            => $hasilResponse['messages'] . " <br><b>Nama : " . $hasilResponse['data'][0]['namaLengkap'] . " <br> Nama Perusahaan : " . $hasilResponse['data'][0]['perusahaan'] . "</b>",
            ];
            $session->set($ses_data);
            return redirect()->back();
        }
    }
    public function DownloadBarcode($kodePeserta = null)
    {
        $barcode   = $this->request->getPost('barcode');
        $tipeBarcode   = "PNG";
        $isiBarcode    = $kodePeserta;

        $barcode = (new Picqer\Barcode\Types\TypeCodabar())->getBarcode($kodePeserta);
        $renderer = new Picqer\Barcode\Renderers\JpgRenderer();

        file_put_contents("uploads/barcode/" . $kodePeserta . ".jpg", $renderer->render($barcode, $barcode->getWidth()));
        return $this->response->download(FCPATH  . '/uploads/barcode/' . $kodePeserta . '.jpg', null);

        return redirect()->back();
    }
}