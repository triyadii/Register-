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
$routes->get('/PenjagaStand', 'Page::penjagaStand');
$routes->get('/ScanBarcodeRegister', 'Page::scanBarcodeRegister');
$routes->get('/ScanBarcodeMasuk', 'Page::scanBarcodeMasuk');

// Proses
$routes->post('/Register', 'Register_::registrasi');
$routes->post('/UploadBuktiBayar', 'Register_::uploadBuktiBayar');
$routes->post('/Login', 'Peserta_::login');
$routes->post('/LoginOperator', 'Peserta_::loginOperator');
$routes->get('/Keluar', 'Peserta_::keluar');
$routes->get('/KonfirmasiPembayaranPeserta/(:num)/(:num)', 'Peserta_::konfirmasiPembayaranPeserta/$1/$2');
$routes->get('/HapusPeserta/(:num)', 'Peserta_::hapusPeserta/$1');
$routes->get('/HapusPenjagaStand/(:num)', 'Peserta_::hapusPenjagaStand/$1');
$routes->post('/KonfirmasiKehadiran', 'Peserta_::konfirmasiKehadiran');
$routes->post('/KonfirmasiMasuk', 'Peserta_::konfirmasiMasuk');
$routes->post('/UpdateJenisPeserta/(:num)', 'Peserta_::updateJenisPeserta/$1');
$routes->post('/EditDataPeserta/(:num)', 'Peserta_::editDataPeserta/$1');
$routes->post('/UpdateFotoProfil/(:num)', 'Peserta_::updateFotoProfil/$1');
$routes->post('/EditProfil/(:num)', 'Peserta_::editProfil/$1');
$routes->post('/TambahBooth', 'Peserta_::tambahBooth');
$routes->post('/UpdateBooth/(:num)', 'Peserta_::updateBooth/$1');
$routes->post('/CekBarcodePenjagaBooth', 'Peserta_::cekBarcodePenjagaBooth');
$routes->get('/DownloadBarcode/(:any)', 'Peserta_::DownloadBarcode/$1');
$routes->get('/GenerateQrCode/(:any)/(:any)', 'QrCodeGenerator_::QrCodeGenerator/$1/$2');