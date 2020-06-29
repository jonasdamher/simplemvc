<?php

declare(strict_types=1);

require_once 'core/DatabaseHandler.php';

/**
 * Clase para establecer conexión a la base de datos.
 */
class Database extends DatabaseHandler
{
    /**
     * Conectar a la DB.
     */
    public static function connect($db = null): object
    {
        $db = $db ?? parent::$dbByDefault;

        if (!parent::$initialize) {
            parent::$initialize = true;
            parent::credentials();
        }

        if (!key_exists($db, parent::$connections) || is_null(parent::$connections[$db])) {
            parent::$connections[$db] = parent::connectionTo($db);
        }

        return parent::$connections[$db];
    }

    /**
     * Desconectar de la DB.
     */
    public static function disconnect($db = null)
    {
        $db = $db ?? parent::$dbByDefault;

        parent::$connections[$db] = null;
    }
}
