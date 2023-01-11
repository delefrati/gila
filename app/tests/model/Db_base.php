<?php declare(strict_types=1);
require_once('/opt/app/vendor/autoload.php');

use PHPUnit\Framework\TestCase;
use Gila\model\Db;

abstract class Db_base extends TestCase
{
    protected $db;

    static public function setUpBeforeClass() : void
    {
        parent::setUpBeforeClass();
    }

    public function setUp() : void
    {
        $dsn = sprintf('mysql:host=%s;dbname=%s', $GLOBALS['DB_HOST'], $GLOBALS['DB_DATABASE']);
        $this->db = new Db($dsn, $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWORD']);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function tearDown() : void
    {
        $this->db = null;
        unset($this->db);
    }


}