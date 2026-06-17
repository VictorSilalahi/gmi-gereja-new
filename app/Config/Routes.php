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

// daftar route api internal
$routes->post('/api/intern/periksa_token', 'Administrasi::periksa_token');

// Sektor
$routes->get('/api/intern/sektor/all', 'Sektor\Sektorcontroller::sektor_all');
$routes->post('/api/intern/sektor/del', 'Sektor\Sektorcontroller::sektor_del');
$routes->post('/api/intern/sektor/change', 'Sektor\Sektorcontroller::sektor_change');
$routes->post('/api/intern/sektor/add', 'Sektor\Sektorcontroller::sektor_add');

// Jemaat
$routes->get('/api/intern/jemaat/sektor', 'Jemaat\Jemaatcontroller::jemaat_per_sektor');





