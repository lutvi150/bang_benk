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
$routes->get('/logout', 'Home::logout');
$routes->post('/api-login', 'Home::verification');
// use for admin
$routes->group('admin',static function ( $routes) {
$routes->get('login','Home::login');
});
