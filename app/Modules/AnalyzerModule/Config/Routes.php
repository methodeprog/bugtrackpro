<?php

use CodeIgniter\Router\RouteCollection;

// ========================
// MODULE : DOCTORMODULE (Diagnostics)
// ========================

$routes->group('doctor', ['filter' => 'jwt-auth','namespace' => 'App\Modules\DoctorModule\Controllers'], function($routes) {
    $routes->get('/', 'DoctorController::index');
    $routes->get('recommendation/(:num)', 'DoctorController::recommendation/$1');
    $routes->get('errors', 'DoctorController::getErrors'); 
    
    $routes->get('edit/(:num)', 'DoctorController::edit/$1');
    $routes->post('update/(:num)', 'DoctorController::update/$1');
});
