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
    public function registrasiEvent()
    {
        return view('registrasiEvent');
    }
    // =========================================
    // Halaman Admin
    public function dashboard()
    {
        $session        = session();
        $statusLogin    = $session->get('statusLogin');
        $token          = $session->get('token');
        if ($statusLogin == 0) {
            return redirect()->to(base_url() . 'Login');
        }
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.register.co.id/api/JumlahEventDanPeserta',
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
        $data = json_decode($response, true);
        return view('dashboard', compact('data'));
    }
    public function login()
    {
        $session        = session();
        $statusLogin    = $session->get('statusLogin');
        if ($statusLogin == 1) {
            return redirect()->to(base_url());
        }
        return view('login');
    }
    public function event()
    {
        $session        = session();
        $statusLogin    = $session->get('statusLogin');
        if ($statusLogin == 0) {
            return redirect()->to(base_url() . 'Login');
        }
        return view('event');
    }
    public function userAdmin()
    {
        $session        = session();
        $statusLogin    = $session->get('statusLogin');
        if ($statusLogin == 0) {
            return redirect()->to(base_url() . 'Login');
        }
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
