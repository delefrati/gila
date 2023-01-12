<?php

namespace Gila\controller\api;
use Gila\model\Category;
use Gila\model\Notification;
use Gila\model\NotificationType;
use Gila\model\User;
use Gila\model\Db;

class SubscriptionController extends \Gila\controller\ControllerBase
{
    private $notification, $user, $category, $notification_type, $subscription;

    public function __construct(Db $db)
    {
        $this->notification = new Notification($db);
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

    public function record() : void
    {
        try {
            $this->notification->add([
                'user' => $_POST['user'],
                'category' => $_POST['category'],
                'type' => $_POST['type'],
            ]);
            $msg = "Recorded";
        } catch (\Exception $e) {
            $msg = $e->getMessage();
        }
        print json_encode(["msg"=>$msg]);
    }

}