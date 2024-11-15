<?php

namespace App\Controllers;

use App\Models\Model_data;

class Page extends BaseController
{
    // Halaman Maintenance
    public function maintenance()
    {
        return view('maintenance2');
    }
    // =========================================
    // Halaman Landing Page
    public function landingPage()
    {
        return view('landingPage');
    }
    // =========================================
    // Halaman Admin
    public function dashboard()
    {
        return view('dashboard');
    }
    public function login()
    {
        return view('login');
    }
    public function registrasiEvent()
    {
        return view('registrasiEvent');
    }
    public function uploadBuktiBayar($idEvent = null)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.register.co.id/api/TampilEventById/' . $idEvent,
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
        return view('uploadBuktiBayar', compact('dataEvent'));
    }
    public function event()
    {
        return view('event');
    }
    public function userAdmin()
    {
        return view('userAdmin');
    }
    public function userOperator()
    {
        return view('userOperator');
    }
    public function userPeserta()
    {
        return view('userPeserta');
    }
    public function hakAksesAdmin()
    {
        return view('hakAksesAdmin');
    }
    public function hakAksesOperator()
    {
        return view('hakAksesOperator');
    }
    public function hakAksesPeserta()
    {
        return view('hakAksesPeserta');
    }
}
