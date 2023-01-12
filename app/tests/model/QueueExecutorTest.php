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
        resetDatabase('log');

        $this->queue = new Queue($this->db);
        $this->log = new Log($this->db);

        $this->queue_exec = new QueueExecutor($this->queue, $this->log);
    }

    public function testGenerateQueue_good() : void
    {
        $this->assertTrue($this->queue_exec->generateQueue());
        $all = $this->queue->getAll();
        $this->assertEquals(7, count($all));
    }

    public function testRun_good() : void
    {

        $this->assertTrue($this->queue_exec->generateQueue());
        $all = $this->queue->getAll();
        $this->assertEquals(7, count($all));

        $this->assertEquals(2, $this->queue_exec->run(1, 'Message'));
        $this->assertEquals(0, $this->queue_exec->run(1, 'Message'));
        $this->assertEquals(2, $this->queue_exec->run(3, 'Message'));
        $logs = $this->log->getAll();
        $clear_logs = [];
        foreach ($logs as $log) {
            $clear_logs[] = $log['log'];
        }
        $logs_expected = [
            'Generating new queue',
            'Message sent via {sms} for {Lorem} - Category: {Sports}',
            'Message sent via {email} for {Lorem} - Category: {Sports}',
            'Message sent via {phone} for {Lorem} - Category: {Movies}',
            'Message sent via {sms} for {Ipsum} - Category: {Movies}',
        ];
        sort($clear_logs);
        sort($logs_expected);
        $this->assertEquals($logs_expected, $clear_logs);
        $all = $this->queue->getAll();
        $this->assertEquals(3, count($all));
    }
}