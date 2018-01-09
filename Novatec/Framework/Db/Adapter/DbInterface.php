<?php

namespace Novatec\Framework\Db\Adapter;

interface DbInterface
{

    public static function factory(array $config);

    public function insert($table, array $fields);

    public function update($table, array $fields, $where);

    public function delete($table, $where);

    public function select($table, $cols = '*', $where = null);
}
