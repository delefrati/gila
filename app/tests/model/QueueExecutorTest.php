<?php declare(strict_types=1);

require_once('Db_base.php');
use Gila\model\QueueExecutor;
use Gila\model\Queue;
use Gila\model\Log;

final class QueueExecutorTest extends Db_base
{
    private $log;
    private $queue;
    private $queue_exec;



    public function setUp(): void {
        parent::setUp();

        resetDatabase('notification');
        resetDatabase('user');
        resetDatabase('category');
        resetDatabase('queue');
        resetDatabase('message');
        resetDatabase('log');

        $this->queue = new Queue($this->db);
        $this->log = new Log($this->db);

        $this->queue_exec = new QueueExecutor($this->queue, $this->log);
    }

    public function testGenerateQueue_good() : void
    {
        $this->assertTrue($this->queue_exec->generateQueue());
        $all = $this->queue->getAll();
        $this->assertEquals(5, count($all));
    }

    /**
     * @depends testGenerateQueue_good
     */
    public function testRun_good() : void
    {
        $all = $this->queue->getAll();
        $this->assertEquals(5, count($all));

        $this->assertEquals(5, $this->queue_exec->run());
        $logs = $this->log->getAll();
        $clear_logs = [];
        foreach ($logs as $log) {
            $clear_logs[] = $log['log'];
        }
        $logs_expected = [
          'Message sent via {sms} for {Lorem} - Category: {Sports}',
          'Message sent via {sms} for {Lorem} - Category: {Finance}',
          'Message sent via {email} for {Lorem} - Category: {Sports}',
          'Message sent via {phone} for {Lorem} - Category: {Finance}',
          'Message sent via {email} for {Ipsum} - Category: {Finance}',
        ];
        sort($clear_logs);
        sort($logs_expected);
        $this->assertEquals($logs_expected, $clear_logs);
        $all = $this->queue->getAll();
        $this->assertEquals(0, count($all));
    }
}