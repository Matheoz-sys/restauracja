<?php

/**
 * @Database - Klasa wykorzystująca pattern Singleton, dzięki niej nigdy nie powstanie więcej niż jedno połączenie z bazą danych.
 */
class Database
{
    private static $connection;

    private function __construct()
    {
    }

    /**
     * @connect - zwraca połączenie z bazą danych
     */
    public static function connect()
    {
        if (!isset(self::$connection)) {
            self::$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        }
        mysqli_set_charset(self::$connection, "utf8");
        return self::$connection;
    }
}
