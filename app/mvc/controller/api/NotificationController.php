<?php

namespace Gila\controller\api;
use Gila\model\UserNotification;
use Gila\model\Db;

class NotificationController extends \Gila\controller\ControllerBase
{
    private $notification;

    public function __construct(Db $db)
    {
        $this->notification = new UserNotification($db);
    }
    public function getAll() : void
    {
        print json_encode($this->notification->getAll());
    }
    public function get($id) : void
    {
        print json_encode($this->notification->get($id));
    }

}