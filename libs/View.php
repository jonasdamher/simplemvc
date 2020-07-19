<?php

declare(strict_types=1);

require_once 'libs/Head.php';
require_once 'libs/Footer.php';

/**
 * Clase para mostrar la vista de un controlador.
 */
class View
{

	private static array $currentView = ['controller' => '', 'action' => ''];

	/**
	 * Devuelve el nombre del controlador especificado en el método show()
	 */
	public static function controller(): string
	{
		return self::$currentView['controller'];
	}

	/**
	 * Devuelve el nombre de la acción especificada en el método show()
	 */
	public static function action(): string
	{
		return self::$currentView['action'];
	}
	/**
	 * Permite devolver una vista.
	 */
	public static function show(string $controller, string $action = 'index'): string
	{

		if (!is_dir('views/' . $controller) || !is_file('views/' . $controller . '/' . $action . '.php')) {
			Utils::redirection('error/error500');
		}

		self::$currentView['controller'] = $controller;
		self::$currentView['action'] = $action;

		return 'views/index.php';
	}
}
