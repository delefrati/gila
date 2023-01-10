<?php declare(strict_types=1);
use Gila\model\Notification;

require_once('Db_base.php');

final class NotificationTest extends Db_base
{
    private $notification;

    public function setUp(): void {
        $db = $this->mockDb();
        $this->notification = new Notification($db);
    }

    static public function setUpBeforeClass() : void
    {
        resetDatabase();
    }
    public function testGet_bad(): void
    {
        $this->assertEquals($this->notification->get(0), []);
    }

    public function testGet_good(): void
    {
        $expected = ["id"=>1, "user"=>1, "category"=>1, "by_sms"=>true, "by_email"=>false, "by_notification"=>false];
        $this->assertEquals($this->notification->get(1), $expected);
    }
    public function testGetAll_good(): void
    {
        $expected = [
            [
                'id' => 1,
                'user' => 1,
                'category' => 1,
                'by_sms' => true,
                'by_email' => false,
                'by_notification' => false,
            ],
            [
                'id' => 2,
                'user' => 1,
                'category' => 2,
                'by_sms' => true,
                'by_email' => true,
                'by_notification' => false,
            ],
            [
                'id' => 3,
                'user' => 1,
                'category' => 3,
                'by_sms' => true,
                'by_email' => true,
                'by_notification' => true,
            ],
            [
                'id' => 4,
                'user' => 2,
                'category' => 2,
                'by_sms' => false,
                'by_email' => true,
                'by_notification' => false,
            ],
            [
                'id' => 5,
                'user' => 2,
                'category' => 3,
                'by_sms' => false,
                'by_email' => false,
                'by_notification' => true,
            ]
        ];
        $this->assertEquals($this->notification->getAll(), $expected);
    }

    public function testAdd_good(): void
    {
        $id = $this->notification->add(["user" => "3", "category" => "2", "by_sms" => "1", "by_email"=>true, "by_notification"=>0]);
        $this->assertSame(1, $id);


        $id = $this->notification->add(["user" => "3", "category" => "1", "by_sms" => true]);
        $this->assertSame(1, $id);

        $id = $this->notification->add(["user" => "3", "category" => "3"]);
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
        $deleted = $this->notification->delete(10);
        $this->assertFalse($deleted);
    }

}