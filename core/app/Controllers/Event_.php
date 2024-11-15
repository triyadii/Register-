<?php

namespace App\Controllers;

class Event_ extends BaseController
{
    public function registrasiEvent()
    {
        $session                    = session();
        $namaEvent                  = $this->request->getPost('namaEvent');
        $lokasiEvent                = $this->request->getPost('lokasiEvent');
        $tanggalEvent               = $this->request->getPost('tanggalEvent');
        $tanggalPendaftaranEvent    = $this->request->getPost('tanggalPendaftaranEvent');
        $namaOperator               = $this->request->getPost('namaOperator');
        $nomorTeleponOperator       = "62" . substr(trim($this->request->getPost('nomorTelepon')), 1);
        $alamatOperator             = $this->request->getPost('alamatOperator');
        $subdomainEvent             = str_replace(' ', '', $namaEvent);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.register.co.id/api/TambahEvent',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(),
            CURLOPT_POSTFIELDS => '{
                "namaEvent" : "' . $namaEvent . '",
                "lokasiEvent" : "' . $lokasiEvent . '",
                "tanggalEvent" : "' . $tanggalEvent . '",
                "tanggalPendaftaranEvent" : "' . $tanggalPendaftaranEvent . '",
                "namaOperator" : "' . $namaOperator . '",
                "nomorTeleponOperator" : "' . $nomorTeleponOperator . '",
                "alamatOperator" : "' . $alamatOperator . '"
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($curl);
        die(print_r($response));
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $hasilResponse = json_decode($response, true);
        die(print_r($hasilResponse));

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
                'mime_in[buktiBayar,application/pdf,image/jpeg]',
                'max_size[buktiBayar,2048]',
            ],
        ]);
        if ($validasiBuktiBayar == false) {
            $ses_data = [
                'statusTambah'  => "Gagal",
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