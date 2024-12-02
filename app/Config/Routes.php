<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'User::index');
$routes->get('/admin', 'Admin::index', ['filter' => 'role:admin']);
$routes->get('/admin/index', 'Admin::index', ['filter' => 'role:admin']);
$routes->get('/user', 'User::index');
$routes->get('/admin/(:num)', 'Admin::detail/$1', ['filter' => 'role:admin']);
$routes->setAutoRoute(true);
$routes->get('/modules', 'Module::index', ['filter' => 'role:admin,Pelatih']);
$routes->get('/modules_user', 'Module::index_user');
$routes->get('/modules_user/view/(:num)', 'Module::view_user/$1');
$routes->get('/modules/create', 'Module::create', ['filter' => 'role:admin,Pelatih']);
$routes->post('/modules/store', 'Module::store', ['filter' => 'role:admin,Pelatih']);
$routes->get('/modules/edit/(:num)', 'Module::edit/$1', ['filter' => 'role:admin,Pelatih']);
$routes->post('/modules/update/(:num)', 'Module::update/$1', ['filter' => 'role:admin,Pelatih']);
$routes->get('/modules/delete/(:num)', 'Module::delete/$1', ['filter' => 'role:admin,Pelatih']);
$routes->get('/grafik', 'ChartController::index');
$routes->get('question/(:segment)', 'Question::index/$1', ['filter' => 'role:admin,Pelatih']);
$routes->post('question/(:segment)/create', 'Question::create/$1', ['filter' => 'role:admin,Pelatih']);
$routes->get('question/(:segment)/edit/(:num)', 'Question::edit/$1', ['filter' => 'role:admin,Pelatih']);
$routes->post('question/(:num)/update', 'Question::update/$1', ['filter' => 'role:admin,Pelatih']);
$routes->get('question/(:num)/delete', 'Question::delete/$1', ['filter' => 'role:admin,Pelatih']);

$routes->post('answer/(:num)/create', 'Answer::create/$1', ['filter' => 'role:admin,Pelatih']);
$routes->get('answer/(:num)/edit/(:num)', 'Answer::edit/$1', ['filter' => 'role:admin,Pelatih']);
$routes->post('answer/(:num)/update', 'Answer::update/$1', ['filter' => 'role:admin,Pelatih']);
$routes->get('answer/(:num)/delete', 'Answer::delete/$1', ['filter' => 'role:admin,Pelatih']);
$routes->get('/calendar', 'Calendar::index');
$routes->post('/calendar/addEvent', 'Calendar::addEvent', ['filter' => 'role:admin,Pelatih']);
$routes->get('/module/pretest/(:num)', 'Module::pretest/$1', ['filter' => 'role:Peserta Pelatihan']);
$routes->post('/module/submit/(:num)', 'Module::submitPretest/$1', ['role:Peserta Pelatihan']);
$routes->post('user/update/(:num)', 'User::update/$1');
// File: app/Config/Routes.php
$routes->get('/rankings', 'RankingController::index', ['filter' => 'role:admin,Pelatih']);

$routes->get('/users', 'UserManagement::index', ['filter' => 'role:admin']);
$routes->get('/users/create', 'UserManagement::create', ['filter' => 'role:admin']);
$routes->post('/users/store', 'UserManagement::store', ['filter' => 'role:admin']);
$routes->get('/users/edit/(:num)', 'UserManagement::edit/$1', ['filter' => 'role:admin']);
$routes->post('/users/update/(:num)', 'UserManagement::update/$1', ['filter' => 'role:admin']);
$routes->get('/users/delete/(:num)', 'UserManagement::delete/$1', ['filter' => 'role:admin']);
$routes->get('users/edit/(:num)', 'UserManagement::edit/$1', ['filter' => 'role:admin']);
$routes->post('users/update/(:num)', 'UserManagement::update/$1', ['filter' => 'role:admin']);
