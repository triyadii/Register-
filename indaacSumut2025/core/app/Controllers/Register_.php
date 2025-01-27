<?php

namespace App\Controllers;

class Register_ extends BaseController
{
    public function registrasi()
    {
        $session        = session();
        $event          = $session->get('event');
        $nik            = $this->request->getPost('nik');
        $namaPanggilan  = strtolower($this->request->getPost('namaPanggilan'));
        $namaLengkap    = $this->request->getPost('namaLengkap');
        $emailPeserta   = $this->request->getPost('emailPeserta');
        $namaKlinik     = $this->request->getPost('namaKlinik');
        $alamatKlinik   = $this->request->getPost('alamatKlinik');
        $nomorTelepon   = "62" . substr(trim($this->request->getPost('nomorTelepon')), 1);
        $foto           = $this->request->getFile('foto');
        $buktiBayar     = $this->request->getFile('buktiBayar');
        $namaRekening   = $this->request->getPost('namaRekening');
        $nomorRekening  = $this->request->getPost('nomorRekening');

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

        // Pengecekan Untuk Bukti Bayar
        if ($buktiBayar->getError() != 4) {
            $validasiBuktiBayar = $this->validate([
                'buktiBayar' => [
                    'uploaded[buktiBayar]',
                    'mime_in[buktiBayar,application/pdf,image/jpeg,image/png]',
                    'max_size[buktiBayar,7168]',
                ],
            ]);
            if ($validasiBuktiBayar == false) {
                $ses_data = [
                    'status'  => "Gagal",
                    'waktu'    => "File terlalu besar atau tipe file tidak sesuai, file max 1,5 mb dan tipe data jpg/jpeg, silahkan coba lagi"
                ];
                $session->set($ses_data);
                return redirect()->back();
            }
            $buktiBayarUpload = curl_file_create($buktiBayar->getRealPath(), 'application/pdf,image/jpeg', $buktiBayar->getName());
        } else {
            $buktiBayarUpload = curl_file_create(base_url() . 'kosong.jpg', 'application/pdf,image/jpeg', 'kosong.jpg');
        }

        $post = [
            'event'         => $event,
            'nikPeserta'    => $nik,
            'namaPanggilan' => str_replace(' ', '', $namaPanggilan),
            'namaLengkap'   => $namaLengkap,
            'nomorPeserta'  => $nomorTelepon,
            'emailPeserta'  => $emailPeserta,
            'namaKlinik'    => $namaKlinik,
            'alamatKlinik'  => $alamatKlinik,
            'foto'          => $fotoUpload,
            'buktiBayar'    => $buktiBayarUpload,
            'namaRekening'  => $namaRekening,
            'nomorRekening' => $nomorRekening
        ];

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.register.co.id/api/PendaftaranPeserta',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(),
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
            return redirect()->to(base_url() . 'Login');
        }
    }

    public function uploadBuktiBayar()
    {
        $session                    = session();
        $idPeserta                  = $session->get('idPeserta');
        $token                      = $session->get('token');
        $namaRekeningPembayaran     = $this->request->getPost('namaRekeningPembayaran');
        $nomorRekeningPembayaran    = $this->request->getPost('nomorRekeningPembayaran');
        $buktiBayar                 = $this->request->getFile('buktiBayar');

        $validasiBuktiBayar = $this->validate([
            'buktiBayar' => [
                'uploaded[buktiBayar]',
                'mime_in[buktiBayar,application/pdf,image/jpeg,image/png]',
                'max_size[buktiBayar,7168]',
            ],
        ]);
        if ($validasiBuktiBayar == false) {
            $ses_data = [
                'status'  => "Gagal",
                'waktu'    => "File terlalu besar atau tipe file tidak sesuai, file max 1,5 mb dan tipe data jpg/jpeg, silahkan coba lagi"
            ];
            $session->set($ses_data);
            return redirect()->back();
        }
        // API untuk upload berkas / berkas
        $curl = curl_init();
        if (function_exists('curl_file_create')) { // php 5.5+
            $buktiBayarUpload = curl_file_create($buktiBayar->getRealPath(), 'application/pdf,image/jpeg', $buktiBayar->getName());
        }
        $post = [
            'namaRekeningPembayaran'    => $namaRekeningPembayaran,
            'nomorRekeningPembayaran'   => $nomorRekeningPembayaran,
            'buktiBayar'                => $buktiBayarUpload
        ];

        // proses API Kunjungan
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.register.co.id/api/UploadBuktiBayarPeserta/' . $idPeserta,
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
            return redirect()->to(base_url() . 'Dashboard');
        }
    }
}
