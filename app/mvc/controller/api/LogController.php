<?php

namespace Gila\controller\api;
use Gila\model\Log;
use Gila\model\Db;

class LogController extends \Gila\controller\ControllerBase
{
    private $log;

    public function __construct(Db $db)
    {
        $this->log = new Log($db);
    }
    public function getAll() : void
    {
        print json_encode($this->log->getAll());
    }
}