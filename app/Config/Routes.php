<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setAutoRoute(false);
$routes->get('/', 'Home::index');

service('auth')->routes($routes);
