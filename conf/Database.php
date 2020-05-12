<?php

declare(strict_types=1);

class Database
{

    private static $driver = 'mysql';
    private static $dns = 'localhost';
    private static $port = '3008';
    private static $databaseName = 'simplymvcphp';
    private static $charset = 'utf8mb4';
    private static $userName = 'root';
    private static $password = '';

    private static $connection = null;

    private static function connectionTo(): object
    {
        try {

            $dns = self::$driver . ':host=' . self::$dns . '; port=' . self::$port . '; dbname=' . self::$databaseName . '; charset=' . self::$charset;
            $pdoConnection = new PDO($dns, self::$userName, self::$password);
            $pdoConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdoConnection;
        } catch (PDOException $e) {
            die('Error connect to database: ' . $e->getMessage());
        }
    }

    public static function connect(): object
    {
        if (self::$connection == null) {
            self::$connection = self::connectionTo();
        }
        return self::$connection;
    }

    public static function disconnect()
    {
        self::$connection = null;
    }
}
?>