<?php

namespace Gila\controller;
use Gila\model\Notification;
use Gila\model\Db;

class NotificationController extends \Gila\controller\ControllerBase
{
    private $notification;

    public function __construct(Db $db)
    {
        $this->notification = new Notification($db);
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