<?php

namespace App\Controllers;

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
            return redirect()->to(base_url() . 'ScanBarcodeRegister');
        } else if ($httpcode == 202) {
            $ses_data = [
                'status'        => "Peringatan",
                'keterangan'    => $hasilResponse['messages']
            ];
            $session->set($ses_data);
            return redirect()->to(base_url() . 'ScanBarcodeRegister');
        } else {
            $ses_data = [
                'status'                => "Berhasil",
                'keterangan'            => $hasilResponse['messages'],
            ];
            $session->set($ses_data);
            return redirect()->to(base_url() . 'ScanBarcodeRegister');
            // return redirect()->to(base_url() . 'TampilDataKehadiran');
        }
    }
    public function konfirmasiMasuk()
    {
        $session   = session();
        $token     = $session->get('token');
        $kodePeserta = $this->request->getPost('kodePeserta');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.register.co.id/api/TampilPesertaByKodePeserta/' . $kodePeserta,
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
        $data = $hasilResponse['data'];

        // Proses Pemasukkan Nama Pada Sertifikat
        $nama = $data[0]['namaPeserta'];
        // $image = imagecreatefromjpeg("https://api.register.co.id/certificate.jpg");
        $image = imagecreatefromjpeg("assets_admin/img/selamatDatang.jpg");
        $font = "assets_admin/QuinchoScript_PersonalUse.ttf";
        $color = imagecolorallocate($image, 19, 21, 22);
        $size = 100;
        $size2 = 120;
        // Membuat Tulisan Berada di tengah
        $image_width = imagesx($image);
        $text_box = imagettfbbox($size, 0, $font, $nama);
        $text_width = $text_box[2] - $text_box[0];
        $x = ($image_width / 2) - ($text_width / 2);
        $x2 = ($image_width / 2) - ($text_width / 1.5);
        imagettftext($image, $size2, 0, $x2, 500, $color, $font, "Selamat Datang");
        imagettftext($image, $size, 0, $x, 700, $color, $font, $nama);
        $file = "selamatDatang";
        imagejpeg($image, "uploads/" . $file . ".jpg");
        imagedestroy($image);
        return view('tampilDataPeserta', compact('data'));
    }
    public function keluar()
    {
        $session     = session();
        $session->destroy();
        return redirect()->to(base_url());
    }
}
