<?php

namespace Novatec\Framework\Db;

use Novatec\Framework\Db\Adapter\DbInterface;

class Adapter
{

    private $config = null;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function factory()
    {
        $db = $this->config['db'];
        $class = __NAMESPACE__ . '\Adapter\DbAdapter' . $db;
        return call_user_func(array($class, 'factory'), $this->config);
    }

}
