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
        // if ($httpcode == 400) {
        //     $ses_data = [
        //         'status'        => "Gagal",
        //         'keterangan'    => $hasilResponse['messages']
        //     ];
        //     $session->set($ses_data);
        //     return redirect()->back();
        // } else {
        //     $ses_data = [
        //         'status'                => "Berhasil",
        //         'keterangan'            => $hasilResponse['messages'],
        //     ];
        //     $session->set($ses_data);
        // return redirect()->back();
        return redirect()->to(base_url() . 'TampilDataKehadiran');
        // }
    }
    public function keluar()
    {
        $session     = session();
        $session->destroy();
        return redirect()->to(base_url());
    }
}
