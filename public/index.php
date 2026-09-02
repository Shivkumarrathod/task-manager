<?php

// Start session for authentication
session_start();

require_once __DIR__ . '/../core/Router.php';
require_once __DIR__ . '/../core/Database.php';

$router = new Router();

// Register your routes here. Each maps a URL to a Controller@method.
$router->get('/', 'TaskController@index');
$router->get('/tasks/add', 'TaskController@create');   // shows the add form
$router->post('/tasks/add', 'TaskController@store');   // handles the add form submit
$router->get('/tasks/edit', 'TaskController@edit');    // shows the edit form (?id=)
$router->post('/tasks/edit', 'TaskController@update'); // handles the edit form submit
$router->get('/tasks/delete', 'TaskController@delete'); // deletes (?id=)
$router->get('/create-account', 'Auth@create');      // shows the create account form
$router->post('/create-account', 'Auth@store');     // handles the create account form submit
$router->get('/login', 'Auth@showLogin');           // shows the login form
$router->post('/login', 'Auth@login');              // handles the login form submit
$router->get('/logout', 'Auth@logout');             // logout and destroy session
$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
