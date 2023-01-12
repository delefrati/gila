<?php

namespace Gila\model;

class QueueExecutor {
    private $queue;
    private $log;
    public function __construct(Queue $queue, Log $log)
    {
        $this->queue = $queue;
        $this->log = $log;
    }

	public function generateQueue() : bool
	{
        $this->log('Generating new queue');
        $cmd = sprintf('CALL `gila`.`sp_fill_queue`()');
		return $this->queue->exec($cmd, []);
	}

    public function run(int $category, string $message, int $limit=10000) : int
    {
        $total_executed = 0;

        for ($i=0; $i<=$limit; $i++) {
            $rs = $this->queue->getFirst(['category_id' => $category]);
            if (!is_array($rs) || count($rs) <= 0) {
                break;
            }
            $id = $rs['id'];
            if ($this->send($rs['notification_type'], $rs['category'], $rs['name'], $rs['email'], $rs['phone_nr'], $message)) {
                $this->queue->delete($id);
                $total_executed++;
            } else {
                $this->queue->update($id, ['qstatus' => 'ERROR']);
            }

        }
        return $total_executed;
    }
    private function send(string $type, string $category, string $name, string $email, string $phone_nr, string $template) : bool
    {
        $template = str_replace('{name}', $name, $template);
        $template = str_replace('{category}', $category, $template);
        $message = $template;
        $sent = false;
        if ($type === 'sms') {
            $sent = $this->sendSMS($phone_nr, $message);
        } elseif ($type === 'phone') {
            $sent = $this->sendNotification($phone_nr, $message);
        } elseif ($type === 'email') {
            $sent = $this->sendEmail($email, $message);
        }
        if ($sent) {
            $this->log(sprintf('Message sent via {%s} for {%s} - Category: {%s}', $type, $name, $category));
        }
        return ($sent > 0);
    }

    private function sendSMS($phone_nr, $message) : bool
    {
        //mocked function
        return true;
    }
    private function sendNotification($phone_nr, $message) : bool
    {
        //mocked function
        return true;
    }
    private function sendEmail($email, $message) : bool
    {
        //mocked function
        return true;
    }
    private function log($message) : int
    {
        return $this->log->add(['log'=>$message, 'date'=>date('Y-m-d H:i:s')]);
    }
}