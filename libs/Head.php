<?php

declare(strict_types=1);

/**
 * Clase para añadir el título a la página 
 * y añadir información a las meta etiquetas HTML
 */
class Head
{
	private static string $title = '';
	private static string $description = 'Example page, using PHP with MVC architecture';

	/**
	 * Establecer título de página web.
	 */
	public static function title(string $title)
	{
		self::$title = $title . ' -';
	}

	/**
	 * Devuelve el título de página web.
	 */
	public static function getTitle(): string
	{
		return self::$title;
	}

	/**
	 * Establecer descripción de página web.
	 */
	public static function description(string $description)
	{
		self::$description = $description;
	}

	/**
	 * Devuelve la descripción de página web.
	 */
	public static function getDescription(): string
	{
		return self::$description;
	}
}
