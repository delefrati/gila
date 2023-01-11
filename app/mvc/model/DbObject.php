<?php
namespace Gila\model;
use Gila\interfaces\DbObjectInterface;
use TheSeer\Tokenizer\Exception;

abstract class DbObject implements DbObjectInterface
{
    protected $db;
    protected $joins;

    private $valid_joins = ["LEFT", "INNER"];

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function getAll(array $fields = []) : array
    {
        return $this->search([], $fields);
    }

    public function get(int $id) : array
    {
        $rs = $this->search(['id' => $id]);
        if (is_array($rs) && count($rs) > 0) {
            return current($rs);
        }
        return [];
    }
    public function getFirst(array $search = []) : array
    {
        $rs = $this->search($search);
        if (is_array($rs) && count($rs) > 0) {
            return current($rs);
        }
        return [];
    }
    public function search(array $conditions=[], array $fields=[], int $limit = null) : array
    {
        $conditions = $this->prepareData($conditions, true);
        $str_where = '';
        $str_fields = '*';
        if (count($fields) > 0) {
            $str_fields = join(',', $fields);
        }
        $values = [];
        foreach($conditions as $condition => $value) {
            $conjugation = 'AND';
            $signal = '=';
            if (is_array($value)) {
                $conjugation = $value['conjugation'] ?? $conjugation;
                $signal = $value['signal'] ?? $signal;
                $value = $value['value'] ?? '';
            }
            $condition_ = str_replace(".", "_", $condition);
            $values[':' . $condition_] = $value;
            $str_where .= ' ' . $conjugation . ' ' . $condition . $signal . ':' . $condition_;
        }
        $str_limit = '';
        if ($limit !== null) {
            $str_limit = sprintf(' LIMIT %d', $limit);
        }
        $str = sprintf('SELECT %s FROM %s WHERE 1=1%s%s', $str_fields, $this->getTables(), $str_where, $str_limit);

        $stt = $this->db->prepare($str, [\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY]);
        $stt->execute($values);

        if (!$rs = $stt->fetchAll(\PDO::FETCH_ASSOC)) {
            return [];
        }
        return $rs;
    }

    private function getTables() : string
    {
        $tables = $this->getObjName();
        if (!isset($this->joins)) {
            return $tables;
        }
        foreach ($this->joins as $join_table => $connection) {
            if (!in_array($connection['type'], $this->valid_joins)) {
                throw new Exception('Invalid join type');
            }
            $tables .= sprintf(' %s JOIN %s ON %s', $connection['type'], $join_table, $connection['validation']);
        }
        return $tables;
    }

    /**
     * This method will clear data that is wrong (too much or too little data)
     */
    protected function prepareData(array $data, bool $ignore_null = false) : array
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
}