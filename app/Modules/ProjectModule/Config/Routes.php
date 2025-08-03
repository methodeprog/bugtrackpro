<?php

use CodeIgniter\Router\RouteCollection;

// ========================
// MODULE : AUTHMODULE
// ========================


$routes->group('dashboard', ['namespace' => 'App\Modules\ProjectModule\Controllers'], function($routes) {
    $routes->get('projects', 'ProjectController::all');
    $routes->get('projects/(:num)', 'ProjectController::index/$1');          // Liste des projets par orga_id
    $routes->get('projects/create/(:num)', 'ProjectController::create/$1');  // Form création projet
    $routes->post('projects/store', 'ProjectController::store');             // Enregistrer un projet

    $routes->get('projects/edit/(:num)', 'ProjectController::edit/$1');      // Form édition projet
    $routes->post('projects/update/(:num)', 'ProjectController::update/$1'); // Mise à jour
    $routes->get('projects/delete/(:num)', 'ProjectController::delete/$1'); 
    $routes->get('projects/create', 'ProjectController::createFromAll'); // sans paramètre
// Suppression
});
