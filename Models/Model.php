<?php

include_once(__DIR__ . '/../Classes/Database.php');

abstract class Model
{
    /**
     * Funkcja powinna zwracać nazwę tabeli w bazie danych
     */
    abstract protected static function getTableName(): string;

    public static function findAll()
    {
        $dbTableName = static::getTableName();
        $query = "SELECT * FROM $dbTableName";
        $queryResult = mysqli_query(Database::connect(), $query, MYSQLI_USE_RESULT);
        $results = mysqli_fetch_all($queryResult, MYSQLI_ASSOC);
        return $results;
    }

    public static function findBy($column, $value)
    {
        $dbTableName = static::getTableName();
        $query = "SELECT * FROM $dbTableName WHERE `$column`=`$value`";
        $queryResult = mysqli_query(Database::connect(), $query);
        $results = mysqli_fetch_all($queryResult, MYSQLI_ASSOC);
        return $results;
    }

    public static function findById($id)
    {
        $dbTableName = static::getTableName();
        $query = "SELECT * FROM $dbTableName WHERE `id`=`$id`";
        $queryResult = mysqli_query(Database::connect(), $query);
        $results = mysqli_fetch_assoc($queryResult);
        return $results;
    }

    public static function newModel()
    {
    }

    public function save()
    {
    }

    public function delete()
    {
    }
}
