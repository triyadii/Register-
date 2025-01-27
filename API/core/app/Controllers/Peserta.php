<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Model_log;
use App\Models\Model_data;
use App\Models\Model_peserta;
use App\Models\Model_akun;
use App\Models\Model_penjaga_stand;
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
    public function tampilPesertaByKodePeserta($kodePeserta = null)
    {
        $modelData        = new Model_data;
        $dataHakAkses     = $modelData->cekPesertaByKodePeserta($kodePeserta);
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
        $namaPanggilan          = $this->request->getVar('namaPanggilan');
        $namaLengkap            = $this->request->getVar('namaLengkap');
        $nomorTeleponPeserta    = $this->request->getVar('nomorPeserta');
        $emailPeserta           = $this->request->getVar('emailPeserta');
        $namaKlinik             = $this->request->getVar('namaKlinik');
        $alamatKlinik           = $this->request->getVar('alamatKlinik');
        $namaRekening           = $this->request->getVar('namaRekening');
        $nomorRekening          = $this->request->getVar('nomorRekening');
        $foto                   = $this->request->getFile('foto');
        $buktiBayar             = $this->request->getFile('buktiBayar');
        $namaFoto               = $foto->getRandomName();
        $namaBuktiBayar         = $buktiBayar->getRandomName();
        $password               = "indaac2025";
        $hashPassword   = [
            'cost' => 10,
        ];
        $kodePeserta           = rand(0, 999);
        // Pengecekan NIK Peserta 
        $cekNIK = $modelData->cekPeserta($nikPeserta, $event);
        if ($cekNIK != null) {
            $dataLog = [
                'username'      => "Peserta",
                'waktu'         => date('Y-m-d H:i:s'),
                'keterangan'    => "Pendaftaran Gagal dikarenakan NIK sudah ada di dalam Database"
            ];
            $modelLog->insert($dataLog);
            $response = [
                'status'    => 200,
                'messages'  => "Mohon Maaf, NIK Anda sudah terdaftar di dalam database, Silahkan Chat Admin untuk memastikan Data Anda. <a href='https://wa.me/6285337233284' target='_blank'>Chat Admin</a>",
            ];
            return $this->respond($response, 400);
        }
        // Pembuatan Akun Peserta
        $username = $namaPanggilan . $kodePeserta;
        $dataAkun = [
            'username'  => $username,
            'password'  => password_hash($password, PASSWORD_DEFAULT, $hashPassword),
            'hakAkses'  => "4"
        ];
        $modelAkun->insert($dataAkun);
        $dataPeserta = $modelData->cekUsername($username);

        // Penyimpanan Data Peserta
        // Pengecekan Apabila Gambar Bukti Bayar Kosong
        if ($buktiBayar->getName() == "kosong.jpg") {
            $data = [
                'akun'                      => $dataPeserta[0]['idAkun'],
                'event'                     => $event,
                'kodePeserta'               => $kodePeserta,
                'nikPeserta'                => $nikPeserta,
                'namaPeserta'               => $namaLengkap,
                'nomorTeleponPeserta'       => $nomorTeleponPeserta,
                'nomorRekeningPeserta'      => "",
                'namaRekeningPeserta'       => "",
                'emailPeserta'              => $emailPeserta,
                'namaKlinik'                => $namaKlinik,
                'alamatKlinik'              => $alamatKlinik,
                'buktiBayar'                => "",
                'statusPembayaranPeserta'   => "0",
                'kehadiran'                 => "0",
                'foto'                      => $namaFoto
            ];
            $modelPeserta->insert($data);
            $foto->move('uploads/foto/', $namaFoto);
        } else {
            $data = [
                'akun'                      => $dataPeserta[0]['idAkun'],
                'event'                     => $event,
                'kodePeserta'               => $kodePeserta,
                'nikPeserta'                => $nikPeserta,
                'namaPeserta'               => $namaLengkap,
                'nomorTeleponPeserta'       => $nomorTeleponPeserta,
                'nomorRekeningPeserta'      => $nomorRekening,
                'namaRekeningPeserta'       => $namaRekening,
                'emailPeserta'              => $emailPeserta,
                'namaKlinik'                => $namaKlinik,
                'alamatKlinik'              => $alamatKlinik,
                'buktiBayar'                => $namaBuktiBayar,
                'statusPembayaranPeserta'   => "1",
                'kehadiran'                 => "0",
                'foto'                      => $namaFoto
            ];
            $modelPeserta->insert($data);
            $foto->move('uploads/foto/', $namaFoto);
            $buktiBayar->move('uploads/buktiBayar/', $namaBuktiBayar);
        }

        // Proses Kirim Username dan Password Peserta
        $dataEvent = $modelData->cekEventById($event);
        $subdomain = $dataEvent[0]['subdomain'];

        $pesan = "Selamat anda sudah terdaftar, silahkan Login Menggunakan Akun Di Bawah ini untuk melanjutkan kelengkapan data \n\nUsername : " . $username . "\nPassword :" . $password . "\n\nSilahkan Klik Link Ini untuk login akun \nhttps://" . $subdomain . ".register.co.id/Login";
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
                'appkey' => '95184151-cbcc-46a9-b623-a7fd1d0e7314',
                'authkey' => '4P4gGLO1Pd8qvLUMBUKDVsQxdtoK5IyDxJIHtMRlJyTuQGwZpM',
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
            'messages'  => "Berhasil melakukan pendaftaran, apabila tidak ada masuk WA, Silahkan Chat Admin untuk memastikan Data Anda. <a href='https://wa.me/6285337233284' target='_blank'>Chat Admin</a>",
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
    public function editAkunDanPeserta($idPeserta = null)
    {
        $modelPeserta           = new Model_peserta;
        $modelAkun              = new Model_akun;
        $modelData              = new Model_data;
        $modelLog               = new Model_log;
        $usernameAkses          = $this->request->getVar('usernameAkses');
        $usernamePeserta        = $this->request->getVar('usernamePeserta');
        $nikPeserta             = $this->request->getVar('nikPeserta');
        $namaPeserta            = $this->request->getVar('namaPeserta');
        $nomorTeleponPeserta    = $this->request->getVar('nomorTeleponPeserta');
        // Data Akun Peserta
        $cekAkun = $modelData->cekPesertaByIdPeserta($idPeserta);
        $idAkunPeserta = $cekAkun[0]['akun'];
        $dataPeserta = [
            'nikPeserta'            => $nikPeserta,
            'namaPeserta'           => $namaPeserta,
            'nomorTeleponPeserta'   => $nomorTeleponPeserta
        ];
        $modelPeserta->update($idPeserta, $dataPeserta);
        $dataAkun = [
            'username'              => $usernamePeserta
        ];
        $modelAkun->update($idAkunPeserta, $dataAkun);
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
    public function editProfil($idPeserta = null)
    {
        $modelPeserta           = new Model_peserta;
        $modelData              = new Model_data;
        $modelLog               = new Model_log;
        $usernameAkses          = $this->request->getVar('usernameAkses');
        $namaLengkap            = $this->request->getVar('namaPeserta');
        $email                  = $this->request->getVar('emailPesera');
        $namaKlinik             = $this->request->getVar('namaKlinik');
        $alamatKlinik           = $this->request->getVar('alamatKlinik');
        $dataPeserta = [
            'namaPeserta'   => $namaLengkap,
            'emailpeserta'  => $email,
            'namaKlinik'    => $namaKlinik,
            'alamatKlinik'  => $alamatKlinik
        ];
        $modelPeserta->update($idPeserta, $dataPeserta);
        $dataLog = [
            'username'      => $usernameAkses,
            'waktu'         => date('Y-m-d H:i:s'),
            'keterangan'    => "Melakukan perubahan data peserta atas nama " . $namaLengkap
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
        $dataPeserta    = $modelData->cekPesertaByKodePeserta($kodePeserta);
        if ($dataPeserta == null) {
            $dataLog = [
                'username'   => $usernameAkses,
                'waktu'      => date('Y-m-d H:i:s'),
                'keterangan' => "Data Tidak Ditemukan"
            ];
            $modelLog->insert($dataLog);
            $response = [
                'status'    => 202,
                'messages'  => "Mohon Maaf, Data tidak ditemukan, Silahkan Hubungi Panitia ",
            ];
            return $this->respond($response, 202);
        }
        if ($dataPeserta[0]['kehadiran'] == 1) {
            $dataLog = [
                'username'   => $usernameAkses,
                'waktu'      => date('Y-m-d H:i:s'),
                'keterangan' => "Sudah Melakukan Registrasi Ulang"
            ];
            $modelLog->insert($dataLog);
            $response = [
                'status'    => 202,
                'messages'  => "Sudah Melakukan Registrasi Ulang",
            ];
            return $this->respond($response, 202);
        } else {
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
                'messages'  => "Berhasil Konfirmasi Kehadiran Peserta Atas nama <br><h3>" . $dataPeserta[0]['namaPeserta'] . "<br>Id Peserta : " . $dataPeserta[0]['idPeserta'] . "</h3>",
            ];
            return $this->respond($response, 200);
        }
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
    public function downloadBuktiBayar($idPeserta = null)
    {
        $modelData    = new Model_data;
        $dataPeserta  = $modelData->cekPesertaByIdPeserta($idPeserta);
        return $this->response->download('uploads/buktiBayar/' . $dataPeserta[0]['buktiBayar'], null);
    }
    public function updateJenisPeserta()
    {
        $modelPeserta   = new Model_peserta;
        $modelLog       = new Model_log;
        $usernameAkses  = $this->request->getVar('usernameAkses');
        $idPeserta      = $this->request->getVar('idPeserta');
        $peserta        = $this->request->getVar('peserta');
        $panitia        = $this->request->getVar('panitia');
        $moderator      = $this->request->getVar('moderator');
        $stand          = $this->request->getVar('stand');
        $data = [
            'peserta'   => $peserta,
            'panitia'   => $panitia,
            'moderator' => $moderator,
            'stand'     => $stand
        ];

        $modelPeserta->update($idPeserta, $data);
        $dataLog = [
            'username'   => $usernameAkses,
            'waktu'      => date('Y-m-d H:i:s'),
            'keterangan' => "Melakukan Pembaharuan Jenis Peserta"
        ];
        $modelLog->insert($dataLog);
        $response = [
            'status'    => 200,
            'messages'  => "Berhasil Pembaharuan Jenis Peserta",
        ];
        return $this->respond($response, 200);
    }
    public function updateFotoProfil($idPeserta = null)
    {
        $modelPeserta   = new Model_peserta;
        $modelLog       = new Model_log;
        $modelData      = new Model_data;
        $usernameAkses  = $this->request->getPost('usernameAkses');
        $foto           = $this->request->getFile('foto');
        $namaFoto       = $foto->getRandomName();
        $dataPeserta    = $modelData->cekPesertaByIdPeserta($idPeserta);
        unlink('uploads/foto/' . $dataPeserta[0]['foto']);
        $foto->move('uploads/foto/', $namaFoto);
        $data = [
            'foto'  => $namaFoto,
        ];
        $modelPeserta->update($idPeserta, $data);
        $dataLog = [
            'username'      => $usernameAkses,
            'waktu'         => date('Y-m-d H:i:s'),
            'keterangan'    => "Melakukan Update Foto Profile " . $dataPeserta[0]['namaPeserta']
        ];
        $modelLog->insert($dataLog);
        $response = [
            'status'    => 200,
            'messages'  => "Berhasil Update Foto Profil",
        ];
        return $this->respond($response, 200);
    }
    public function konfirmasiMasukRuangan($id = null)
    {
        $modelPeserta        = new Model_peserta;
        $modelData           = new Model_data;
        $modelLog            = new Model_log;
        $kodePeserta         = substr($id, 0, 1);
        if ($kodePeserta == "P") {
            $kode           = substr($id, 1);
            $dataPeserta    = $modelData->cekPesertaByIdPeserta($kode);
            if ($dataPeserta == null) {
                $dataLog = [
                    'username'   => "Validator",
                    'waktu'      => date('Y-m- d H:i:s'),
                    'keterangan' => "Data Tidak Ditemukan"
                ];
                $modelLog->insert($dataLog);
                $response = [
                    'status'    => 202,
                    'messages'  => "Mohon Maaf, Data tidak ditemukan, Silahkan Hubungi Panitia ",
                ];
                return $this->respond($response, 202);
            }
            $dataLog = [
                'username'   => "Validator",
                'waktu'      => date('Y-m-d H:i:s'),
                'keterangan' => "Melakukan Konfirmasi Kehadiran Peserta"
            ];
            $modelLog->insert($dataLog);
            $response = [
                'status'    => 200,
                'messages'  => "Berhasil Konfirmasi Masuk Ruangan Peserta Atas nama <br><h3>" . $dataPeserta[0]['namaPeserta'] . "<br>Id Peserta : " . $dataPeserta[0]['idPeserta'] . "</h3>",
            ];
            return $this->respond($response, 200);
        } else if ($kodePeserta == "B") {
            $kode = substr($id, 1);
            $dataBooth  = $modelData->cekPenjagaStand($kode);
            if ($dataBooth == null) {
                $dataLog = [
                    'username'   => "Validator",
                    'waktu'      => date('Y-m- d H:i:s'),
                    'keterangan' => "Data Tidak Ditemukan"
                ];
                $modelLog->insert($dataLog);
                $response = [
                    'status'    => 202,
                    'messages'  => "Mohon Maaf, Data tidak ditemukan, Silahkan Hubungi Panitia ",
                ];
                return $this->respond($response, 202);
            } else {
                $dataLog = [
                    'username'   => "Validator",
                    'waktu'      => date('Y-m-d H:i:s'),
                    'keterangan' => "Melakukan Konfirmasi Masuk Ruangan"
                ];
                $modelLog->insert($dataLog);
                $response = [
                    'status'    => 200,
                    'messages'  => "Berhasil Konfirmasi Masuk Ruangan Dengan Booth <br><h3> Nama Perusahaan : " . $dataBooth[0]['perusahaan'] . "<br>User : " . $dataBooth[0]['user'] . "</h3>",
                ];
                return $this->respond($response, 200);
            }
        } else {
            $response = [
                'status'    => 202,
                'messages'  => "Mohon Maaf, Data tidak ditemukan, Silahkan Hubungi Panitia ",
            ];
            return $this->respond($response, 202);
        }
    }
}