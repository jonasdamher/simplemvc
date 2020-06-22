<?php

declare(strict_types=1);

class Router
{
    private ?string $api;
    private string $controller;
    private string $action;

    public function __construct()
    {
        $this->api = $_GET['api'] ?? null;

        $this->controller = strtolower(trim($_GET['controller'] ?? 'home'));
        $this->action = strtolower(trim($_GET['action'] ?? 'index'));
        
        !is_null($this->api) ? $this->api() : $this->controller();
    }

    private function api(){
        $this->action = 'api'.ucfirst($this->action);
        $this->controller();
    }

    private function controller()
    {
        $className = $this->controller . 'Controller';

        if (!file_exists('controllers/' . $className . '.php')) {
            Utils::redirection('error/error500');
        }

        if (!class_exists($className)) {
            Utils::redirection('error/error404');
        }
        
        $controller = new $className();
        $this->action($controller);
    }

    private function action(object $controller)
    {
        $actionName = $this->action;

        if (!method_exists($controller, $actionName)) {
            Utils::redirection('error/error404');
        }
        return $controller->$actionName();
    }
}