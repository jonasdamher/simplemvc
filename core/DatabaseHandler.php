<?php

declare(strict_types=1);

/**
 * Para administrar diferentes bases de datos.
 */
class DatabaseHandler
{
	protected static array $credentials = [];
	protected static array $connections = [];

	protected static bool $initialize = false;
	
	protected static string $dbByDefault = 'default';

	/**
	 * Añadir credenciales para conexión a la base de datos.
	 */
	protected static function credentials()
	{
		self::$credentials = require_once 'conf/credentials.php';
	}

	/**
	 * Iniciar la conexión a la base de datos.
	 */
	protected static function connectionTo($db): object
	{
		try {

			$dns = self::$credentials[$db]['driver'] . ':host=' . self::$credentials[$db]['dns'] . '; 
			port=' . self::$credentials[$db]['port'] . '; 
			dbname=' . self::$credentials[$db]['databaseName'] . '; 
			charset=' . self::$credentials[$db]['charset'];

			$pdoconnections = new PDO($dns, self::$credentials[$db]['userName'], self::$credentials[$db]['password']);
			$pdoconnections->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			return $pdoconnections;
		} catch (PDOException $e) {
			exit('Error connect to database: ' . $e->getMessage());
		}
	}
}
