<?php

use CodeIgniter\Router\RouteCollection;

// ========================
// MODULE : ADVISERMODULE (IA & Recos)
// ========================
/**
 * @var RouteCollection $routes
 */


$routes->group('dashboard', ['namespace' => 'App\Modules\OrganizationModule\Controllers'], function($routes) {
$routes->get('organizations', 'OrganizationController::index');
$routes->get('organizations/create', 'OrganizationController::createForm');
$routes->post('organizations/store', 'OrganizationController::store');
        // Créer une organisation
});
