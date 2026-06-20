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
$routes->get('/logout', 'Administrasi::logout');
$routes->post('/validasi', 'Administrasi::validasi');
$routes->get('/jemaat', 'Administrasi::jemaat');
$routes->get('/sektor', 'Administrasi::sektor');
$routes->get('/jabatan', 'Administrasi::jabatan');
$routes->get('/organisasi', 'Administrasi::organisasi');
$routes->get('/kegiatan', 'Administrasi::kegiatan');
$routes->get('/report/jabatan', 'Administrasi::report_jabatan');
$routes->get('/report/kelompokumur', 'Administrasi::report_kelompok_umur');
$routes->get('/report/pernikahan', 'Administrasi::report_pernikahan');
$routes->get('/report/sektor', 'Administrasi::report_sektor');
$routes->get('/report/statistik', 'Administrasi::report_statistik');
$routes->get('/report/statuskeanggotaan', 'Administrasi::report_status_keanggotaan');
$routes->get('/report/ulangtahun', 'Administrasi::report_ulang_tahun');
$routes->get('/report/seting', 'Administrasi::seting');

// daftar route api internal
// =========================
$routes->post('/api/intern/periksa_token', 'Administrasi::periksa_token');

// Sektor
$routes->get('/api/intern/sektor/all', 'Sektor\Sektorcontroller::sektor_all');
$routes->post('/api/intern/sektor/del', 'Sektor\Sektorcontroller::sektor_del');
$routes->post('/api/intern/sektor/change', 'Sektor\Sektorcontroller::sektor_change');
$routes->post('/api/intern/sektor/add', 'Sektor\Sektorcontroller::sektor_add');

// Jemaat
$routes->get('/api/intern/jemaat/sektor', 'Jemaat\Jemaatcontroller::jemaat_per_sektor');
$routes->post('/api/intern/jemaat/add', 'Jemaat\Jemaatcontroller::jemaat_add');
$routes->get('/api/intern/jemaat/anggota', 'Jemaat\Jemaatcontroller::jemaat_anggota');
$routes->post('/api/intern/jemaat/anggota/add', 'Jemaat\Jemaatcontroller::jemaat_anggota_add');
$routes->post('/api/intern/jemaat/anggota/del', 'Jemaat\Jemaatcontroller::jemaat_anggota_del');
$routes->post('/api/intern/jemaat/anggota/savechange', 'Jemaat\Jemaatcontroller::jemaat_anggota_ubah_simpan');
$routes->get('/api/intern/jemaat/anggota/all', 'Jemaat\Jemaatcontroller::jemaat_anggota_all');
$routes->get('/api/intern/jemaat/nik', 'Jemaat\Jemaatcontroller::jemaat_nik');

// Jabatan
$routes->get('/api/intern/jabatan/all', 'Jabatan\Jabatancontroller::jabatan_all');
$routes->post('/api/intern/jabatan/add', 'Jabatan\Jabatancontroller::jabatan_add');
$routes->post('/api/intern/jabatan/change', 'Jabatan\Jabatancontroller::jabatan_change');
$routes->post('/api/intern/jabatan/del', 'Jabatan\Jabatancontroller::jabatan_del');
$routes->get('/api/intern/jabatan/pejabat/all', 'Jabatan\Jabatancontroller::pejabat_all');
$routes->post('/api/intern/jabatan/pejabat/add', 'Jabatan\Jabatancontroller::pejabat_add');
$routes->post('/api/intern/jabatan/pejabat/del', 'Jabatan\Jabatancontroller::pejabat_del');

// Organisasi






