<?php
namespace Gila\model;
use Gila\interfaces\DbObjectInterface;
use TheSeer\Tokenizer\Exception;

abstract class DbObjectEditable extends DbObject
{

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

}