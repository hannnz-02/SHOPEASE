<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('register', 'AuthController::register');
$routes->post('register', 'AuthController::store');

$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::authenticate');

$routes->post('logout', 'AuthController::logout');


// Halaman khusus Admin
$routes->group('admin', [
    'filter' => 'auth:admin'
], static function ($routes) {
    $routes->get('/', 'Admin\DashboardController::index');
});

// Halaman khusus Operator
$routes->group('operator', [
    'filter' => 'auth:operator'
], static function ($routes) {
    $routes->get('/', 'Operator\DashboardController::index');
});
