<?php

use DI\ContainerBuilder;
use League\Plates\Engine;
use Delight\Auth\Auth;
use Aura\SqlQuery\QueryFactory;

$containerBuilder = new ContainerBuilder;
$containerBuilder->addDefinitions([
    Engine::class => function() {
        return new Engine('../app/Views');
    },
    PDO::class => function() {
        $driver = config('database.driver');
        $host = config('database.host');
        $database_name = config('database.database_name');
        $username = config('database.username');
        $password = config('database.password');

        return new PDO("$driver:host=$host;dbname=$database_name", $username, $password);
    },
    Auth::class => function($container) {
        return new Auth($container->get('PDO'));
    },
    QueryFactory::class => function() {
        return new QueryFactory('mysql');
    }
]);

$container = $containerBuilder->build();

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
  $r->get('/', ['App\Controllers\Home', 'home']);
  $r->get('/about', ['App\Controllers\Home', 'about']);
  $r->get('/contact', ['App\Controllers\Home', 'contact']);
  $r->post('/contact', ['App\Controllers\Home', 'letstalk']);
  $r->get('/in', ['App\Controllers\AdCook', 'in']);
  $r->post('/in', ['App\Controllers\AdCook', 'do']);

  $r->addGroup('/shop', function (FastRoute\RouteCollector $r) {
    $r->get('', ['App\Controllers\Shop', 'shop']);
    $r->get('/product/{id:\d+}', ['App\Controllers\Shop', 'info']);
    $r->get('/product/{id:\d+}/like', ['App\Controllers\MustLogin', 'like']);
    $r->get('/actions/{id:\d+}', ['App\Controllers\MustLogin', 'actions']);
    $r->post('/product/comment', ['App\Controllers\Shop', 'comment']);
  });

  $r->get('/registration', ['App\Controllers\Register', 'registration']);
  $r->post('/registration', ['App\Controllers\Register', 'signin']);
  $r->get('/authorization', ['App\Controllers\Register', 'authorization']);
  $r->post('/authorization', ['App\Controllers\Register', 'login']);
  $r->get('/logout', ['App\Controllers\\Register', 'logout']);

  $r->addGroup('/profile', function (FastRoute\RouteCollector $r) {
    $r->get('', ['App\Controllers\Profile', 'profile']);
    $r->post('', ['App\Controllers\Profile', 'saveSettings']);
    $r->post('/saveAva', ['App\Controllers\Profile', 'saveAva']);

    $r->get('/cart/{username}', ['App\Controllers\Profile', 'cart']);
    $r->get('/cart/rm/{id:\d+}&{userId:\d+}', ['App\Controllers\Profile', 'rmproduct']);
    $r->post('/cart/checkout', ['App\Controllers\Profile', 'checkout']);

  });







  $r->addGroup('/admin', function (FastRoute\RouteCollector $r) {
    $r->get('', ['App\Controllers\Admin\Main', 'index']);

    $r->get('/products', ['App\Controllers\Admin\Products', 'products']);
    $r->post('/product/updateCategory/{id:\d+}', ['App\Controllers\Admin\Products', 'updateCategory']);
    $r->post('/product/updateBrand/{id:\d+}', ['App\Controllers\Admin\Products', 'updateBrand']);
    $r->post('/product/updateImage/{id:\d+}', ['App\Controllers\Admin\Products', 'updateImage']);
    $r->post('/products/addDataFile', ['App\Controllers\Admin\Products', 'addDataFile']);
    $r->get('/product/add', ['App\Controllers\Admin\Products', 'add']);
    $r->get('/product/public/{id:\d+}', ['App\Controllers\Admin\Products', 'public']);
    $r->get('/product/info/{id:\d+}', ['App\Controllers\Admin\Products', 'info']);
    $r->post('/product/add', ['App\Controllers\Admin\Products', 'create']);
    $r->get('/product/edit/{id:\d+}', ['App\Controllers\Admin\Products', 'edit']);
    $r->post('/product/edit/{id:\d+}', ['App\Controllers\Admin\Products', 'update']);
    $r->get('/product/remove/{id:\d+}', ['App\Controllers\Admin\Products', 'remove']);

    $r->get('/categories', ['App\Controllers\Admin\Categories', 'categories']);
    $r->get('/category/add', ['App\Controllers\Admin\Categories', 'add']);
    $r->post('/category/add', ['App\Controllers\Admin\Categories', 'create']);
    $r->get('/category/edit/{id:\d+}', ['App\Controllers\Admin\Categories', 'edit']);
    $r->post('/category/edit/{id:\d+}', ['App\Controllers\Admin\Categories', 'update']);
    $r->get('/category/remove/{id:\d+}', ['App\Controllers\Admin\Categories', 'remove']);

    $r->get('/brands', ['App\Controllers\Admin\Brands', 'brands']);
    $r->get('/brand/add', ['App\Controllers\Admin\Brands', 'add']);
    $r->post('/brand/add', ['App\Controllers\Admin\Brands', 'create']);
    $r->get('/brand/edit/{id:\d+}', ['App\Controllers\Admin\Brands', 'edit']);
    $r->post('/brand/edit/{id:\d+}', ['App\Controllers\Admin\Brands', 'update']);
    $r->get('/brand/remove/{id:\d+}', ['App\Controllers\Admin\Brands', 'remove']);

    $r->get('/users', ['App\Controllers\Admin\Users', 'users']);
    $r->get('/user/add', ['App\Controllers\Admin\Users', 'add']);
    $r->post('/user/add', ['App\Controllers\Admin\Users', 'create']);
    $r->get('/user/info/{id:\d+}', ['App\Controllers\Admin\Users', 'info']);
    $r->get('/user/edit/{id:\d+}', ['App\Controllers\Admin\Users', 'edit']);
    $r->post('/user/edit/{id:\d+}', ['App\Controllers\Admin\Users', 'update']);
    $r->get('/user/chstatus/{id:\d+}', ['App\Controllers\Admin\Users', 'chstatus']);
    $r->get('/user/delete/{id:\d+}', ['App\Controllers\Admin\Users', 'remove']);

    $r->get('/banners', ['App\Controllers\Admin\Banners', 'banners']);
    $r->get('/banner/public/{id:\d+}', ['App\Controllers\Admin\Banners', 'public']);
    $r->get('/banner/add', ['App\Controllers\Admin\Banners', 'add']);
    $r->post('/banner/add', ['App\Controllers\Admin\Banners', 'create']);
    $r->get('/banner/edit/{id:\d+}', ['App\Controllers\Admin\Banners', 'edit']);
    $r->post('/banner/edit/{id:\d+}', ['App\Controllers\Admin\Banners', 'update']);
    $r->get('/banner/remove/{id:\d+}', ['App\Controllers\Admin\Banners', 'remove']);

    $r->get('/support', ['App\Controllers\Admin\Support', 'support']);
    $r->get('/support/changestatus/{id:\d+}', ['App\Controllers\Admin\Support', 'changestatus']);
    $r->get('/sup/info/{id:\d+}', ['App\Controllers\Admin\Support', 'info']);
    $r->post('/sup/info/{id:\d+}/answer', ['App\Controllers\Admin\Support', 'answer']);
    $r->get('/sup/edit/{id:\d+}', ['App\Controllers\Admin\Support', 'edit']);
    $r->post('/sup/update/{id:\d+}', ['App\Controllers\Admin\Support', 'update']);
    $r->get('/sup/remove/{id:\d+}', ['App\Controllers\Admin\Support', 'remove']);
  });

});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
  $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
  case FastRoute\Dispatcher::NOT_FOUND:
    abort(404);
    break;
  case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
    $allowedMethods = $routeInfo[1];
    abort(405);
    break;
  case FastRoute\Dispatcher::FOUND:
    $handler = $routeInfo[1];
    $vars = $routeInfo[2];
    $container->call($handler, $vars);
    break;
}


?>
