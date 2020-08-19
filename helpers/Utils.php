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
	 * Devuelve la fecha y hora actual.
	 */
	public static function currentDate()
	{
		$date = new DateTime();
		return 	$date->format('Y-m-d H:i:s');
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
	 * Compara si el nombre del controlador actual es igual al parámetro pasado,
	 * si es así, devuelve "active" si no devuelve " ".
	 */
	public static function menuActive(string $page): string
	{
		if ($page != ($_GET['controller'] ?? 'home')) {
			return '';
		}
		return 'active';
	}
}
