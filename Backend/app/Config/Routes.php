<?php

use CodeIgniter\Router\RouteCollection;

$routes->options('api/(:any)', static function () {
    return service('response')->setStatusCode(200);
});

$routes->group('api', function($routes) {

    $routes->post('register', 'AuthController::register');
    $routes->post('login', 'AuthController::login');

    $routes->get('employees', 'EmployeeController::index');
    $routes->get('employees/(:num)', 'EmployeeController::show/$1');
    $routes->post('employees', 'EmployeeController::create');
    $routes->put('employees/(:num)', 'EmployeeController::update/$1');
    $routes->delete('employees/(:num)', 'EmployeeController::delete/$1');

});