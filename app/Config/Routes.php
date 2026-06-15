<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
// $routes->get('/', 'Home::index');
$routes->get('/daftar', 'Pendaftaran::index');
$routes->get('/daftar/terima_kasih', 'Pendaftaran::terima_kasih');
$routes->post('/daftar/cek_email', 'Pendaftaran::cek_email');
$routes->post('/daftar/cek_gereja', 'Pendaftaran::cek_gereja');
$routes->post('/daftar/tambah_gereja', 'Pendaftaran::tambah_gereja');

$routes->get('/', 'Administrasi::index');
$routes->post('/validasi', 'Administrasi::validasi');
