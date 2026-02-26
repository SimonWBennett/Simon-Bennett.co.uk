<?php

use App\Controllers\Blog;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setAutoRoute(false);
$routes->get('/', 'Home::index');

$routes->group('blog', static function (RouteCollection $routes) {
    $routes->get('', [Blog::class, 'index']);
    $routes->get('new', [Blog::class, 'new']);
    $routes->get('edit/(:num)', [Blog::class, 'edit/$1']);
    $routes->get('(:segment)', [Blog::class, 'show/$1']);
    $routes->post('create', [Blog::class, 'create']);
    $routes->post('update/(:num)', [Blog::class, 'update/$1']);
    $routes->post('delete/(:num)', [Blog::class, 'delete/$1']);
});

service('auth')->routes($routes);
