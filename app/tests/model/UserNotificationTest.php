<?php declare(strict_types=1);
use Gila\model\UserNotification;

require_once('Db_base.php');
use Gila\model\User;

final class UserNotificationTest extends Db_base
{
    private $user;
    private $joins;

    static public function setUpBeforeClass() : void
    {
        resetDatabase('user');
        resetDatabase('notification');
        parent::setUpBeforeClass();
    }

    public function setUp(): void {
        parent::setUp();
        $this->user = new UserNotification($this->db);
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
                "type" => "sms",
            ],
            [
                'id' => '2',
                'name' => 'Lorem',
                'email' => 'lorem@lipsum.com',
                'phone_nr' => '+551234567',
                "user" => "1",
                "category" => "2",
                "type" => "sms",
            ],
            [
                'id' => '3',
                'name' => 'Lorem',
                'email' => 'lorem@lipsum.com',
                'phone_nr' => '+551234567',
                "user" => "1",
                "category" => "3",
                "type" => "phone",
            ],
            [
                'id' => '7',
                'name' => 'Lorem',
                'email' => 'lorem@lipsum.com',
                'phone_nr' => '+551234567',
                "user" => "1",
                "category" => "1",
                "type" => "email",
            ],
            [
                'id' => '8',
                'name' => 'Lorem',
                'email' => 'lorem@lipsum.com',
                'phone_nr' => '+551234567',
                "user" => "1",
                "category" => "2",
                "type" => "phone",
            ],
        ];
        $this->assertEquals($expected, $this->user->search(['user.id'=>1], [], $this->joins["left"]));
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
                "type" => "sms",
            ],
            [
                'id' => '2',
                'name' => 'Lorem',
                'email' => 'lorem@lipsum.com',
                'phone_nr' => '+551234567',
                "user" => "1",
                "category" => "2",
                "type" => "sms",
            ],
            [
                'id' => '3',
                'name' => 'Lorem',
                'email' => 'lorem@lipsum.com',
                'phone_nr' => '+551234567',
                "user" => "1",
                "category" => "3",
                "type" => "phone",
            ],
            [
                'id' => '4',
                'name' => 'Ipsum',
                'email' => 'ipsum@lipsum.com',
                'phone_nr' => '+123456789',
                "user" => "2",
                "category" => "2",
                "type" => "email",
            ],
            [
                'id' => '5',
                'name' => 'Ipsum',
                'email' => 'ipsum@lipsum.com',
                'phone_nr' => '+123456789',
                "user" => "2",
                "category" => "3",
                "type" => "sms",
            ],
            [
                'id' => '7',
                'name' => 'Lorem',
                'email' => 'lorem@lipsum.com',
                'phone_nr' => '+551234567',
                "user" => "1",
                "category" => "1",
                "type" => "email",
            ],
            [
                'id' => '8',
                'name' => 'Lorem',
                'email' => 'lorem@lipsum.com',
                'phone_nr' => '+551234567',
                "user" => "1",
                "category" => "2",
                "type" => "phone",
            ],
        ];
        $this->assertEquals($expected, $this->user->getAll());
    }


}