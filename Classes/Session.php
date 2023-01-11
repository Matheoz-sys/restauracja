<?php

/**
 * @Session - Klasa wykorzystująca pattern Singleton, dzięki niej nigdy nie powstanie więcej niż jedno połączenie z bazą danych.
 */
class Session
{
    private static $session;

    private function __construct()
    {
    }

    /**
     * @connect - zwraca połączenie z bazą danych
     */
    public static function getInstance()
    {
        if (!isset(self::$session)) {
            self::startSession();
            self::$session = new self();
        }
        return self::$session;
    }

    private static function startSession()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
    }

    public function saveData(string $containerName, $data)
    {
        self::startSession();
        $_SESSION[$containerName] = $data;
    }

    public function loadData(string $containerName)
    {
        if (!empty($_SESSION[$containerName])) return $_SESSION[$containerName];
    }

    public function clearData($containerName)
    {
        if (!empty($_SESSION[$containerName])) unset($_SESSION[$containerName]);
    }
}
