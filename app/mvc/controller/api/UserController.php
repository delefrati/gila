<?php

namespace Gila\controller\api;
use Gila\model\Notification;
use Gila\model\User;
use Gila\model\Db;

class UserController extends \Gila\controller\ControllerBase
{
    private $user;

    public function __construct(Db $db)
    {
        $this->user = new User($db);
    }
    public function getAll() : void
    {
        print json_encode($this->user->getAll());
    }
    public function get($id) : void
    {
        $user = $this->user->get($id);
        print json_encode($user);
    }

    private function getNotifications($id) : array
    {
        $notification = new Notification($this->db);
        $notification->search(['user'=>$id]);
    }

}