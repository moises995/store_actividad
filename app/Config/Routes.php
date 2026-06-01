<?php

declare(strict_types=1);

namespace Config;

$routes = Services::routes();

if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

// Home
$routes->get('/', 'Home::index');
$routes->get('/home', 'Home::index');

// Administración de productos
$routes->get('/administracion/nuevo',             'Administracion::newProduct');
$routes->post('/administracion/guardar',          'Administracion::saveProduct');
$routes->get('/administracion/editar/(:num)',     'Administracion::editProduct/$1');
$routes->post('/administracion/update/(:num)',    'Administracion::updateProduct/$1');
$routes->get('/administracion/delete/(:num)',     'Administracion::deleteProduct/$1');

if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
