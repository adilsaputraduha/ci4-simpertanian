<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index', ['filter' => 'masuk']);

// Routing login & Logout
$routes->get('/login', 'LoginController::index');
$routes->post('/login/ceklogin', 'LoginController::ceklogin');
$routes->get('/logout', 'LoginController::logout');
// Routing User
$routes->get('/user', 'UserController::index', ['filter' => 'masuk']);
$routes->post('/user/save', 'UserController::save', ['filter' => 'masuk']);
$routes->post('/user/edit', 'UserController::edit', ['filter' => 'masuk']);
$routes->post('/user/delete', 'UserController::delete', ['filter' => 'masuk']);
// Routing Kelompok
$routes->get('/kelompok', 'KelompokController::index', ['filter' => 'masuk']);
$routes->post('/kelompok/save', 'KelompokController::save', ['filter' => 'masuk']);
$routes->post('/kelompok/edit', 'KelompokController::edit', ['filter' => 'masuk']);
$routes->post('/kelompok/delete', 'KelompokController::delete', ['filter' => 'masuk']);
// Routing Anggota
$routes->get('/anggota', 'AnggotaController::index', ['filter' => 'masuk']);
$routes->post('/anggota/save', 'AnggotaController::save', ['filter' => 'masuk']);
$routes->post('/anggota/edit', 'AnggotaController::edit', ['filter' => 'masuk']);
$routes->post('/anggota/delete', 'AnggotaController::delete', ['filter' => 'masuk']);
// Routing Bantuan
$routes->get('/bantuan', 'BantuanController::index', ['filter' => 'masuk']);
$routes->post('/bantuan/save', 'BantuanController::save', ['filter' => 'masuk']);
$routes->post('/bantuan/edit', 'BantuanController::edit', ['filter' => 'masuk']);
$routes->post('/bantuan/delete', 'BantuanController::delete', ['filter' => 'masuk']);
// Routing Pelatihan
$routes->get('/pelatihan', 'PelatihanController::index', ['filter' => 'masuk']);
$routes->post('/pelatihan/save', 'PelatihanController::save', ['filter' => 'masuk']);
$routes->post('/pelatihan/edit', 'PelatihanController::edit', ['filter' => 'masuk']);
$routes->post('/pelatihan/delete', 'PelatihanController::delete', ['filter' => 'masuk']);
// Routing Lahan
$routes->get('/lahan', 'LahanController::index', ['filter' => 'masuk']);
$routes->post('/lahan/save', 'LahanController::save', ['filter' => 'masuk']);
$routes->post('/lahan/edit', 'LahanController::edit', ['filter' => 'masuk']);
$routes->post('/lahan/delete', 'LahanController::delete', ['filter' => 'masuk']);
// Routing Penerima
$routes->get('/penerima', 'PenerimaController::index', ['filter' => 'masuk']);
$routes->post('/penerima/save', 'PenerimaController::save', ['filter' => 'masuk']);
$routes->post('/penerima/edit', 'PenerimaController::edit', ['filter' => 'masuk']);
$routes->post('/penerima/delete', 'PenerimaController::delete', ['filter' => 'masuk']);
// Routing Profil
$routes->get('/profil', 'ProfilController::index', ['filter' => 'masuk']);
$routes->post('/profil/update', 'ProfilController::update', ['filter' => 'masuk']);
// Routing Hasil
$routes->get('/hasil', 'HasilController::index', ['filter' => 'masuk']);
$routes->post('/hasil/save', 'HasilController::save', ['filter' => 'masuk']);
$routes->post('/hasil/edit', 'HasilController::edit', ['filter' => 'masuk']);
$routes->post('/hasil/delete', 'HasilController::delete', ['filter' => 'masuk']);
// Ajax Select2
$routes->get('/daerah/kecamatan', 'DaerahController::kecamatan', ['filter' => 'masuk']);
$routes->post('/daerah/kelurahan', 'DaerahController::kelurahan', ['filter' => 'masuk']);
$routes->get('/daerah/getkelurahan', 'DaerahController::getkelurahan', ['filter' => 'masuk']);
$routes->get('/anggota/kelompok', 'AnggotaController::kelompok', ['filter' => 'masuk']);
$routes->get('/penerima/bantuan', 'PenerimaController::bantuan', ['filter' => 'masuk']);
// Routing Laporan
$routes->get('/user/report', 'UserController::report', ['filter' => 'masuk']);
$routes->get('/kelompok/report', 'KelompokController::report', ['filter' => 'masuk']);
$routes->get('/kelompok/cetaksemua', 'KelompokController::cetaksemua', ['filter' => 'masuk']);
$routes->post('/kelompok/cetakkecamatan', 'KelompokController::cetakkecamatan', ['filter' => 'masuk']);
$routes->post('/kelompok/cetakkelurahan', 'KelompokController::cetakkelurahan', ['filter' => 'masuk']);
$routes->post('/kelompok/cetakstatus', 'KelompokController::cetakstatus', ['filter' => 'masuk']);
$routes->get('/anggota/report', 'AnggotaController::report', ['filter' => 'masuk']);
$routes->get('/anggota/cetaksemua', 'AnggotaController::cetaksemua', ['filter' => 'masuk']);
$routes->post('/anggota/cetakkelompok', 'AnggotaController::cetakkelompok', ['filter' => 'masuk']);
$routes->get('/bantuan/report', 'BantuanController::report', ['filter' => 'masuk']);
$routes->get('/bantuan/cetaksemua', 'BantuanController::cetaksemua', ['filter' => 'masuk']);
$routes->post('/bantuan/cetaktanggal', 'BantuanController::cetaktanggal', ['filter' => 'masuk']);
$routes->post('/bantuan/cetakstatus', 'BantuanController::cetakstatus', ['filter' => 'masuk']);
$routes->get('/pelatihan/report', 'PelatihanController::report', ['filter' => 'masuk']);
$routes->get('/pelatihan/cetaksemua', 'PelatihanController::cetaksemua', ['filter' => 'masuk']);
$routes->post('/pelatihan/cetaktanggal', 'PelatihanController::cetaktanggal', ['filter' => 'masuk']);
$routes->post('/pelatihan/cetakhasil', 'PelatihanController::cetakhasil', ['filter' => 'masuk']);
$routes->get('/lahan/report', 'LahanController::report', ['filter' => 'masuk']);
$routes->get('/lahan/cetaksemua', 'LahanController::cetaksemua', ['filter' => 'masuk']);
$routes->post('/lahan/cetakkecamatan', 'LahanController::cetakkecamatan', ['filter' => 'masuk']);
$routes->post('/lahan/cetakkelurahan', 'LahanController::cetakkelurahan', ['filter' => 'masuk']);
$routes->get('/penerima/report', 'PenerimaController::report', ['filter' => 'masuk']);
$routes->get('/penerima/cetaksemua', 'PenerimaController::cetaksemua', ['filter' => 'masuk']);
$routes->post('/penerima/cetakbantuan', 'PenerimaController::cetakbantuan', ['filter' => 'masuk']);
$routes->get('/hasil/report', 'HasilController::report', ['filter' => 'masuk']);
$routes->get('/hasil/cetaksemua', 'HasilController::cetaksemua', ['filter' => 'masuk']);
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
