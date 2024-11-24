<?php

namespace App\Controllers;

class Page extends BaseController
{
    public function landingPage()
    {
        $session = session();
        $ses_data = [
            'event'        => "1"
        ];
        $session->set($ses_data);
        return view('landingPage');
    }
    public function registrasi()
    {
        $session = session();
        $ses_data = [
            'event'        => "1"
        ];
        $session->set($ses_data);
        return view('registrasi');
    }
    public function login()
    {
        $session = session();
        $ses_data = [
            'event'        => "1"
        ];
        $session->set($ses_data);
        return view('login');
    }
    public function loginOperator()
    {
        $session = session();
        $ses_data = [
            'event'        => "1"
        ];
        $session->set($ses_data);
        return view('loginOperator');
    }
    public function uploadBuktiBayar()
    {
        $session    = session();
        $idEvent    = $session->get('event');
        $idPeserta  = $session->get('idPeserta');
        $token      = $session->get('token');

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.register.co.id/api/TampilPesertaByIdPeserta/' . $idPeserta,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $token
            ),
        ));
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $hasilResponse = json_decode($response, true);
        $dataPeserta   = $hasilResponse['data'];

        return view('uploadBuktiBayar', compact('dataPeserta'));
    }
    public function konfirmasiPembayaran()
    {
        $session = session();
        $statusPembayaranPeserta = $session->get('statusPembayaranPeserta');
        if ($statusPembayaranPeserta == 2) {
            return redirect()->to(base_url() . 'Dashboard');
        }
        return view('konfirmasiPembayaran');
    }
    public function dashboard()
    {
        $session        = session();
        $statusLogin    = $session->get('statusLogin');
        $idPeserta      = $session->get('idPeserta');
        $token          = $session->get('token');
        if ($statusLogin != "1") {
            return redirect()->to(base_url());
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.register.co.id/api/TampilPesertaByIdPeserta/' . $idPeserta,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $token
            ),
        ));
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $hasilResponse = json_decode($response, true);
        $dataPeserta   = $hasilResponse['data'];
        $ses_data = [
            'statusPembayaranPeserta'        => $dataPeserta[0]['statusPembayaranPeserta']
        ];
        $session->set($ses_data);
        if ($dataPeserta[0]['statusPembayaranPeserta'] == 0) {
            return redirect()->to(base_url() . 'UploadBuktiBayar');
        } else if ($dataPeserta[0]['statusPembayaranPeserta'] == 1) {
            return redirect()->to(base_url() . 'KonfirmasiPembayaran');
        }

        return view('dashboardPeserta', compact('dataPeserta'));
        // return redirect()->to(base_url() . 'UploadBuktiBayar');
    }
    public function DashboardOperator()
    {
        $session        = session();
        $statusLogin    = $session->get('statusLogin');
        $event          = $session->get('event');
        $token          = $session->get('token');
        if ($statusLogin != "1") {
            return redirect()->to(base_url());
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.register.co.id/api/TampilOperator/' . $event,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $token
            ),
        ));
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $hasilResponse = json_decode($response, true);
        $dataOperator   = $hasilResponse['data'];

        return view('dashboardOperator', compact('dataOperator'));
    }
    public function peserta()
    {
        $session        = session();
        $statusLogin    = $session->get('statusLogin');
        $event          = $session->get('event');
        $token          = $session->get('token');
        if ($statusLogin != "1") {
            return redirect()->to(base_url());
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.register.co.id/api/TampilPesertaByIdEvent/' . $event,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $token
            ),
        ));
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $hasilResponse = json_decode($response, true);
        $dataPeserta   = $hasilResponse['data'];

        return view('peserta', compact('dataPeserta'));
    }
    public function scanBarcodeRegister()
    {
        $session = session();
        $ses_data = [
            'event'        => "1"
        ];
        $session->set($ses_data);
        return view('scanBarcodeRegister');
    }
    public function scanBarcodeMasuk()
    {
        $session = session();
        $ses_data = [
            'event'        => "1"
        ];
        $session->set($ses_data);
        return view('scanBarcodeMasuk');
    }
}
