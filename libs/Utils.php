<?php

declare(strict_types=1);

/**
 * Clase con métodos comunes para usar en controladores y sus vistas.
 */
class Utils
{
	/**
	 * Redireccionar a otra URL.
	 */
	public static function redirection(string $to)
	{
		header('Location: ' . URL_BASE . $to);
	}

	/**
	 * Devuelve un valor de petición POST, uso para campos de formularios.
	 */
	public static function postValue(string $postFieldName): string
	{
		if (!isset($_POST[$postFieldName])) {
			return '';
		}
		return $_POST[$postFieldName];
	}

	/**
	 * Compara si el controlador actual es igual al parámetro pasado,
	 * si es así, devuelve "active" si no devuelve " ".
	 */
	public static function menuActive(string $page): string
	{
		if ($page != $_GET['controller']) {
			return '';
		}
		return 'active';
	}
}
