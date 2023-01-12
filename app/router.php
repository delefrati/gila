<?php
use Gila\model\Db;

require __DIR__ . '/vendor/autoload.php';

header('Access-Control-Allow-Methods', 'HEAD, GET, POST, PUT, PATCH, DELETE, OPTIONS');
header('Access-Control-Allow-Headers', 'Access-Control-Request-Headers');
header("Access-Control-Allow-Origin: *");


// Create Router instance
$router = new \Bramus\Router\Router();

$db = new Db($_ENV['DB_DSN'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);


$router->setBasePath('/');
$router->get(
    '/api/user',
    function () use ($db){
        $controller = new \Gila\controller\api\UserController($db);
        $controller->getAll();
    }
);
$router->get(
    '/api/user/(\d+)',
    function ($id) use ($db) {
        $controller = new \Gila\controller\api\UserController($db);
        $controller->get($id);
    }
);
$router->get(
    '/api/notification',
    function () use ($db) {
        $controller = new \Gila\controller\api\NotificationController($db);
        $controller->getAll();
    }
);
$router->get(
    '/api/notification/(\d+)',
    function ($id) use ($db) {
        $controller = new \Gila\controller\api\NotificationController($db);
        $controller->get($id);
    }
);
$router->get(
    '/subscription/',
    function () use ($db) {
        $controller = new \Gila\controller\api\SubscriptionController($db);
        $controller->getData();
    }
);
$router->post(
    '/subscription/',
    function () use ($db) {
        $controller = new \Gila\controller\api\SubscriptionController($db);
        $controller->record();
    }
);
$router->post(
    '/send/',
    function () use ($db) {
        $controller = new \Gila\controller\api\QueueController($db);
        $controller->send();
    }
);

// Run it!
$router->run();