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

// Dashboard
$routes->get('/',         'Home::index');
$routes->get('/home',     'Home::index');

// Products list, export and barcode
$routes->get('/products',              'Products::index');
$routes->get('/products/export',       'Products::exportCsv');
$routes->get('/products/barcode/(:num)', 'Products::barcode/$1');

// Product CRUD
$routes->get('/administracion/nuevo',            'Administracion::newProduct');
$routes->post('/administracion/guardar',         'Administracion::saveProduct');
$routes->get('/administracion/editar/(:num)',    'Administracion::editProduct/$1');
$routes->post('/administracion/update/(:num)',   'Administracion::updateProduct/$1');
$routes->post('/administracion/delete/(:num)',   'Administracion::deleteProduct/$1');

if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
