<?php

namespace Gila\controller\api;
use Gila\model\Notification;
use Gila\model\User;
use Gila\model\Db;
use Gila\model\UserNotification;

class UserController extends \Gila\controller\ControllerBase
{
    private $user;

    public function __construct(Db $db)
    {
        $this->user = new UserNotification($db);
    }
    public function getAll() : void
    {
        print json_encode($this->user->getAll());
    }
    public function get($id) : void
    {
        $user = $this->user->search(["user.id"=>$id]);
        print json_encode($user);
    }

}