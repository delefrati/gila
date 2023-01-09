<?php declare(strict_types=1);
require_once('/opt/app/vendor/autoload.php');

use PHPUnit\Framework\TestCase;
use Gila\model\Db;

abstract class Db_base extends TestCase
{
    protected $db;

    protected function mockDb(string $dsn = null, $user = null, $password = null)
    {
        $db = new Db($dsn ?? $_ENV['DB_DSN'], $user ?? $_ENV['DB_USER'], $password ?? $_ENV['DB_PASSWORD']);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }

}