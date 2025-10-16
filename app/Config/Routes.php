<?php

/**
 * @author Puji Ermanto <pujiermanto@gmail.com> | AKA Maman Nur Furqon
 * @license MIT License
 * @link
 * @return void
 */

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('auth/google',          'Auth::google');
$routes->get('auth/google/callback', 'Auth::googleCallback');
$routes->post('auth/login', 'Auth::login');
$routes->get('auth/logout', 'Auth::logout');
$routes->get('kuesioner/alumni', 'KuesionerAlumni::index', ['filter' => 'auth']);
$routes->post('kuesioner/alumni/simpan', 'KuesionerAlumni::simpan');
$routes->get('kuesioner/pengguna', 'KuesionerPengguna::index');
$routes->post('kuesioner/pengguna/simpan', 'KuesionerPengguna::simpan');
$routes->get('laporan/alumni', 'Rekap::tracer');
$routes->get('laporan/pengguna', 'Rekap::pengguna');
$routes->get('rekap/export/alumni', 'Rekap::exportAlumni');
$routes->get('rekap/export/pengguna', 'Rekap::exportPengguna');


// Admin Routes
$routes->get('admin', 'Admin\Auth::login');
$routes->post('admin/login', 'Admin\Auth::doLogin');
$routes->get('admin/logout', 'Admin\Auth::logout');


$routes->group('admin', ['filter' => 'admin'], function ($routes) {
    // Dashboard
    $routes->get('dashboard', 'Admin\Dashboard::index');
    // Setting Profil Admin
    $routes->get('profile', 'Admin\Profile::index');
    $routes->post('profile/update', 'Admin\Profile::update');


    // Alumni
    $routes->get('alumni', 'Admin\Alumni::index');
    $routes->get('alumni/detail/(:num)', 'Admin\Alumni::detail/$1');
    $routes->get('alumni/add', 'Admin\Alumni::add');
    $routes->post('alumni/save', 'Admin\Alumni::save');
    $routes->get('alumni/edit/(:num)', 'Admin\Alumni::edit/$1');
    $routes->post('alumni/update/(:num)', 'Admin\Alumni::update/$1');
    $routes->get('alumni/delete/(:num)', 'Admin\Alumni::delete/$1');
    $routes->get('alumni/cetak', 'Admin\Alumni::cetak');

    // Pengguna
    $routes->get('pengguna', 'Admin\Pengguna::index');
    $routes->get('pengguna/cetak', 'Admin\Pengguna::cetak');

    // Tracer
    $routes->get('tracer', 'Admin\Tracer::index');
    $routes->get('tracer/detail/(:num)', 'Admin\Tracer::detail/$1');
    $routes->get('tracer/delete/(:num)', 'Admin\Tracer::delete/$1');
    $routes->get('tracer/export/all', 'Admin\Tracer::exportAll');
    $routes->get('tracer/export/(:num)', 'Admin\Tracer::exportSingle/$1');

    // Setting & Panduan
    $routes->get('periode', 'Admin\Periode::index');
    $routes->post('periode/simpan', 'Admin\Periode::simpan');
    $routes->get('panduan', 'Admin\Panduan::index');
    $routes->post('panduan/upload', 'Admin\Panduan::upload');

    // Landing Page
    $routes->get('landing', 'Admin\Landing::index');
    $routes->post('landing/add', 'Admin\Landing::add');
    $routes->post('landing/update', 'Admin\Landing::update');
    $routes->get('landing/edit/(:num)', 'Admin\Landing::edit/$1');

    // Kuesioner Fields
    $routes->get('kuesionerfields', 'Admin\KuesionerFields::index');
    $routes->get('kuesionerfields/create', 'Admin\KuesionerFields::create');
    $routes->post('kuesionerfields/store', 'Admin\KuesionerFields::store');
    $routes->get('kuesionerfields/edit/(:num)', 'Admin\KuesionerFields::edit/$1');
    $routes->post('kuesionerfields/update/(:num)', 'Admin\KuesionerFields::update/$1');
    $routes->get('kuesionerfields/delete/(:num)', 'Admin\KuesionerFields::delete/$1');

    // Kuesioner Pengguna
    $routes->get('kuesioner-pengguna', 'Admin\KuesionerPengguna::index');
    $routes->get('kuesioner-pengguna/detail/(:num)', 'Admin\KuesionerPengguna::detail/$1');
    $routes->get('kuesioner-pengguna/delete/(:num)', 'Admin\KuesionerPengguna::delete/$1');
    $routes->get('kuesioner-pengguna/export/all', 'Admin\KuesionerPengguna::exportAll');
    $routes->get('kuesioner-pengguna/export/(:num)', 'Admin\KuesionerPengguna::exportSingle/$1');
});


$routes->get('alumni/dashboard', 'Alumni\Dashboard::index', ['filter' => 'auth']);
// Fitur edit tracer study oleh alumni
$routes->get('alumni/tracer/edit', 'Alumni\Tracer::edit', ['filter' => 'auth']);
$routes->post('alumni/tracer/update', 'Alumni\Tracer::update', ['filter' => 'auth']);


$routes->get('test', 'Test::index');
