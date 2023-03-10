<?php declare(strict_types=1);
use SebastianBergmann\Type\VoidType;

require_once('Db_base.php');
use Gila\model\Category;

final class CategoryTest extends Db_base
{
    private $category;

    static public function setUpBeforeClass() : void
    {
        resetDatabase('category');
        parent::setUpBeforeClass();
    }

    public function setUp(): void {
        parent::setUp();
        $this->category = new Category($this->db);
    }
    public function testGet_bad(): void
    {
        $this->assertEquals([], $this->category->get(0));
    }

    public function testGet_good(): void
    {
        $expected = ["id"=>1, "name"=>"Sports"];
        $this->assertEquals($expected, $this->category->get(1));
    }

    public function testGetAll_good(): void
    {
        $expected = [
            [
                'id' => '1',
                'name' => 'Sports',
            ],
            [
                'id' => '2',
                'name' => 'Finance',
            ],
            [
                'id' => '3',
                'name' => 'Movies',
            ]
        ];
        $this->assertEquals($expected, $this->category->getAll());
    }

    public function testAdd_good(): void
    {
        $id = $this->category->add(["name" => "Name"]);
        $this->assertSame(1, $id);

        $id = $this->category->add(["other" => "extra", "name" => "Extra var"]);
        $this->assertSame(1, $id);

    }

    public function testUpdate_good(): void
    {
        $total = $this->category->update(1, ["name" => "Name"]);
        $this->assertSame(1, $total);
        $total = $this->category->update(2, ["extra"=> "value", "name" => "Name"]);
        $this->assertSame(1, $total);
    }

    public function testUpdate_bad(): void
    {
        $this->expectException(Exception::class);
        $total = $this->category->update(10, ["name" => "Missing"]);
    }

    public function testUpdate_error(): void
    {
        $this->expectException(PDOException::class);
        $total = $this->category->update(3, ["name" => null]);
    }

    public function testDelete_good(): void
    {
        $deleted = $this->category->delete(1);
        $this->assertTrue($deleted);
    }

    public function testDelete_bad(): void
    {
        $deleted = $this->category->delete(10);
        $this->assertFalse($deleted);
    }

}