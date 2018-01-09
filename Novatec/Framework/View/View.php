<?php

namespace Novatec\Framework\View;

class View
{

    protected $path = null;
    protected $controller = null;
    protected $element = array();

    public function __construct($controller)
    {
        $this->controller = $controller;
    }

    public function setPath($path)
    {
        $this->path = $path;
    }

    public function render($action)
    {
        $action = str_replace('Action', '', $action);

        require $this->path . DIRECTORY_SEPARATOR . $this->controller->getName() . DIRECTORY_SEPARATOR . $action . ".php";
    }

    public function __get($name)
    {
        return $this->element[$name];
    }

    public function __set($name, $value)
    {
        $this->element[$name] = $value;
    }

}
