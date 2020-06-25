<?php

declare(strict_types=1);

/**
 * Clase para establecer conexión a la base de datos.
 */
class Database
{
    private static string $driver = '';
    private static string $dns = '';
    private static int $port = 0;
    private static string $databaseName = '';
    private static string $charset = '';
    private static string $userName = '';
    private static string $password = '';

    private static ?object $connection = null;

    /**
     * Añadir credenciales para conexión a la base de datos.
     */
    private static function credentials()
    {
        $credentials = require_once 'conf/credentials.php';

        self::$driver = $credentials['driver'];
        self::$dns = $credentials['dns'];
        self::$port = $credentials['port'];
        self::$databaseName = $credentials['databaseName'];
        self::$charset = $credentials['charset'];
        self::$userName = $credentials['userName'];
        self::$password = $credentials['password'];
    }

    /**
     * Iniciar la conexión a la base de datos.
     */
    private static function connectionTo(): object
    {
        try {
            self::credentials();

            $dns = self::$driver . ':host=' . self::$dns . '; port=' . self::$port . '; dbname=' . self::$databaseName . '; charset=' . self::$charset;
            $pdoConnection = new PDO($dns, self::$userName, self::$password);
            $pdoConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdoConnection;
        } catch (PDOException $e) {
            die('Error connect to database: ' . $e->getMessage());
        }
    }

    /**
     * Conectar a la DB.
     */
    public static function connect(): object
    {
        if (self::$connection == null) {
            self::$connection = self::connectionTo();
        }
        return self::$connection;
    }

    /**
     * Desconectar de la DB.
     */
    public static function disconnect()
    {
        self::$connection = null;
    }
}
