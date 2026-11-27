
<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

// Authentication
$routes->get('register', 'AuthController::register');
$routes->post('register', 'AuthController::store');

$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::authenticate');

$routes->post('logout', 'AuthController::logout');


// HALAMAN KHUSUS ADMIN
$routes->group('admin', [
    'filter' => 'auth:admin'
], static function ($routes) {

    // Dashboard Admin
    $routes->get('/', 'Admin\DashboardController::index');

    // Category Management
    $routes->get('categories', 'Admin\CategoryController::index');
    $routes->get('categories/create', 'Admin\CategoryController::create');
    $routes->post('categories/store', 'Admin\CategoryController::store');
    $routes->get('categories/edit/(:num)', 'Admin\CategoryController::edit/$1');
    $routes->post('categories/update/(:num)', 'Admin\CategoryController::update/$1');
    $routes->post('categories/delete/(:num)', 'Admin\CategoryController::delete/$1');


    // Product Management
    $routes->get('products', 'Admin\ProductController::index');
    $routes->get('products/create', 'Admin\ProductController::create');
    $routes->post('products/store', 'Admin\ProductController::store');
    $routes->get('products/edit/(:num)', 'Admin\ProductController::edit/$1');
    $routes->post('products/update/(:num)', 'Admin\ProductController::update/$1');
    $routes->post('products/delete/(:num)', 'Admin\ProductController::delete/$1');

    $routes->get('users', 'Admin\UserController::index');
    $routes->get('users/edit/(:num)', 'Admin\UserController::edit/$1');
    $routes->post('users/update/(:num)', 'Admin\UserController::update/$1');
    $routes->post('users/delete/(:num)', 'Admin\UserController::delete/$1');
    // Gallery: memilih gambar utama
    $routes->post(
        'products/(:num)/images/(:num)/primary',
        'Admin\ProductController::setPrimaryImage/$1/$2'
    );

    // Gallery: menghapus gambar tertentu
    $routes->post(
        'products/(:num)/images/(:num)/delete',
        'Admin\ProductController::deleteImage/$1/$2'
    );

});


// HALAMAN KHUSUS OPERATOR
$routes->group('operator', [
    'filter' => 'auth:operator'
], static function ($routes) {

    // Dashboard Operator
    $routes->get('/', 'Operator\DashboardController::index');

});
