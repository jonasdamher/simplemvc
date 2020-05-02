<?php

class Router
{

    private $controller;
    private $action;

    public function __construct()
    {
        $this->controller = strtolower(trim($_GET['controller'] ?? CONTROLLER_DEFAULT));
        $this->action = strtolower(trim($_GET['action'] ?? ACTION_DEFAULT));

        $this->controller();
    }

    private function controller()
    {
        $className = $this->controller . 'Controller';

        if (!file_exists('controllers/' . $className . '.php')) {
            header('Location:' . URL_BASE . 'error/error500');
        }

        if (!class_exists($className)) {
            header('Location:' . URL_BASE . 'error/error404');
        }

        $controller = new $className();
        $this->action($controller);
    }

    private function action($controller)
    {
        $actionName = $this->action;

        if (!method_exists($controller, $actionName)) {
            header('Location:' . URL_BASE . 'error/error404');
        }

        return $controller->$actionName();
    }
}
?>