<?php declare(strict_types=1);
require_once('/opt/app/vendor/autoload.php');

use PHPUnit\Framework\TestCase;
use Gila\model\Db;

abstract class Db_base extends TestCase
{
    protected $db;

    static public function setUpBeforeClass() : void
    {
        $command = sprintf('mariadb -h %s -u %s -p%s %s < /opt/app/tests/sql/test_data.sql', $_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], $_ENV['DB_DATABASE']);
        $r = shell_exec($command);
        parent::setUpBeforeClass();
    }
    protected function mockDb() : Db
    {
        $dsn = sprintf('mysql:host=%s;dbname=%s', $_ENV['DB_HOST'], $_ENV['DB_DATABASE']);
        $db = new Db($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }

}