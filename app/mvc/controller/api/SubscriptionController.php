<?php

namespace Gila\controller\api;
use Gila\model\Category;
use Gila\model\NotificationType;
use Gila\model\User;
use Gila\model\Db;

class SubscriptionController extends \Gila\controller\ControllerBase
{
    private $user, $category, $notification_type;

    public function __construct(Db $db)
    {
        $this->user = new User($db);
        $this->category = new Category($db);
        $this->notification_type = new NotificationType($db);
    }

    public function getData() : void
    {
        print json_encode([
            "users" => $this->user->getAll(['id', 'name']),
            "categories" => $this->category->getAll(),
            "channels" => $this->notification_type->getAll(),
        ]);
    }

}