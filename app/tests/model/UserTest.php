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
        $this->assertSame(4, $id);

        $id = $this->user->add(["other" => "missing", "name" => "Extra var", "email" => "user@domain.test", "phone_nr" => "+12345678"]);
        $this->assertSame(5, $id);

        $id = $this->user->add(["name" => "Missing var", "email" => "user@domain.test"]);
        $this->assertSame(6, $id);
    }

    public function testUpdate_good(): void
    {
        $total = $this->user->update(1, ["name" => "Name", "email" => "user@domain.test", "phone_nr" => "+12345678"]);
        $this->assertSame(1, $total);
        $total = $this->user->update(2, ["extra"=> "value", "name" => "Name", "email" => "user@domain.test", "phone_nr" => "+12345678"]);
        $this->assertSame(1, $total);
        $total = $this->user->update(3, ["name" => "Missing", "email" => "user@domain.test"]);
        $this->assertSame(1, $total);
    }

    public function testUpdate_bad(): void
    {
        $this->expectException(Exception::class);
        $total = $this->user->update(10, ["name" => "Missing", "email" => "user@domain.test", "phone_nr" => "+12345678"]);
        $this->assertSame(1, $total);
    }

    public function testUpdate_error(): void
    {
        $this->expectException(PDOException::class);
        $total = $this->user->update(3, ["name" => "Missing"]);
        $this->assertSame(1, $total);
    }

    public function testDelete_good(): void
    {
        $deleted = $this->user->delete(1);
        $this->assertTrue($deleted);
    }

    public function testDelete_bad(): void
    {
        $deleted = $this->user->delete(10);
        $this->assertFalse($deleted);
    }

}