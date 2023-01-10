<?php
namespace Gila\model;
use Gila\interfaces\DbObjectInterface;
use TheSeer\Tokenizer\Exception;

abstract class DbObject implements DbObjectInterface
{
    protected $db;
    private $joins;

    private $valid_joins = ["LEFT", "INNER"];

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }
    public function getAll(array $joins = null) : array
    {
        return $this->search([], $joins);
    }

    public function get(int $id, array $joins = null) : array
    {
        $rs = $this->search([$this->getObjName() . '.id' => $id], $joins);
        if (is_array($rs) && count($rs) > 0) {
            return current($rs);
        }
        return [];
    }
    public function search(array $conditions=[], $joins = null) : array
    {
        $conditions = $this->prepareData($conditions, true);
        $str_where = '';
        $values = [];
        foreach($conditions as $condition=>$value) {
            $conjugation = 'AND';
            $signal = '=';
            if (is_array($value)) {
                $conjugation = $value['conjugation'] ?? $conjugation;
                $signal = $value['signal'] ?? $signal;
                $value = $value['value'] ?? '';
            }
            $values[':' . $condition] = $value;
            $str_where .= ' ' . $conjugation . ' ' . $condition . $signal . ':' . $condition;
        }
        $str = sprintf('SELECT * FROM %s WHERE 1=1%s', $this->getTables($joins), $str_where);
        $stt = $this->db->prepare($str, [\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY]);
        $stt->execute($values);


        if (!$rs = $stt->fetchAll(\PDO::FETCH_ASSOC)) {
            return [];
        }
        return $rs;
    }

    private function getTables($joins = null) : string
    {
        $tables = $this->getObjName();
        if (is_null($joins)) {
            return $tables;
        }
        foreach ($joins as $join_table => $connection) {
            if (!in_array($connection['type'], $this->valid_joins)) {
                throw new Exception('Invalid join type');
            }
            $tables .= sprintf(' %s JOIN %s ON %s', $connection['type'], $join_table, $connection['validation']);
        }
        return $tables;
    }

    public function add(array $obj_data) : int
    {
        $fields = $this->getFields();
        $table = $this->getObjName();
        $str_fields = join(', ', $fields);
        $str_values = ':' . join(', :', $fields);
        $str = sprintf('INSERT INTO %s (%s) VALUES (%s)', $table, $str_fields, $str_values);
        $data = $this->prepareData($obj_data);
        return $this->exec($str, $data);
    }

    public function update(int $id, array $data) : int
    {
        if (count($this->get($id)) < 1) {
            throw new Exception('Invalid id.');
        }
        $table = $this->getObjName();
        $fields = $this->getFields();
        $str = sprintf('UPDATE %s SET ', $table);
        foreach ($fields as $field) {
            if (key_exists($field, $data)) {
                $str .= $field . '=:' . $field . ', ';
            }
        }
        $str = trim($str, ', ');
        $str .= ' WHERE id=:id';
        $data['id'] = $id;
        return $this->exec($str, $data, true);
    }

    public function delete(int $id) : bool
    {
        $table = $this->getObjName();
        if (count($this->get($id)) < 1) {
            return false;
        }
        $str = sprintf('DELETE FROM %s WHERE id=:id', $table);
        return $this->exec($str, ['id'=>$id], true);
    }

    public function exec(string $str, array $data, bool $ignore_null = false)
    {
        $data = $this->prepareData($data, $ignore_null);
        $this->db->beginTransaction();
        $stmt = $this->db->prepare($str);
        $response = $stmt->execute($data);
        $this->db->commit();
        return $response;
    }

    /**
     * This method will clear data that is wrong (too much or too little data)
     */
    private function prepareData(array $data, bool $ignore_null = false) : array
    {
        $prepared = [];
        $fields = $this->getFields();
        $table = $this->getObjName();
        foreach ($fields as $field) {
            if (key_exists($field, $data) || key_exists($table.'.'.$field, $data)) {
                $prepared[$field] = $data[$field];
            } elseif (!$ignore_null) {
                $prepared[$field] = null;
            }
        }
        if (key_exists('id', $data)) {
            $prepared['id'] = $data['id'];
        }
        return $prepared;
    }

    public function save() : bool
    {
        return false;
    }
}