<?php

declare(strict_types=1);

class Utils
{
	public static function redirection(string $to)
	{
		header('Location: ' . URL_BASE . $to);
	}

	public static function postValue(string $postFieldName): string
	{
		if (!isset($_POST[$postFieldName])) {
			return '';
		}
		return $_POST[$postFieldName];
	}

	public static function menuActive(string $page): string
	{
		if ($page != $_GET['controller']) {
			return '';
		}
		return 'active';
	}
}
