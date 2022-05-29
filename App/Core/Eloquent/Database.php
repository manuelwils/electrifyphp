<?php

namespace App\Core\Eloquent;

use PDO;

/**
 * @package Database
 */
class Database
{

    /**
     * a database instance (singleton design pattern)
     */
    protected static $db_instance = null;

    /**
     * create database connection
     */
    private static function connect()
    {
        /**
         * check if there's database instance has not already be set
         */
        if (self::$db_instance === null) {

            $pdo = new PDO('mysql:host=' . HOST . ';dbname=' . DB . ';charset=utf8', USER, PASSWORD);

            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            /**
             * set database instance to the newly created $pdo connection;
             */
            self::$db_instance = $pdo;
        }

        /**
         * return database instance if exist
         */
        return self::$db_instance;
    }

    /**
     * query database
     * @param string $query
     * @param array $params
     */
    public static function query($query, $params = array())
    {

        $stmt = self::connect()->prepare($query);

        $stmt->execute($params);

        if (explode(' ', $query)[0] == "SELECT") {

            $result = $stmt->fetchAll();

            return $result;
        }
    }
}
