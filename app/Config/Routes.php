<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
// $routes->get('/', 'Home::index');

// route pendaftaran
$routes->get('/daftar', 'Pendaftaran::index');
$routes->get('/daftar/terima_kasih', 'Pendaftaran::terima_kasih');
$routes->post('/daftar/cek_email', 'Pendaftaran::cek_email');
$routes->post('/daftar/cek_gereja', 'Pendaftaran::cek_gereja');
$routes->post('/daftar/tambah_gereja', 'Pendaftaran::tambah_gereja');

// route ke dalam aplikasi
$routes->get('/', 'Administrasi::index');
$routes->post('/validasi', 'Administrasi::validasi');
$routes->get('/jemaat', 'Administrasi::jemaat');
$routes->get('/sektor', 'Administrasi::sektor');

// route api internal
$routes->post('/intern/api/periksa_token', 'Webapiv1::periksa_token');
$routes->get('/api/intern/sektor/all', 'Webapiv1::sektor_all');


