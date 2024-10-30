<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index', ['filter' => 'authfilter']);
$routes->get('/product', 'Home::product', ['filter' => 'authfilter']);
$routes->get('/product/(:any)', 'Home::productById/$1', ['filter' => 'authfilter']);
$routes->post('/product/(:any)', 'Home::productByIdPost', ['filter' => 'authfilter']);
$routes->delete('/product/(:any)', 'Home::deleteProduct/$1', ['filter' => 'authfilter']);
$routes->get('/create/product', 'Home::createproduct', ['filter' => 'authfilter']);
$routes->post('/create/product', 'Home::createproductPost', ['filter' => 'authfilter']);
$routes->get('/login', 'Home::login');
$routes->get('/logout', 'Home::logout');
$routes->post('/login', 'Home::loginVerif');
$routes->get('/ajax_datatables', 'Home::dataTables', ['filter' => 'tokenfilter']);
