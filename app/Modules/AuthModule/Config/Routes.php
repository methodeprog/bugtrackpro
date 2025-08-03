<?php

use CodeIgniter\Router\RouteCollection;

// ========================
// MODULE : AUTHMODULE
// ========================


/**
 * @var RouteCollection $routes
 */
$routes->group('auth', ['namespace' => 'App\Modules\AuthModule\Controllers'], function($routes) {
    $routes->get('login', 'AuthController::loginForm');
    $routes->post('login', 'AuthController::login');
    $routes->get('register', 'AuthController::registrationForm');
    $routes->post('register', 'AuthController::registration');
    $routes->get('logout', 'AuthController::logout');
    $routes->get('success', 'AuthController::success');
});