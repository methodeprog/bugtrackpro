<?php

use CodeIgniter\Router\RouteCollection;

// ========================
// MODULE : AUTHMODULE
// ========================
$routes->group('auth', ['namespace' => 'App\Modules\AuthModule\Controllers'], function($routes) {
    $routes->get('login', 'AuthController::login');
    $routes->post('login', 'AuthController::authenticate');
    $routes->get('logout', 'AuthController::logout');
    $routes->get('register', 'AuthController::registerForm');
    $routes->post('register', 'AuthController::register');
});

$routes->group('dashboard', ['filter' => 'jwt'], function ($routes) {
    $routes->get('/', 'Dashboard::index');
});


$routes->get('/dashboard', 'AuthModule\Controllers\DashboardController::index');
$routes->get('/auth/logout', 'AuthModule\Controllers\AuthController::logout');
