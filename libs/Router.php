<?php

declare(strict_types=1);

/**
 * Router para controlar las rutas de la página, comprueba 
 * si existe el controlador y la acción del controlador.
 */

/**
 * Recoge los parámetros GET.
 */
$controller = strtolower(trim($_GET['controller'] ?? 'home'));
$action = strtolower(trim($_GET['action'] ?? 'index'));

$api = $_GET['api'] ?? null;

if (!is_null($api) && $api == 'api') {
    $action = 'api' . ucfirst($action);
}

if ($controller == 'error') {
    $action = 'error' . $action;
}

/**
 * Comprueba que existe el archivo y la clase controlador
 * e instancia el controlador.
 */
$className = $controller . 'Controller';

if (!file_exists('controllers/' . $className . '.php')) {
    Utils::redirection('error/500');
}

if (!class_exists($className)) {
    Utils::redirection('error/404');
}

$controller = new $className();

/**
 * Comprueba que existe el método en el controlador y 
 * utiliza el método si es correcto.
 */
if (!method_exists($controller, $action) && $className != 'articlesController') {
    Utils::redirection('error/404');
} else if (!method_exists($controller, $action) && $className == 'articlesController') {
    $action = 'get';
}

$controller->$action();
