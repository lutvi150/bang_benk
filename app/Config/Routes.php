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
    $routes->get('produk/cetak', 'Administrator::produk_cetak');
    // transaksi
    $routes->get('transaksi', 'Administrator::transaksi');
    $routes->get('transaksi/detail/(:num)', 'Administrator::transaksi_detail/$1');
    $routes->get('bukti-pembayaran/(:num)', 'Administrator::bukti_pembayaran_view/$1');
    $routes->post('verifikasi-pembayaran', 'Administrator::verifikasi_pembayaran');
    // search produk
    $routes->post('produk/search', 'Administrator::produk_search');
    $routes->get('keranjang', 'Administrator::keranjang');
    $routes->post('keranjang/update', 'Administrator::keranjang_update');
    $routes->get('keranjang/reset', 'Administrator::keranjang_reset');
    $routes->get('keranjang/delete/(:num)', 'Administrator::keranjang_delete/$1');
    $routes->get('transaksi/proses_transaksi', 'Administrator::proses_transaksi');
    // transaksi manual
    $routes->get('transaksi/manual', 'Administrator::transaksi_manual');
    // faktur
    $routes->get('faktur/(:num)', 'Report::faktur/$1');
});
$routes->group('pelanggan', static function ($routes) {
    $routes->get('dashboard', 'Pelanggan::dashboard');
    $routes->get('keranjang/(:num)', 'Pelanggan::produk');
    $routes->post('keranjang', 'Pelanggan::keranjang_store');
    $routes->get('keranjang', 'Pelanggan::keranjang');
    $routes->get('shop-cart', 'Pelanggan::keranjang_view');
    $routes->get('produk/(:num)', 'Pelanggan::produk_detail/$1');
    $routes->get('checkout', 'Pelanggan::checkout');
    $routes->get('transaksi', 'Pelanggan::transaksi');
    $routes->post('bukti-pembayaran', 'Pelanggan::bukti_pembayaran_upload');
    $routes->get('bukti-pembayaran/(:num)', 'Pelanggan::bukti_pembayaran_view/$1');
    $routes->get('faktur/(:num)', 'Report::faktur/$1');
});
