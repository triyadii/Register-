<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//  Routing Halaman
// $routes->get('/', 'Page::maintenance');
$routes->get('/', 'Page::landingPage');
$routes->get('/Login', 'Page::login');
$routes->get('/Registrasi', 'Page::registrasiEvent');
$routes->get('/UploadBuktiBayar/(:num)', 'Page::uploadBuktiBayar/$1');
$routes->get('/Dashboard', 'Page::dashboard');
$routes->get('/Event', 'Page::event');
$routes->get('/UserAdmin', 'Page::userAdmin');
$routes->get('/UserOperator', 'Page::userOperator');
$routes->get('/UserPeserta', 'Page::userPeserta');
$routes->get('/HakAksesAdmin', 'Page::hakAksesAdmin');
$routes->get('/HakAksesOperator', 'Page::hakAksesOperator');
$routes->get('/HakAksesPeserta', 'Page::hakAksesPeserta');
$routes->get('/Peserta', 'Page::peserta');

// Proses 
$routes->post('/RegisterEvent', 'Event_::registrasiEvent');
$routes->post('/Login', 'User_::login');
$routes->get('/Keluar', 'User_::keluar');
