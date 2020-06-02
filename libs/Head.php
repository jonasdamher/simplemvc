<?php

declare(strict_types=1);

class Head
{
	private static string $title = '';
	private static string $description = 'Example page, using PHP with MVC architecture';

	public static function setTitle(string $title)
	{
		self::$title = $title;
	}

	public static function title(): string
	{
		return self::$title;
	}

	public static function setDescription(string $description)
	{
		self::$description = $description;
	}

	public static function description(): string
	{
		return self::$description;
	}
}