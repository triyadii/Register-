<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Model_akun;
use App\Models\Model_log;
use App\Models\Model_data;
use \Firebase\JWT\JWT;

class Akun extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        $modelData    = new Model_data;
        $dataAkun     = $modelData->tampilSeluruhAkun();
        $response = [
            'status'    => 200,
            'messages'  => "Berhasil Menampilkan Seluruh Akun",
            'data'      => $dataAkun
        ];
        return $this->respond($response, 200);
    }
    public function login()
    {
        $modelLog       = new Model_log;
        $modelData      = new Model_data;
        $username       = $this->request->getVar('username');
        $password       = $this->request->getVar('password');
        $cekUsername    = $modelData->cekUsername($username);
        if ($cekUsername == null) {
            $dataLog = [
                'username'      => "Tidak Diketahui",
                'waktu'         => date('Y-m-d H:i:s'),
                'keterangan'    => "Username " . $username . " tidak ditemukan dalam databases"
            ];
            $modelLog->insert($dataLog);
            $response = [
                'status'    => 400,
                'messages'  => "Mohon Maaf, username tidak ditemukan",
            ];
            return $this->respond($response, 400);
        }
        $cekPassword    = password_verify($password, $cekUsername[0]['password']);
        if ($cekPassword == true) {
            $dataLog = [
                'username'      => $cekUsername[0]['username'],
                'waktu'         => date('Y-m-d H:i:s'),
                'keterangan'    => $cekUsername[0]['username'] . "Berhasil Login ke dalam Aplikasi"
            ];
            $modelLog->insert($dataLog);

            // Proses JWT
            $key = getenv('JWT_SECRET');
            $iat = time(); // current timestamp value
            $exp = $iat + 86400;
            $payload = array(
                "iss"       => "Issuer of the JWT",
                "aud"       => "Audience that the JWT",
                "sub"       => "Subject of the JWT",
                "iat"       => $iat, //Time the JWT issued at
                "exp"       => $exp, // Expiration time of token
                "username"  => $username,
            );
            $token = JWT::encode($payload, $key, 'HS256');

            // Jika Admin
            if ($cekUsername[0]['hakAkses'] == "1") {
                $response = [
                    'status'    => 200,
                    'messages'  => "Login Berhasil",
                    'data'      => [
                        'username'      => $cekUsername[0]['username'],
                        'nama'          => $cekUsername[0]['username'],
                        'hakAkses'      => $cekUsername[0]['hakAkses'],
                        'namaHakAkses'  => $cekUsername[0]['namaHakAkses'],
                        'userId'        => $cekUsername[0]['idAkun'],
                        'token'         => $token,
                    ]
                ];
            }
            // Jika Operator
            else if ($cekUsername[0]['hakAkses'] == "2") {
                $cekOperator    = $modelData->cekAkunOperator($cekUsername[0]['idAkun']);
                $response = [
                    'status'    => 200,
                    'messages'  => "Login Berhasil",
                    'data'      => [
                        'namaOperator'   => $cekOperator[0]['namaOperator'],
                        'event'          => $cekOperator[0]['event'],
                        'namaEvent'      => $cekOperator[0]['namaEvent'],
                        'idOperator'     => $cekOperator[0]['idOperator'],
                        'namaHakAkses'   => $cekOperator[0]['namaHakAkses'],
                        'idHakAkses'     => $cekOperator[0]['idHakAkses'],
                        'username'       => $cekOperator[0]['username'],
                        'token'          => $token
                    ]
                ];
            } // Jika Validator
            else if ($cekUsername[0]['hakAkses'] == "3") {
                $cekOperator    = $modelData->cekAkunOperator($cekUsername[0]['idAkun']);
                $response = [
                    'status'    => 200,
                    'messages'  => "Login Berhasil",
                    'data'      => [
                        'namaOperator'   => $cekOperator[0]['namaOperator'],
                        'event'          => $cekOperator[0]['event'],
                        'namaEvent'      => $cekOperator[0]['namaEvent'],
                        'idOperator'     => $cekOperator[0]['idOperator'],
                        'namaHakAkses'   => $cekOperator[0]['namaHakAkses'],
                        'idHakAkses'     => $cekOperator[0]['idHakAkses'],
                        'username'       => $cekOperator[0]['username'],
                        'token'          => $token
                    ]
                ];
            } // Jika Peserta
            else if ($cekUsername[0]['hakAkses'] == "4") {
                $cekPeserta    = $modelData->cekAkunPeserta($cekUsername[0]['idAkun']);
                $response = [
                    'status'    => 200,
                    'messages'  => "Login Berhasil",
                    'data'      => [
                        'username'      => $cekPeserta[0]['username'],
                        'namaPeserta'   => $cekPeserta[0]['namaPeserta'],
                        'event'         => $cekPeserta[0]['event'],
                        'namaEvent'     => $cekPeserta[0]['namaEvent'],
                        'idPeserta'     => $cekPeserta[0]['idPeserta'],
                        'namaHakAkses'   => $cekUsername[0]['namaHakAkses'],
                        'idHakAkses'     => $cekUsername[0]['idHakAkses'],
                        'username'       => $cekUsername[0]['username'],
                        'token'         => $token,
                    ]
                ];
            } // Jika Panitia
            else if ($cekUsername[0]['hakAkses'] == "5") {
                $cekPeserta    = $modelData->cekAkunPeserta($cekUsername[0]['idAkun']);
                $response = [
                    'status'    => 200,
                    'messages'  => "Login Berhasil",
                    'data'      => [
                        'username'      => $cekPeserta[0]['username'],
                        'namaPeserta'   => $cekPeserta[0]['namaPeserta'],
                        'event'         => $cekPeserta[0]['event'],
                        'namaEvent'     => $cekPeserta[0]['namaEvent'],
                        'idPeserta'     => $cekPeserta[0]['idPeserta'],
                        'namaHakAkses'   => $cekPeserta[0]['namaHakAkses'],
                        'idHakAkses'     => $cekPeserta[0]['idHakAkses'],
                        'token'         => $token,
                    ]
                ];
            } // Jika Stand
            else if ($cekUsername[0]['hakAkses'] == "6") {
                $cekPeserta    = $modelData->cekAkunPeserta($cekUsername[0]['idAkun']);
                $response = [
                    'status'    => 200,
                    'messages'  => "Login Berhasil",
                    'data'      => [
                        'username'      => $cekPeserta[0]['username'],
                        'namaPeserta'   => $cekPeserta[0]['namaPeserta'],
                        'event'         => $cekPeserta[0]['event'],
                        'namaEvent'     => $cekPeserta[0]['namaEvent'],
                        'idPeserta'     => $cekPeserta[0]['idPeserta'],
                        'namaHakAkses'   => $cekPeserta[0]['namaHakAkses'],
                        'idHakAkses'     => $cekPeserta[0]['idHakAkses'],
                        'token'         => $token,
                    ]
                ];
            }
            return $this->respond($response, 200);
        } else {
            $dataLog = [
                'username'     => "Tidak Diketahui",
                'waktu'         => date('Y-m-d H:i:s'),
                'keterangan'    => $username . "Gagal melakukan login karena password salah"
            ];
            $modelLog->insert($dataLog);
            $response = [
                'status'    => 400,
                'messages'  => "Mohon Maaf, password anda salah",
            ];
            return $this->respond($response, 400);
        }
    }
    public function create()
    {
        $modelAkun      = new Model_akun;
        $modelLog       = new Model_log;
        $modelData      = new Model_data;
        $usernameAkses  = $this->request->getVar('usernameAkses');
        $nama           = $this->request->getVar('nama');
        $nomorTelepon   = $this->request->getVar('nomorTelepon');
        $username       = $this->request->getVar('username');
        $hakAkses       = $this->request->getVar('hakAkses');
        $password       = $this->request->getVar('password');
        $cekUsername    = $modelData->cekUsername($username);
        if ($cekUsername != null) {
            $dataLog = [
                'username'      => $usernameAkses,
                'waktu'         => date('Y-m-d H:i:s'),
                'keterangan'    => "Penambahan akun gagal karena username sudah ada di dalam sistem"
            ];
            $modelLog->insert($dataLog);
            $response = [
                'status'    => 400,
                'messages'  => "Mohon Maaf, username sudah ada di database, mohon di lakukan perubahan",
            ];
            return $this->respond($response, 400);
        }
        $hashPassword   = [
            'cost' => 10,
        ];
        $data = [
            'nama'      => $nama,
            'username'  => $username,
            'password'  => password_hash($password, PASSWORD_DEFAULT, $hashPassword),
            'hakAkses'  => $hakAkses,
        ];
        $modelAkun->insert($data);
        $dataLog = [
            'username'      => $usernameAkses,
            'waktu'         => date('Y-m-d H:i:s'),
            'keterangan'    => "Berhasil penambahan akun dengan nama akun " . $nama
        ];
        $modelLog->insert($dataLog);
        $response = [
            'status'    => 200,
            'messages'  => "Berhasil Melakukan Penambahan Akun Baru",
            'data'      => $data
        ];
        return $this->respond($response, 200);
    }
    public function edit($idAkun = null)
    {
        $modelAkun          = new Model_akun;
        $modelLog           = new Model_log;
        $modelData          = new Model_data;
        $usernameAkses      = $this->request->getVar('usernameAkses');
        $nama               = $this->request->getVar('nama');
        $nomorTelepon       = $this->request->getVar('nomorTelepon');
        $username           = $this->request->getVar('username');
        $hakAkses           = $this->request->getVar('hakAkses');
        $cekUsername        = $modelData->cekUsername($username);
        if ($cekUsername != null) {
            $data = [
                'nama'          => $nama,
                'nomorTelepon'  => $nomorTelepon,
                'hakAkses'      => $hakAkses,
            ];
        } else {
            $data = [
                'nama'          => $nama,
                'nomorTelepon'  => $nomorTelepon,
                'username'      => $username,
                'hakAkses'      => $hakAkses,
            ];
        }

        $modelAkun->update($idAkun, $data);
        $dataLog = [
            'username'      => $usernameAkses,
            'waktu'         => date('Y-m-d H:i:s'),
            'keterangan'    => "Melakukan perubahan data pada akun " . $nama
        ];
        $modelLog->insert($dataLog);
        $response = [
            'status'    => 200,
            'messages'  => "Berhasil melakukan perubahan akun",
        ];
        return $this->respond($response, 200);
    }
    public function gantiPassword($idAkun = null)
    {
        $modelAkun          = new Model_akun;
        $modelLog           = new Model_log;
        $modelData          = new Model_data;
        $dataAkun           = $modelData->cekAkunById($idAkun);
        $usernameAkses      = $this->request->getVar('usernameAkses');
        $passwordLama       = $this->request->getVar('passwordLama');
        $passwordBaru       = $this->request->getVar('passwordBaru');
        $cekPassword        = password_verify($passwordLama, $dataAkun[0]['password']);
        if ($cekPassword != true) {
            $dataLog = [
                'username'      => $usernameAkses,
                'waktu'         => date('Y-m-d H:i:s'),
                'keterangan'    => "Ganti Password gagal, karena password lama yang di masukkan salah"
            ];
            $modelLog->insert($dataLog);
            $response = [
                'status'    => 400,
                'messages'  => "Mohon Maaf, ganti password gagal karena password lama salah",
            ];
            return $this->respond($response, 400);
        }
        $hashPassword   = [
            'cost' => 10,
        ];
        $data = [
            'password' => password_hash($passwordBaru, PASSWORD_DEFAULT, $hashPassword)
        ];
        $modelAkun->update($idAkun, $data);
        $dataLog = [
            'username'      => $usernameAkses,
            'waktu'         => date('Y-m-d H:i:s'),
            'keterangan'    => "Ganti password akun" . $dataAkun[0]['nama']
        ];
        $modelLog->insert($dataLog);
        $response = [
            'status'    => 200,
            'messages'  => "Berhasil melakukan perubahan password"
        ];
        return $this->respond($response, 200);
    }
    public function lupaPassword()
    {
        $modelAkun          = new Model_akun;
        $modelLog           = new Model_log;
        $modelData          = new Model_data;
        $username           = $this->request->getVar('username');
        $cekUsername        = $modelData->cekUsername($username);
        if ($cekUsername == null) {
            $dataLog = [
                'username'      => "Tidak Diketahui",
                'waktu'         => date('Y-m-d H:i:s'),
                'keterangan'    => "Lupa Password gagal karena username " . $username . " Tidak ditemukan di database"
            ];
            $modelLog->insert($dataLog);
            $response = [
                'status'    => 400,
                'messages'  => "Mohon Maaf, Lupa Password tidak bisa di lakukan karena Username tidak ditemukan, silahkan coba lagi",
            ];
            return $this->respond($response, 400);
        }

        // Proses Kirim Link Lupa Password Ke WA
        $pesan = "Silahkan Klik Link di bawah ini untuk melakukan proses lupa password \nhttp://localhost/project/RegistrasiEvent";
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://app.wapanels.com/api/create-message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'appkey' => 'f21ef4d0-ae66-4388-9e30-791f9c841080',
                'authkey' => 'G1BdG8QGccMQfi0gaPf6QYzaILNdkJAhzjBi0WfBEh6PaoRRL6',
                'to' => $cekUsername[0]['nomorTelepon'],
                'message' => $pesan,
                'sandbox' => 'false'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($httpcode != 200) {
            $dataLog = [
                'username'      => $cekUsername[0]['username'],
                'waktu'         => date('Y-m-d H:i:s'),
                'keterangan'    => "Pengiriman link untuk lupa password gagal, karena server WA sedang ada permasalahan / Maintenance"
            ];
            $modelLog->insert($dataLog);
            $response = [
                'status'    => 400,
                'messages'  => "Gagal dalam pengiriman link Lupa Password, Karena Server WA sedang ada permasalahan / Maintenance"
            ];
            return $this->respond($response, 200);
        } else {
            $dataLog = [
                'username'      => $cekUsername[0]['username'],
                'waktu'         => date('Y-m-d H:i:s'),
                'keterangan'    => "Pengiriman Link Lupa Password Berhasil"
            ];
            $modelLog->insert($dataLog);
            $response = [
                'status'    => 200,
                'messages'  => "Pengiriman Link Lupa Password Berhasil"
            ];
            return $this->respond($response, 200);
        }
    }
    public function hapus($idAkun = null, $usernameAkses = null)
    {
        $modelAkun      = new Model_akun;
        $modelData      = new Model_data;
        $modelLog       = new Model_log;
        $modelAkun->delete($idAkun);
        $dataLog = [
            'username'   => $usernameAkses,
            'waktu'      => date('Y-m-d H:i:s'),
            'keterangan' => "Melakukan Penghapusan Akun"
        ];
        $modelLog->insert($dataLog);
        $response = [
            'status'    => 200,
            'messages'  => "Berhasil Menghapus Akun",
        ];
        return $this->respond($response, 200);
    }
}