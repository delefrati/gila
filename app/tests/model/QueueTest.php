<?php declare(strict_types=1);

require_once('Db_base.php');
use Gila\model\Queue;

final class QueueTest extends Db_base
{
    private $queue;

    static public function setUpBeforeClass(): void
    {
        resetDatabase('user');
        resetDatabase('category');
        resetDatabase('queue');
        resetDatabase('message');
        parent::setUpBeforeClass();
    }
    public function setUp(): void
    {
        parent::setUp();
        $this->queue = new Queue($this->db);
    }

    public function testGet_good(): void
    {
        $expected = [
            "id" => "1",
            "name" => "Lorem",
            "email" => "lorem@lipsum.com",
            "phone_nr" => "+551234567",
            "category" => "Sports",
            "template" => "This is a message for Sports.",
            "notification_type" => "sms",
            "date_queued" => date("Y-m-d") . " 00:00:00",
            "qstatus" => "WAIT",
        ];

        $this->assertEquals($expected, $this->queue->get(1));
    }
    public function testGetAll_good(): void
    {
        $expected = [
            [
                "id" => "1",
                "name" => "Lorem",
                "email" => "lorem@lipsum.com",
                "phone_nr" => "+551234567",
                "category" => "Sports",
                "template" => "This is a message for Sports.",
                "notification_type" => "sms",
                "date_queued" => date("Y-m-d") . " 00:00:00",
                "qstatus" => "WAIT",
            ],
            [
                "id" => "2",
                "name" => "Lorem",
                "email" => "lorem@lipsum.com",
                "phone_nr" => "+551234567",
                "category" => "Finance",
                "template" => "This is a message for Finance.",
                "notification_type" => "sms",
                "date_queued" => date("Y-m-d") . " 00:00:00",
                "qstatus" => "WAIT",
            ],
            [
                "id" => "3",
                "name" => "Lorem",
                "email" => "lorem@lipsum.com",
                "phone_nr" => "+551234567",
                "category" => "Sports",
                "template" => "This is a message for Sports.",
                "notification_type" => "email",
                "date_queued" => date("Y-m-d") . " 00:00:00",
                "qstatus" => "WAIT",
            ],
            [
                "id" => "4",
                "name" => "Lorem",
                "email" => "lorem@lipsum.com",
                "phone_nr" => "+551234567",
                "category" => "Finance",
                "template" => "This is a message for Finance.",
                "notification_type" => "phone",
                "date_queued" => date("Y-m-d") . " 00:00:00",
                "qstatus" => "WAIT",
            ],
            [
                "id" => "5",
                "name" => "Ipsum",
                "email" => "ipsum@lipsum.com",
                "phone_nr" => "+123456789",
                "category" => "Finance",
                "template" => "This is a message for Finance.",
                "notification_type" => "email",
                "date_queued" => date("Y-m-d") . " 00:00:00",
                "qstatus" => "WAIT",
            ]
        ];
        $this->assertEquals($expected, $this->queue->getAll());
    }
}