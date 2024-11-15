<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Model_log;
use App\Models\Model_data;
use App\Models\Model_peserta;
use App\Models\Model_akun;
use \Firebase\JWT\JWT;

// QRCODE
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

class Peserta extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        $modelData        = new Model_data;
        $dataHakAkses     = $modelData->tampilSeluruhPeserta();
        $response = [
            'status'    => 200,
            'messages'  => "Berhasil Menampilkan Seluruh Peserta",
            'data'      => $dataHakAkses
        ];
        return $this->respond($response, 200);
    }
    public function tampilPesertaByIdEvent($idEvent = null)
    {
        $modelData        = new Model_data;
        $dataHakAkses     = $modelData->tampilPesertaByIdEvent($idEvent);
        $response = [
            'status'    => 200,
            'messages'  => "Berhasil Menampilkan Peserta Berdasarkan Event",
            'data'      => $dataHakAkses
        ];
        return $this->respond($response, 200);
    }
    public function tampilPesertaByIdPeserta($idPeserta = null)
    {
        $modelData        = new Model_data;
        $dataHakAkses     = $modelData->cekPesertaByIdPeserta($idPeserta);
        $response = [
            'status'    => 200,
            'messages'  => "Berhasil Menampilkan Peserta Berdasarkan Event",
            'data'      => $dataHakAkses
        ];
        return $this->respond($response, 200);
    }
    public function create()
    {
        $modelPeserta           = new Model_peserta;
        $modelAkun              = new Model_akun;
        $modelLog               = new Model_log;
        $modelData              = new Model_data;
        $event                  = $this->request->getVar('event');
        $nikPeserta             = $this->request->getVar('nikPeserta');
        $namaPeserta            = $this->request->getVar('namaPeserta');
        $alamatPeserta          = $this->request->getVar('alamatPeserta');
        $nomorTeleponPeserta    = $this->request->getVar('nomorPeserta');
        $foto                   = $this->request->getFile('foto');
        $namaFoto               = $foto->getRandomName();
        $password = "peserta" . rand(0, 9999);
        $hashPassword   = [
            'cost' => 10,
        ];
        $kodePeserta           = rand(0, 9999999999);

        // Pembuatan Akun Peserta
        $dataAkun = [
            'username'  => $kodePeserta,
            'password'  => password_hash($password, PASSWORD_DEFAULT, $hashPassword),
            'hakAkses'  => "4"
        ];
        $modelAkun->insert($dataAkun);
        $dataPeserta = $modelData->cekUsername($kodePeserta);
        // Penyimpanan Data Peserta
        $data = [
            'akun'                      => $dataPeserta[0]['idAkun'],
            'event'                     => $event,
            'kodePeserta'               => $kodePeserta,
            'nikPeserta'                => $nikPeserta,
            'namaPeserta'               => $namaPeserta,
            'alamatPeserta'             => $alamatPeserta,
            'nomorTeleponPeserta'       => $nomorTeleponPeserta,
            'nomorRekeningPeserta'      => "",
            'namaRekeningPeserta'       => "",
            'buktiBayar'                => "",
            'statusPembayaran'          => "0",
            'kehadiran'                 => "0",
            'foto'                      => $namaFoto
        ];
        $modelPeserta->insert($data);
        $foto->move('uploads/foto/', $namaFoto);

        // Proses Kirim Username dan Password Peserta
        $dataEvent = $modelData->cekEventById($event);
        $subdomain = $dataEvent[0]['subdomain'];

        $pesan = "Selamat anda sudah terdaftar, silahkan Login Menggunakan Akun Di Bawah ini untuk melanjutkan kelengkapan data \n\nUsername : " . $kodePeserta . "\nPassword : " . $password . "\n\nSilahkan Klik Link Ini untuk login akun \nhttps://" . $subdomain . ".register.co.id/Login";
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
                'to' => $nomorTeleponPeserta,
                'message' => $pesan,
                'sandbox' => 'false'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $dataLog = [
            'username'      => "Peserta",
            'waktu'         => date('Y-m-d H:i:s'),
            'keterangan'    => "Berhasil melakukan pendaftaran "
        ];
        $modelLog->insert($dataLog);
        $response = [
            'status'    => 200,
            'messages'  => "Berhasil melakukan pendaftaran",
            'data'      => $data
        ];
        return $this->respond($response, 200);
    }
    public function login()
    {
        $modelLog       = new Model_log;
        $modelData      = new Model_data;
        $username       = $this->request->getVar('username');
        $password       = $this->request->getVar('password');
        $cekUsername    = $modelData->cekUsernamePeserta($username);
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
            $response = [
                'status'    => 200,
                'messages'  => "Login Berhasil",
                'data'      => [
                    'username'      => $cekUsername[0]['username'],
                    'namaPeserta'   => $cekUsername[0]['namaPeserta'],
                    'event'         => $cekUsername[0]['event'],
                    'namaEvent'     => $cekUsername[0]['namaEvent'],
                    'idPeserta'     => $cekUsername[0]['idPeserta'],
                    'token'         => $token,
                ]
            ];

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
    public function edit($idPeserta = null)
    {
        $modelPeserta           = new Model_peserta;
        $modelLog               = new Model_log;
        $usernameAkses          = $this->request->getVar('usernameAkses');
        $nikPeserta             = $this->request->getVar('nikPeserta');
        $namaPeserta            = $this->request->getVar('namaPeserta');
        $alamatPeserta          = $this->request->getVar('alamatPeserta');
        $nomorTeleponPeserta    = $this->request->getVar('nomorTeleponPeserta');
        $data = [
            'nikPeserta'            => $nikPeserta,
            'namaPeserta'           => $namaPeserta,
            'alamatPeserta'         => $alamatPeserta,
            'nomorTeleponPeserta'   => $nomorTeleponPeserta
        ];
        $modelPeserta->update($idPeserta, $data);
        $dataLog = [
            'username'      => $usernameAkses,
            'waktu'         => date('Y-m-d H:i:s'),
            'keterangan'    => "Melakukan perubahan data peserta atas nama " . $namaPeserta
        ];
        $modelLog->insert($dataLog);
        $response = [
            'status'    => 200,
            'messages'  => "Berhasil melakukan perubahan data Peserta",
        ];
        return $this->respond($response, 200);
    }
    public function uploadBuktiBayar($idPeserta = null)
    {
        $modelPeserta               = new Model_peserta;
        $modelLog                   = new Model_log;
        $modelData                  = new Model_data;
        $nomorRekeningPembayaran    = $this->request->getVar('nomorRekeningPembayaran');
        $namaRekeningPembayaran     = $this->request->getVar('namaRekeningPembayaran');
        $buktiBayar                 = $this->request->getFile('buktiBayar');
        $namaBuktiBayar             = $buktiBayar->getRandomName();
        $dataPeserta                = $modelData->cekPesertaByIdPeserta($idPeserta);
        $buktiBayar->move('uploads/buktiBayar/', $namaBuktiBayar);
        $data = [
            'nomorRekeningPembayaranPeserta'  => $nomorRekeningPembayaran,
            'namaRekeningPembayaranPeserta'   => $namaRekeningPembayaran,
            'buktiBayar'                      => $namaBuktiBayar,
            'statusPembayaranPeserta'         => "1"
        ];
        $modelPeserta->update($idPeserta, $data);
        $dataLog = [
            'username'      => "",
            'waktu'         => date('Y-m-d H:i:s'),
            'keterangan'    => "Melakukan Konfirmasi data atas nama " . $dataPeserta[0]['namaPeserta']
        ];
        $modelLog->insert($dataLog);
        $response = [
            'status'    => 200,
            'messages'  => "Berhasil Upload Bayar",
        ];
        return $this->respond($response, 200);
    }
    public function konfirmasiPembayaran($idPeserta = null, $statusPeserta = null, $usernameAkses = null)
    {
        $modelPeserta   = new Model_peserta;
        $modelData      = new Model_data;
        $modelLog       = new Model_log;
        $data = [
            'statusPembayaranPeserta' => $statusPeserta
        ];

        $modelPeserta->update($idPeserta, $data);
        $dataLog = [
            'username'   => $usernameAkses,
            'waktu'      => date('Y-m-d H:i:s'),
            'keterangan' => "Melakukan Konfirmasi Pembayaran"
        ];
        $modelLog->insert($dataLog);
        $response = [
            'status'    => 200,
            'messages'  => "Berhasil Konfirmasi Pembayaran",
        ];
        return $this->respond($response, 200);
    }
    public function konfirmasiKehadiran($kodePeserta = null, $usernameAkses = null)
    {
        $modelPeserta   = new Model_peserta;
        $modelData      = new Model_data;
        $modelLog       = new Model_log;
        $dataPeserta    = $modelData->cekUsernamePeserta($kodePeserta);
        $data = [
            'kehadiran' => 1
        ];
        $modelPeserta->update($dataPeserta[0]['idPeserta'], $data);
        $dataLog = [
            'username'   => $usernameAkses,
            'waktu'      => date('Y-m-d H:i:s'),
            'keterangan' => "Melakukan Konfirmasi Kehadiran Peserta"
        ];
        $modelLog->insert($dataLog);
        $response = [
            'status'    => 200,
            'messages'  => "Berhasil Konfirmasi Kehadiran Peserta",
        ];
        return $this->respond($response, 200);
    }
    public function hapus($idPeserta = null, $usernameAkses = null)
    {
        $modelPeserta   = new Model_peserta;
        $modelData      = new Model_data;
        $modelLog       = new Model_log;
        $modelPeserta->delete($idPeserta);
        $dataLog = [
            'username'   => $usernameAkses,
            'waktu'      => date('Y-m-d H:i:s'),
            'keterangan' => "Melakukan Penghapusan Peserta"
        ];
        $modelLog->insert($dataLog);
        $response = [
            'status'    => 200,
            'messages'  => "Berhasil Menghapus Peserta",
        ];
        return $this->respond($response, 200);
    }
}
