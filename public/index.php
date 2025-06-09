<?php

session_start();

require_once __DIR__ . '/../autoload.php';
require_once __DIR__ . '/../vendor/Bramus/Router/Router.php';
require_once __DIR__ . '/../app/Controllers/TrajetController.php';
require_once __DIR__ . '/../app/Controllers/AuthController.php';
require_once __DIR__ . '/../app/Controllers/AdminController.php';
require_once __DIR__ . '/../app/Models/Employe.php';

use Bramus\Router\Router;

$router = new Router();

// Routes
$router->get('/', 'App\\Controllers\\TrajetController@index');
$router->get('/login', 'App\\Controllers\\AuthController@loginForm');
$router->post('/login', 'App\\Controllers\\AuthController@login');
$router->get('/logout', 'App\\Controllers\\AuthController@logout');

// Lance le routeur
$router->run();
