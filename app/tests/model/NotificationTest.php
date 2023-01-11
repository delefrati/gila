<?php declare(strict_types=1);
use Gila\model\Notification;

require_once('Db_base.php');

final class NotificationTest extends Db_base
{
    private $notification;

    static public function setUpBeforeClass() : void
    {
        resetDatabase('user');
        resetDatabase('category');
        resetDatabase('notification');
        resetDatabase('notification_type');
        parent::setUpBeforeClass();
    }
    public function setUp(): void
    {
        parent::setUp();
        $this->notification = new Notification($this->db);
    }

    public function testGet_bad(): void
    {
        $this->assertEquals($this->notification->get(0), []);
    }

    public function testGet_good(): void
    {
        $expected = [
            "id" => 1,
            "user" => 1,
            "category" => 1,
            "type" => 'sms',
        ];
        $this->assertEquals($this->notification->get(1), $expected);
    }
    public function testGetAll_good(): void
    {
        $expected = [
            [
                "id" => 1,
                "user" => 1,
                "category" => 1,
                "type" => 'sms',
            ],
            [
                'id' => 2,
                'user' => 1,
                'category' => 2,
                "type" => 'sms',
            ],
            [
                'id' => 3,
                'user' => 1,
                'category' => 3,
                "type" => 'phone',
            ],
            [
                'id' => 4,
                'user' => 2,
                'category' => 2,
                "type" => 'email',
            ],
            [
                'id' => 5,
                'user' => 2,
                'category' => 3,
                "type" => 'sms',
            ],
            [
                'id' => 7,
                'user' => 1,
                'category' => 1,
                "type" => 'email',
            ],
            [
                'id' => 8,
                'user' => 1,
                'category' => 2,
                "type" => 'phone',
            ]
        ];
        $this->assertEquals($this->notification->getAll(), $expected);
    }

    public function testAdd_good(): void
    {
        $id = $this->notification->add(["user" => "3", "category" => "2", "type" => "sms"]);
        $this->assertSame(1, $id);

        $id = $this->notification->add(["user" => "3", "category" => "1", "type" => "phone"]);
        $this->assertSame(1, $id);

        $id = $this->notification->add(["user" => "3", "category" => "3", "type" => "phone"]);
        $this->assertSame(1, $id);
    }

    public function testUpdate_good(): void
    {
        $total = $this->notification->update(1, ["user" => "1", "category" => "3"]);
        $this->assertSame(1, $total);
        $total = $this->notification->update(2, ["user"=> "1"]);
        $this->assertSame(1, $total);
    }

    public function testUpdate_bad(): void
    {
        $this->expectException(Exception::class);
        $total = $this->notification->update(10, ["name" => "Missing", "email" => "user@domain.test", "phone_nr" => "+12345678"]);
    }

    public function testUpdate_error(): void
    {
        $this->expectException(PDOException::class);
        $total = $this->notification->update(3, ["name" => "Missing"]);
    }

    public function testDelete_good(): void
    {
        $deleted = $this->notification->delete(1);
        $this->assertTrue($deleted);
    }

    public function testDelete_bad(): void
    {
        $deleted = $this->notification->delete(2);
        $this->assertTrue($deleted);
        $deleted = $this->notification->delete(2);
        $this->assertFalse($deleted);
    }

}