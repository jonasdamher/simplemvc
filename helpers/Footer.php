<?php

declare(strict_types=1);

/**
 * Clase para añadir archivos JavaScript al footer del body del html.
 */
class Footer
{

	private static string $footer = 'default';
	private static array $linksJs = [];
	/**
	 * Añadir un nuevo pie de página.
	 */
	public static function set(string $footer)
	{
		self::$footer = $footer;
	}
	/**
	 * Devuelve un el pie de la página.
	 */
	public static function get(): string
	{
		return self::$footer;
	}
	/**
	 * Añadir un nuevo archivo JavaScript al footer de la página web.
	 */
	public static function js(string $fileName)
	{
		array_push(self::$linksJs, $fileName);
	}
	/**
	 * Devuelve un array con todos los archivos JavaScript del footer.
	 */
	public static function getLinksJs(): array
	{
		return self::$linksJs;
	}
}
