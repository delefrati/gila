<?php
namespace Gila\model;
use Gila\interfaces\DbObjectInterface;
use TheSeer\Tokenizer\Exception;

abstract class DbObject implements DbObjectInterface
{
    protected $db;

    public function __construct(\PDO $db) {
        $this->db = $db;
    }

    public function getAll() : array
    {
        $sql = sprintf('SELECT * FROM %s', $this->getObjName());
        $stt = $this->db->prepare($sql, [\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY]);
        $stt->execute();
        return $stt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function get(int $id) : array
    {
        $sql = sprintf('SELECT * FROM %s WHERE id=?', $this->getObjName());
        $stt = $this->db->prepare($sql, [\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY]);
        $stt->execute([$id]);
        
        if (!$rs = $stt->fetch(\PDO::FETCH_ASSOC)) {
            return [];
        }
        return $rs;
    }

    public function add(array $obj_data) : int
    {
        $id = 0;
        try {
            // $this->db->beginTransaction();
            // $id = $this->db->lastInsertId();
            $fields = $this->getFields();
            $table = $this->getObjName();
            $str_fields = '';
            $str_questions = '';
            $str_fields = join(', ', $fields);
            $str_questions = str_repeat('?, ', count($fields));
            $str = sprintf('INSERT INTO %s (%s) VALUES (%s)', $table, $str_fields, $str_questions);
            print_r($str);
            // $this->db->commit();
        } catch (Exception $e) {
            // This will guarantee that we are not geting the wrong id and rethrow the error
            throw $e;
        }
        return $id;
    }

    public function save() : bool
    {
        return false;
    }
}