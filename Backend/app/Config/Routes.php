<?php

use CodeIgniter\Router\RouteCollection;

$routes->post('register', 'AuthController::register');
$routes->post('login', 'AuthController::login');
