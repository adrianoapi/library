<?php

namespace Novatec\Framework\Db\Adapter;

use Novatec\Framework\Util\Iterator\Collection;

class DbAdapterMySQL extends \PDO implements DbInterface
{

    public function factory(array $config)
    {
        $dsn = "mysql:dbname={$config['dbname']};host={$config['host']}";
        $dbAdapterMySQL = new self($dsn, $config['username'], $config['passwd']);

        $dbAdapterMySQL->setAttribute(self::ATTR_DEFAULT_FETCH_MODE, self::FETCH_ASSOC);

        return $dbAdapterMySQL;
    }

    public function insert($table, array $fields)
    {
        $columns = '';
        $values = '';

        foreach ($fields as $column => $value):
            $columns .= $column . ',';
            $values .=(is_string($value) ? "'$value'" : $value) . ',';
        endforeach;
        $columns = substr($columns, 0, strlen($columns) - 1);
        $values = substr($value, 0, strlen($values) - 1);

        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        $this->exec($sql);
    }

    public function update($table, array $fields, $where)
    {
        $sets = '';
        foreach ($fields as $colum => $value):
            $sets .= $colum . '=';
            $sets .= (is_string($value) ? "'$value'" : $value) . ',';
        endforeach;
        $sets = substr($sets, 0, strlen($sets) - 1);
        $sql = "UPDATE $table SET $sets WHERE $where";

        $this->exec($sql);
    }

    public function delete($table, $where)
    {
        $sql = "DELETE FROM $table WHERE $where";

        $this->exe($sql);
    }

    public function select($table, $cols = '*', $where = null)
    {
        $cols = is_array($cols) ? implode(',', $cols) : $cols;

        $sql = "SELECT $cols FROM $table " . (empty($where) ? '' : "WHERE $where");
        $stmt = $this->query($sql);

        return new Collection(empty($stmt)) ? array() : $stmt->fetchAll();
    }

    public function getFields($table)
    {
        $sql = "DESCRIBE $table;";
        $stmt = $this->query($sql);
        $results = $stmt->fetchAll();

        $metadata = array();

        foreach ($results as $result):
            $metadata[$result['Field']] = null;
        endforeach;
        return $metadata;
    }

}
