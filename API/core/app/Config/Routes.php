<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Page::landingPage');
$routes->group("api", function ($routes) {

    // manajemen hak akses
    $routes->get("TampilHakAkses", "HakAkses::index", ['filter' => 'authFilter']);
    $routes->post("TambahHakAkses", "HakAkses::create", ['filter' => 'authFilter']);
    $routes->post("EditHakAkses/(:num)", "HakAkses::edit/$1", ['filter' => 'authFilter']);
    $routes->delete("HapusHakAkses/(:num)/(:any)", "HakAkses::hapus/$1/$2", ['filter' => 'authFilter']);

    // manajemen akun
    $routes->post("LoginAkun", "Akun::login");
    $routes->post("LupaPassword", "Akun::lupaPassword");
    $routes->get("TampilAkun", "Akun::index", ['filter' => 'authFilter']);
    $routes->post("TambahAkun", "Akun::create", ['filter' => 'authFilter']);
    $routes->post("EditAkun/(:num)", "Akun::edit/$1", ['filter' => 'authFilter']);
    $routes->post("GantiPasswordAkun/(:num)", "Akun::gantiPassword/$1", ['filter' => 'authFilter']);
    $routes->delete("HapusAkun/(:num)/(:any)", "Akun::hapus/$1/$2", ['filter' => 'authFilter']);

    // Manajemen Event
    $routes->post("LoginOperator", "Event::loginOperator");
    $routes->get("TampilEvent", "Event::index", ['filter' => 'authFilter']);
    $routes->get("TampilEventById/(:num)", "Event::tampilEventByIdEvent/$1");
    $routes->get("TampilOperator/(:num)", "Event::tampilOperator/$1", ['filter' => 'authFilter']);
    $routes->post("TambahEvent", "Event::create");
    $routes->post("UpdateData/(:num)", "Event::updateData/$1", ['filter' => 'authFilter']);
    $routes->post("UploadBuktiBayar/(:num)", "Event::uploadBuktiBayar/$1", ['filter' => 'authFilter']);
    $routes->get("KonfirmasiPembayaran/(:num)/(:num)/(:any)", "Event::konfirmasiPembayaran/$1/$2/$3", ['filter' => 'authFilter']);
    $routes->delete("HapusEvent/(:num)/(:any)", "Event::hapus/$1/$2", ['filter' => 'authFilter']);

    // Manajemen Peserta
    $routes->get("TampilPeserta", "Peserta::index", ['filter' => 'authFilter']);
    $routes->get("TampilPesertaByIdEvent/(:num)", "Peserta::tampilPesertaByIdEvent/$1");
    $routes->get("TampilPesertaByIdPeserta/(:num)", "Peserta::tampilPesertaByIdPeserta/$1");
    $routes->post("PendaftaranPeserta", "Peserta::create");
    $routes->post("LoginPeserta", "Peserta::login");
    $routes->post("EditPeserta/(:num)", "Peserta::edit/$1", ['filter' => 'authFilter']);
    $routes->get("KonfirmasiPembayaranPeserta/(:num)/(:num)/(:any)", "Peserta::konfirmasiPembayaran/$1/$2/$3", ['filter' => 'authFilter']);
    $routes->get("KonfirmasiKehadiran/(:num)/(:any)", "Peserta::konfirmasiKehadiran/$1/$2", ['filter' => 'authFilter']);
    $routes->delete("HapusPeserta/(:num)/(:any)", "Peserta::hapus/$1/$2", ['filter' => 'authFilter']);
    $routes->post("UploadBuktiBayarPeserta/(:num)", "Peserta::uploadBuktiBayar/$1", ['filter' => 'authFilter']);
    $routes->delete("HapusPeserta/(:num)/(:any)", "Peserta::hapus/$1/$2", ['filter' => 'authFilter']);
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */

if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
