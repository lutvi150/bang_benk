<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->set404Override(function () {
    return view('404.php');
});
$routes->get('/', 'Home::front_page');
$routes->get('/register', 'Home::register');
$routes->post('/register', 'Home::store_register');
$routes->get('/logout', 'Home::logout');
// use for login
$routes->get('/shop-login', 'Home::login');
$routes->post('/api-login', 'Home::verification');
// use for admin
$routes->group('admin', static function ($routes) {
    $routes->get('login', 'Home::login');
});
$routes->group('administrator', static function ($routes) {
    $routes->get('transaksi', 'Administrator::transaksi');
    $routes->get('/', 'Administrator::index');
    // user
    $routes->get('user', 'Administrator::user');
    $routes->get('produk', 'Administrator::produk');
    $routes->get('produk/add', 'Administrator::produk_add');
    $routes->post('produk/add', 'Administrator::produk_store');
    $routes->get('produk/edit/(:num)', 'Administrator::produk_edit/$1');
    $routes->post('produk/edit/(:num)', 'Administrator::produk_update/$1');
    $routes->get('produk/delete/(:num)', 'Administrator::produk_delete/$1');
    $routes->get('produk/stok/(:num)', 'Administrator::produk_stok/$1');
    $routes->post('produk/stok/(:num)', 'Administrator::produk_stok_store/$1');
    $routes->get('produk/stok/delete/(:num)', 'Administrator::produk_stok_delete/$1');
    $routes->get('produk/stok/edit/(:num)', 'Administrator::produk_stok_edit/$1');
    // gambar
    $routes->post('produk/gambar/upload', 'Administrator::produk_gambar_upload');
    $routes->post('produk/gambar/delete', 'Administrator::produk_gambar_delete');
    $routes->get('produk/gambar/(:num)', 'Administrator::produk_gambar/$1');
    $routes->get('produk/gambar/priview/(:num)', 'Administrator::produk_gambar_priview/$1');
});
$routes->get('test', 'Home::tes');
