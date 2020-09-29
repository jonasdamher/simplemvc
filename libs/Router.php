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

$path = '';
$className = '';

if (!is_null($api) && $api == 'api') {

    require_once 'libs/JsonRequest.php';

    require_once 'core/ApiController.php';

    // Autocargar todas las clases api
    require_once 'libs/ApiAutoload.php';
    $path = 'api';
    $className = $controller . 'Api';
} else {

    require_once 'helpers/View.php';

    require_once 'core/Controller.php';

    // Autocargar todas las clases
    require_once 'libs/ControllerAutoload.php';
    $path = 'controllers';
    $className = $controller . 'Controller';
}

if ($controller == 'error') {
    $action = 'error' . $action;
}

/**
 * Comprueba que existe el archivo y la clase controlador
 * e instancia el controlador.
 */

if (!file_exists($path . '/' . $className . '.php')) {
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
