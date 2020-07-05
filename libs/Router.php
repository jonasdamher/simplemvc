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

/**
 * Comprueba que existe el archivo y la clase controlador
 * e instancia el controlador.
 */
$className = $controller . 'Controller';

if (!file_exists('controllers/' . $className . '.php')) {
    Utils::redirection('error/error500');
}

if (!class_exists($className)) {
    Utils::redirection('error/error404');
}

$controller = new $className();

/**
 * Comprueba que existe el método en el controlador y 
 * utiliza el método si es correcto.
 */
if (!method_exists($controller, $action)) {
    Utils::redirection('error/error404');
}

$controller->$action();
