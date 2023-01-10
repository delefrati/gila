<?php declare(strict_types=1);
use Gila\model\UserNotification;

require_once('Db_base.php');
use Gila\model\User;

final class UserNotificationTest extends Db_base
{
    private $user;
    private $joins;

    public function setUp(): void {
        $db = $this->mockDb();
        $this->user = new UserNotification($db);
    }
    public function testSearch_good(): void
    {
        $expected = [

            [
                'id' => '1',
                'name' => 'Lorem',
                'email' => 'lorem@lipsum.com',
                'phone_nr' => '+551234567',
                "user" => "1",
                "category" => "1",
                "by_sms" => "1",
                "by_email" => null,
                "by_notification" => null,
            ],
            [
                'id' => '2',
                'name' => 'Lorem',
                'email' => 'lorem@lipsum.com',
                'phone_nr' => '+551234567',
                "user" => "1",
                "category" => "2",
                "by_sms" => "1",
                "by_email" => "1",
                "by_notification" => null,
            ],
            [
                'id' => '3',
                'name' => 'Lorem',
                'email' => 'lorem@lipsum.com',
                'phone_nr' => '+551234567',
                "user" => "1",
                "category" => "3",
                "by_sms" => "1",
                "by_email" => "1",
                "by_notification" => "1",
            ],
        ];
        $this->assertEquals($expected, $this->user->search(['user.id'=>1], $this->joins["left"]));
    }

    public function testGetAll_good(): void
    {
        $expected = [
            [
                'id' => '1',
                'name' => 'Lorem',
                'email' => 'lorem@lipsum.com',
                'phone_nr' => '+551234567',
                "user" => "1",
                "category" => "1",
                "by_sms" => "1",
                "by_email" => null,
                "by_notification" => null,
            ],
            [
                'id' => '2',
                'name' => 'Lorem',
                'email' => 'lorem@lipsum.com',
                'phone_nr' => '+551234567',
                "user" => "1",
                "category" => "2",
                "by_sms" => "1",
                "by_email" => "1",
                "by_notification" => null,
            ],
            [
                'id' => '3',
                'name' => 'Lorem',
                'email' => 'lorem@lipsum.com',
                'phone_nr' => '+551234567',
                "user" => "1",
                "category" => "3",
                "by_sms" => "1",
                "by_email" => "1",
                "by_notification" => "1",
            ],
            [
                'id' => '4',
                'name' => 'Ipsum',
                'email' => 'ipsum@lipsum.com',
                'phone_nr' => '+123456789',
                "user" => "2",
                "category" => "2",
                "by_sms" => null,
                "by_email" => "1",
                "by_notification" => null,
            ],
            [
                'id' => '5',
                'name' => 'Ipsum',
                'email' => 'ipsum@lipsum.com',
                'phone_nr' => '+123456789',
                "user" => "2",
                "category" => "3",
                "by_sms" => null,
                "by_email" => null,
                "by_notification" => "1",
            ],
        ];
        $this->assertEquals($this->user->getAll($this->joins["left"]), $expected);
    }
    public function testGetAll_INNER_good(): void
    {
        $expected = [
            [
                'id' => '1',
                'name' => 'Lorem',
                'email' => 'lorem@lipsum.com',
                'phone_nr' => '+551234567',
                "user" => "1",
                "category" => "1",
                "by_sms" => "1",
                "by_email" => null,
                "by_notification" => null,
            ],
            [
                'id' => '2',
                'name' => 'Lorem',
                'email' => 'lorem@lipsum.com',
                'phone_nr' => '+551234567',
                "user" => "1",
                "category" => "2",
                "by_sms" => "1",
                "by_email" => "1",
                "by_notification" => null,
            ],
            [
                'id' => '3',
                'name' => 'Lorem',
                'email' => 'lorem@lipsum.com',
                'phone_nr' => '+551234567',
                "user" => "1",
                "category" => "3",
                "by_sms" => "1",
                "by_email" => "1",
                "by_notification" => "1",
            ],
            [
                'id' => '4',
                'name' => 'Ipsum',
                'email' => 'ipsum@lipsum.com',
                'phone_nr' => '+123456789',
                "user" => "2",
                "category" => "2",
                "by_sms" => null,
                "by_email" => "1",
                "by_notification" => null,
            ],
            [
                'id' => '5',
                'name' => 'Ipsum',
                'email' => 'ipsum@lipsum.com',
                'phone_nr' => '+123456789',
                "user" => "2",
                "category" => "3",
                "by_sms" => null,
                "by_email" => null,
                "by_notification" => "1",
            ],
        ];
        $this->assertEquals($this->user->getAll($this->joins["inner"]), $expected);
    }

}