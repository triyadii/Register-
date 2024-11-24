<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Halaman
$routes->get('/', 'Page::landingPage');
$routes->get('/Registrasi', 'Page::registrasi');
$routes->get('/UploadBuktiBayar', 'Page::uploadBuktiBayar');
$routes->get('/KonfirmasiPembayaran', 'Page::konfirmasiPembayaran');
$routes->get('/Login', 'Page::login');
$routes->get('/LoginOperator', 'Page::loginOperator');
$routes->get('/Dashboard', 'Page::dashboard');
$routes->get('/DashboardOperator', 'Page::dashboardOperator');
$routes->get('/Peserta', 'Page::peserta');
$routes->get('/ScanBarcodeRegister', 'Page::scanBarcodeRegister');
$routes->get('/ScanBarcodeMasuk', 'Page::scanBarcodeMasuk');

// Proses
$routes->post('/Register', 'Register_::registrasi');
$routes->post('/UploadBuktiBayar', 'Register_::uploadBuktiBayar');
$routes->post('/Login', 'Peserta_::login');
$routes->post('/LoginOperator', 'Peserta_::loginOperator');
$routes->get('/Keluar', 'Peserta_::keluar');
$routes->get('/KonfirmasiPembayaranPeserta/(:num)/(:num)', 'Peserta_::konfirmasiPembayaranPeserta/$1/$2');
$routes->post('/KonfirmasiKehadiran', 'Peserta_::konfirmasiKehadiran');
$routes->post('/KonfirmasiMasuk', 'Peserta_::konfirmasiMasuk');
$routes->get('/GenerateQrCode/(:any)', 'QrCodeGenerator_::QrCodeGenerator/$1');
