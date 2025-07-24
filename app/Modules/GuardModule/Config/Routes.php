
<?php

use CodeIgniter\Router\RouteCollection;



// ========================
// MODULE : GUARDMODULE (API)
// ========================
$routes->group('api', ['namespace' => 'App\Modules\GuardModule\Controllers'], function($routes) {
    $routes->get('errors', 'ErrorApiController::index');
    $routes->get('errors/(:num)', 'ErrorApiController::show/$1');
    $routes->post('errors', 'ErrorApiController::store');
});