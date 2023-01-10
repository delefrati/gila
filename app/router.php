<?php
use Gila\model\Db;

require __DIR__ . '/vendor/autoload.php';

// Create Router instance
$router = new \Bramus\Router\Router();

$db = new Db($_ENV['DB_DSN'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);


$router->setBasePath('/');
$router->get(
    '/api/user',
    function () use ($db){
        $user_controller = new \Gila\controller\api\UserController($db);
        $user_controller->getAll();
    }
);
$router->get(
    '/api/user/(\d+)',
    function ($id) use ($db) {
        $user_controller = new \Gila\controller\api\UserController($db);
        $user_controller->get($id);
    }
);
$router->get(
    '/api/notification',
    function () use ($db) {
        $notification_controller = new \Gila\controller\api\NotificationController($db);
        $notification_controller->getAll();
    }
);
$router->get(
    '/api/notification/(\d+)',
    function ($id) use ($db) {
        $notification_controller = new \Gila\controller\api\NotificationController($db);
        $notification_controller->get($id);
    }
);
$router->get(
    '/notification/',
    function () use ($db) {
        $notification_controller = new \Gila\controller\NotificationController($db);
        $notification_controller->get();
    }
);

// Run it!
$router->run();