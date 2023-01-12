<?php

namespace Gila\controller\api;
use Gila\model\Category;
use Gila\model\Log;
use Gila\model\Queue;
use Gila\model\NotificationType;
use Gila\model\QueueExecutor;
use Gila\model\Db;
use PHPUnit\Runner\Exception;

class QueueController extends \Gila\controller\ControllerBase
{
    private $queue, $log, $queue_exec;

    public function __construct(Db $db)
    {
        $this->queue = new Queue($db);
        $this->log = new Log($db);
        $this->queue_exec = new QueueExecutor($this->queue, $this->log);
    }

    public function send() : void
    {
        try {
            if (!key_exists('category', $_POST)) {
                throw new Exception('Missing category');
            }
            if (!key_exists('message', $_POST)) {
                throw new Exception('Missing message');
            }
            if (strlen($_POST['message']) <= 0) {
                throw new Exception('Missing message');
            }
            if ($this->queue_exec->generateQueue()) {
                $total = $this->queue_exec->run($_POST['category'], $_POST['message']);
                if ($total === 0) {
                    $msg = 'No users to send';
                } elseif ($total === 1) {
                    $msg = 'Sent for 1 user';
                } else {
                    $msg = sprintf('Sent for %d user(s)', $total);
                }
            } else {
                $msg = 'Queue not generated.';
            }
        } catch (\Exception $e) {
            $msg = $e->getMessage();
        }
        print json_encode(["msg"=>$msg]);
    }


}