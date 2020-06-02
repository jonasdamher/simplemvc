<?php

declare(strict_types=1);

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

    private static function setDriver(string $driver)
    {
        self::$driver = $driver;
    }

    private static function getDriver(): string
    {
        return self::$driver;
    }

    private static function setDns(string $dns)
    {
        self::$dns = $dns;
    }

    private static function getDns(): string
    {
        return self::$dns;
    }

    private static function setPort(int $port)
    {
        self::$port = $port;
    }

    private static function getPort(): int
    {
        return self::$port;
    }

    private static function setDatabaseName(string $databaseName)
    {
        self::$databaseName = $databaseName;
    }

    private static function getDatabaseName(): string
    {
        return self::$databaseName;
    }

    private static function setCharset(string $charset)
    {
        self::$charset = $charset;
    }

    private static function getCharset(): string
    {
        return self::$charset;
    }

    private static function setUserName(string $userName)
    {
        self::$userName = $userName;
    }

    private static function getUserName(): string
    {
        return self::$userName;
    }

    private static function setPassword(string $password)
    {
        self::$password = $password;
    }

    private static function getPassword(): string
    {
        return self::$password;
    }

    private static function credentials()
    {
        $credentials = require_once 'conf/credentials.php';

        self::setDriver($credentials['driver']);
        self::setDns($credentials['dns']);
        self::setPort($credentials['port']);
        self::setDatabaseName($credentials['databaseName']);
        self::setCharset($credentials['charset']);
        self::setUserName($credentials['userName']);
        self::setPassword($credentials['password']);
    }

    private static function connectionTo(): object
    {
        try {
            self::credentials();

            $dns = self::getDriver() . ':host=' . self::getDns() . '; port=' . self::getPort() . '; dbname=' . self::getDatabaseName() . '; charset=' . self::getCharset();
            $pdoConnection = new PDO($dns, self::getUserName(), self::getPassword());
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