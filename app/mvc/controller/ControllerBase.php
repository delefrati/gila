<?php

namespace Gila\controller;

use Gila\model\Db;

class ControllerBase
{
    protected $db;
    public function __construct(Db $db)
    {
        $this->db = $db;
    }
}