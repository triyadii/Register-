<?php

namespace App\Controllers;

class User_ extends BaseController
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
            $ses_data = [
                'status'        => "Berhasil",
                'keterangan'    => $hasilResponse['messages'],
                'username'      => $hasilResponse['data']['username'],
                'idPeserta'     => $hasilResponse['data']['userId'],
                'hakAkses'      => $hasilResponse['data']['hakAkses'],
                'namaHakAkses'  => $hasilResponse['data']['namaHakAkses'],
                'token'         => $hasilResponse['data']['token'],
                'statusLogin'   => "1"
            ];
            $session->set($ses_data);
            return redirect()->to(base_url() . 'Dashboard');
        }
    }
    public function keluar()
    {
        $session     = session();
        $session->destroy();
        return redirect()->to(base_url());
    }
}
