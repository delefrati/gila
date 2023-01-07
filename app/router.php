<?php
use Gila\model\Db;

require __DIR__ . '/vendor/autoload.php';

$db = new Db($_ENV['DB_DSN'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);

