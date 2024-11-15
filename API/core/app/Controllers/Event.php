<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Model_akun;
use App\Models\Model_event;
use App\Models\Model_log;
use App\Models\Model_data;
use App\Models\Model_operator;
use \Firebase\JWT\JWT;

class Event extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        $modelData        = new Model_data;
        $dataHakAkses     = $modelData->tampilSeluruhEvent();
        $response = [
            'status'    => 200,
            'messages'  => "Berhasil Menampilkan Seluruh Event",
            'data'      => $dataHakAkses
        ];
        return $this->respond($response, 200);
    }
    public function jumlahEventDanPeserta()
    {
        $modelData          = new Model_data;
        $jumlahDataEvent    = $modelData->jumlahEvent();
        $jumlahDataPeserta  = $modelData->jumlahPeserta();
        $response = [
            'status'        => 200,
            'messages'      => "Berhasil Menampilkan Jumlah Event",
            'jumlahEvent'   => $jumlahDataEvent,
            'jumlahPeserta' => $jumlahDataPeserta
        ];
        return $this->respond($response, 200);
    }
    public function tampilOperator($username)
    {
        $modelData        = new Model_data;
        $dataHakAkses     = $modelData->cekOperator($username);
        $response = [
            'status'    => 200,
            'messages'  => "Berhasil Menampilkan Data Operator",
            'data'      => $dataHakAkses
        ];
        return $this->respond($response, 200);
    }
    public function loginOperator()
    {
        $modelLog       = new Model_log;
        $modelData      = new Model_data;
        $username       = $this->request->getVar('username');
        $password       = $this->request->getVar('password');
        $cekOperator    = $modelData->cekOperator($username);

        if ($cekOperator == null) {
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
        $cekPassword    = password_verify($password, $cekOperator[0]['password']);
        if ($cekPassword == true) {
            $dataLog = [
                'username'      => $cekOperator[0]['namaPenanggungJawab'],
                'waktu'         => date('Y-m-d H:i:s'),
                'keterangan'    => $cekOperator[0]['namaPenanggungJawab'] . "Berhasil Login ke dalam Aplikasi"
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
                    'namaPenanggungJawab'   => $cekOperator[0]['namaPenanggungJawab'],
                    'event'                 => $cekOperator[0]['event'],
                    'namaEvent'             => $cekOperator[0]['namaEvent'],
                    'idPenanggungJawab'     => $cekOperator[0]['idPenanggungJawab'],
                    'token'                 => $token
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
    public function create()
    {
        $modelEvent     = new Model_event;
        $modelOperator  = new Model_operator();
        $modelAkun      = new Model_akun();
        $modelLog       = new Model_log;
        $modelData      = new Model_data;

        // Data Event
        $namaEvent                  = $this->request->getVar('namaEvent');
        $lokasiEvent                = $this->request->getVar('lokasiEvent');
        $tanggalEvent               = $this->request->getVar('tanggalEvent');
        $tanggalPendaftaranEvent    = $this->request->getVar('tanggalPendafatranEvent');
        $subdomainEvent             = $this->request->getVar('subdomainEvent');

        // Data Penanggung Jawab Event
        $namaOperator            = $this->request->getVar('namaOperator');
        $nomorTeleponOperator    = $this->request->getVar('nomorTeleponOperator');
        $alamatOperator          = $this->request->getVar('alamatOperator');

        // Proses Pendaftaran Event
        $cekEvent       = $modelData->cekEvent($namaEvent, $tanggalEvent);
        if ($cekEvent != null) {
            $dataLog = [
                'username'      => "Tidak Diketahui",
                'waktu'         => date('Y-m-d H:i:s'),
                'keterangan'    => $namaEvent . "sudah terdaftar dalam database"
            ];
            $modelLog->insert($dataLog);
            $response = [
                'status'    => 400,
                'messages'  => "Mohon Maaf, " . $namaEvent . " sudah terdaftar di database",
            ];
            return $this->respond($response, 400);
        }
        $data = [
            'subdomain'                 => strtolower($subdomainEvent),
            'namaEvent'                 => $namaEvent,
            'lokasiEvent'               => $lokasiEvent,
            'linkMap'                   => "",
            'tanggalEvent'              => $tanggalEvent,
            'tanggalPendaftaranEvent'   => $tanggalPendaftaranEvent,
            'linkMateri'                => "",
            'linkMedia'                 => "",
            'templateSertifikat'        => "",
            'nomorRekeningEvent'        => "",
            'namaRekeningEvent'         => "",
            'nomorRekeningPembayaran'   => "",
            'namaRekeningPembayaran'    => "",
            'buktiBayarEvent'           => "",
            'statusPembayaranEvent'     => "",
            'statusEvent'               => ""

        ];
        $modelEvent->insert($data);

        // Proses Pendaftaran Penangung Jawab Event
        $cekEventTerbaru       = $modelData->cekEvent($namaEvent, $tanggalEvent);
        $kodeValidator = rand(0, 9999999999);
        $hashPassword   = [
            'cost' => 10,
        ];
        $password = "operator" . rand(0, 9999);

        // Proses AKun
        $dataAkun = [
            'username'  => $kodeValidator,
            'password'  => password_hash($password, PASSWORD_DEFAULT, $hashPassword),
            'hakAkses'  => "3"
        ];
        $modelAkun->insert($dataAkun);
        // Proses Input Operator
        $dataOperator = $modelData->cekUsername($kodeValidator);
        $dataAkun = [
            'akun'                   => $dataOperator[0]['idAkun'],
            'event'                  => $cekEventTerbaru[0]['idEvent'],
            'namaOperator'           => $namaOperator,
            'nomorTeleponOperator'   => $nomorTeleponOperator,
            'alamatOperator'         => $alamatOperator
        ];
        $modelOperator->insert($dataAkun);

        // Proses Kirim Username dan Password Operator
        $dataEvent = $modelData->cekEventById($cekEventTerbaru[0]['idEvent']);
        $subdomain = $dataEvent[0]['subdomain'];

        // Proses Kirim Username dan Password Operator
        $pesan = "Selamat Event anda sudah terdaftar, silahkan Login Menggunakan Akun Di Bawah ini untuk melanjutkan kelengkapan data \n\nUsername : " . $kodeValidator . "\nPassword : " . $password . "\n\nSilahkan Klik Link Ini untuk upload bukti pembayaran akun \nhttps://register.co.id/UploadBuktiBayar/" . $cekEventTerbaru[0]['idEvent'];
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
                'to' => $nomorTeleponOperator,
                'message' => $pesan,
                'sandbox' => 'false'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        $dataLog = [
            'username'      => "Tidak Diketahui",
            'waktu'         => date('Y-m-d H:i:s'),
            'keterangan'    => "Berhasil penambahan event dengan nama event " . $namaEvent
        ];
        $modelLog->insert($dataLog);
        $response = [
            'status'    => 200,
            'messages'  => "Berhasil melakukan pendaftaran event"
        ];
        return $this->respond($response, 200);
    }
    public function updateData($idEvent = null)
    {
        $modelEvent         = new Model_event;
        $modelLog           = new Model_log;
        $usernameAkses      = $this->request->getVar('usernameAkses');
        $namaEvent          = $this->request->getVar('namaEvent');
        $lokasiEvent        = $this->request->getVar('lokasiEvent');
        $linkMap            = $this->request->getVar('linkMap');
        $tanggalEvent       = $this->request->getVar('tanggalEvent');
        $linkMateri         = $this->request->getVar('linkMateri');
        $linkFotoVideo      = $this->request->getVar('linkFotoVideo');
        $templateSertifikat = $this->request->getVar('templateSertifikat');
        $nomorRekeningEvent = $this->request->getVar('nomorRekeningEvent');
        $namaRekeningEvent  = $this->request->getVar('namaRekeningEvent');
        $subdomain          = $this->request->getVar('subdomain');
        $data = [
            'namaEvent'                 => $namaEvent,
            'lokasiEvent'               => $lokasiEvent,
            'linkMap'                   => $linkMap,
            'tanggalEvent'              => $tanggalEvent,
            'linkMateri'                => $linkMateri,
            'linkFotoVideo'             => $linkFotoVideo,
            'templateSertifikat'        => $templateSertifikat,
            'nomorRekeningEvent'        => $nomorRekeningEvent,
            'namaRekeningEvent'         => $namaRekeningEvent,
            'subdomain'                 => $subdomain
        ];
        $modelEvent->update($idEvent, $data);
        $dataLog = [
            'username'      => $usernameAkses,
            'waktu'         => date('Y-m-d H:i:s'),
            'keterangan'    => "Melakukan Update Data Event " . $namaEvent
        ];
        $modelLog->insert($dataLog);
        $response = [
            'status'    => 200,
            'messages'  => "Berhasil Update Data Event",
        ];
        return $this->respond($response, 200);
    }
    public function uploadBuktiBayar($idEvent = null)
    {
        $modelEvent                 = new Model_event;
        $modelLog                   = new Model_log;
        $modelData                  = new Model_data;
        $nomorRekeningPembayaran    = $this->request->getVar('nomorRekeningPembayaran');
        $namaRekeningPembayaran     = $this->request->getVar('namaRekeningPembayaran');
        $buktiBayar                 = $this->request->getFile('buktiBayar');
        $namaBuktiBayar             = $buktiBayar->getRandomName();
        $buktiBayar->move('uploads/buktiBayar/', $namaBuktiBayar);

        $data = [
            'nomorRekeningPembayaran'  => $nomorRekeningPembayaran,
            'namaRekeningPembayaran'   => $namaRekeningPembayaran,
            'buktiBayarEvent'               => $namaBuktiBayar
        ];
        $modelEvent->update($idEvent, $data);

        $cekEvent   = $modelData->cekEventById($idEvent);
        $dataLog = [
            'username'      => "",
            'waktu'         => date('Y-m-d H:i:s'),
            'keterangan'    => "Melakukan Update Data Event " . $cekEvent[0]['namaEvent']
        ];
        $modelLog->insert($dataLog);
        $response = [
            'status'    => 200,
            'messages'  => "Berhasil Upload Bayar",
        ];
        return $this->respond($response, 200);
    }
    public function konfirmasiPembayaran($idEvent = null, $statusEvent = null, $usernameAkses = null)
    {
        $modelEvent  = new Model_event;
        $modelData   = new Model_data;
        $modelLog    = new Model_log;

        $data = [
            'statusPembayaran' => $statusEvent
        ];

        $modelEvent->update($idEvent, $data);
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

    public function hapus($idEvent = null, $usernameAkses = null)
    {
        $modelEvent                 = new Model_event;
        $modelData                  = new Model_data;
        $modelOperator              = new Model_operator();
        $modelData                  = new Model_data;
        $modelLog                   = new Model_log;
        $cekPenanggungJawab = $modelData->cekPenanggungJawab($idEvent);
        $modelOperator->delete($cekPenanggungJawab[0]['idPenanggungJawab']);
        $modelEvent->delete($idEvent);
        $dataLog = [
            'username'   => $usernameAkses,
            'waktu'      => date('Y-m-d H:i:s'),
            'keterangan' => "Melakukan Penghapusan Event "
        ];
        $modelLog->insert($dataLog);
        $response = [
            'status'    => 200,
            'messages'  => "Berhasil Menghapus Event",
        ];
        return $this->respond($response, 200);
    }
}
