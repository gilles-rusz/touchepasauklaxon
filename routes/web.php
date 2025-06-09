<?php

// Routes pour les trajets
$router->get('/trajets', 'App\\Controllers\\TrajetController@index');
$router->get('/trajets/creer', 'App\\Controllers\\TrajetController@create');
$router->post('/trajets', 'App\\Controllers\\TrajetController@store');

$router->get('/trajets/{id}/modifier', 'App\\Controllers\\TrajetController@edit');
$router->post('/trajets/{id}/modifier', 'App\\Controllers\\TrajetController@update');
$router->post('/trajets/{id}/supprimer', 'App\\Controllers\\TrajetController@delete');

// Page d’accueil
$router->get('/', 'App\\Controllers\\TrajetController@home');


// Authentification
$router->get('/login', 'App\\Controllers\\AuthController@loginForm');
$router->post('/login', 'App\\Controllers\\AuthController@login');
$router->get('/logout', 'App\\Controllers\\AuthController@logout');


// Dashboard admin
$router->get('/admin', 'AdminController@dashboard');

// CRUD Agences (admin uniquement)
$router->get('/admin/agences', 'AdminController@agencesIndex');
$router->get('/admin/agences/creer', 'AdminController@agencesCreate');
$router->post('/admin/agences', 'AdminController@agencesStore');
$router->get('/admin/agences/{id}/modifier', 'AdminController@agencesEdit');
$router->post('/admin/agences/{id}/modifier', 'AdminController@agencesUpdate');
$router->post('/admin/agences/{id}/supprimer', 'AdminController@agencesDelete');
