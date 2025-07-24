<?php

use CodeIgniter\Router\RouteCollection;

// ========================
// MODULE : ADVISERMODULE (IA & Recos)
// ========================
$routes->group('adviser', ['filter' => 'role[admin,dev]'], function($routes) {
    $routes->get('ai-providers', 'App\Modules\AdviserModule\Controllers\AiProviderController::index');
    $routes->get('ai-providers/create', 'App\Modules\AdviserModule\Controllers\AiProviderController::create');
    $routes->post('ai-providers/store', 'App\Modules\AdviserModule\Controllers\AiProviderController::store');
    $routes->get('ai-providers/test/(:num)', 'App\Modules\AdviserModule\Controllers\AiProviderController::test/$1');
    $routes->post('ai-providers/test/send/(:num)', 'App\Modules\AdviserModule\Controllers\AiProviderController::sendTest/$1');

    $routes->get('ai-test', 'App\Modules\AdviserModule\Controllers\AiTestController::index');
    $routes->post('ai-test/send', 'App\Modules\AdviserModule\Controllers\AiTestController::send');
});
