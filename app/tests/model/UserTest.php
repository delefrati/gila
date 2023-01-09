<?php declare(strict_types=1);
use SebastianBergmann\Type\VoidType;

require_once('Db_base.php');
use PHPUnit\Framework\TestCase;
use Gila\model\User;

final class User_test extends Db_base
{
    private $user;
    public function setUp(): void {
        $db = $this->mockDb();
        $this->user = new User($db);
    }
    public function testGet_bad(): void
    {
        $this->assertEquals($this->user->get(0), []);
    }

    public function testGet_good(): void
    {
        $expected = ["id"=>1, "name"=>"Lorem", "email"=>"lorem@lipsum.com", "phone_nr"=>"+551234567"];
        $this->assertEquals($this->user->get(1), $expected);
    }
    public function testGetAll_good(): void
    {
        $expected = [
            [
                'id' => '1',
                'name' => 'Lorem',
                'email' => 'lorem@lipsum.com',
                'phone_nr' => '+551234567',
            ],
            [
                'id' => '2',
                'name' => 'Ipsum',
                'email' => 'ipsum@lipsum.com',
                'phone_nr' => '+123456789',
            ],
            [
                'id' => '3',
                'name' => 'Lipsum',
                'email' => 'lipsum@lipsum.org',
                'phone_nr' => '+2121212',
            ]
        ];
        $this->assertEquals($this->user->getAll(), $expected);
    }

    public function testAdd_good(): void 
    {
        $id = $this->user->add(["name" => "Name", "email" => "user@domain.test", "phone_nr" => "+12345678"]);
        $this->assertGreaterThan(0, $id);
    }

}