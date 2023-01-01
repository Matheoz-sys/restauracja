<?php

include_once(__DIR__ . '/../Classes/Database.php');

abstract class Model
{
    public $dataArr;
    /**
     * Funkcja powinna zwracać nazwę tabeli w bazie danych
     */
    abstract protected static function getTableName(): string;

    public function __construct()
    {
        $dbTableName = static::getTableName();
        $query = "DESCRIBE $dbTableName";
        $queryResult = mysqli_query(Database::connect(), $query, MYSQLI_USE_RESULT);
        $results = mysqli_fetch_all($queryResult, MYSQLI_ASSOC);
        $this->mapValuesToDataArr($results);
    }

    private function mapValuesToDataArr($tableDescription)
    {
        foreach ($tableDescription as $key => $val) {
            $dbKey = $val['Field'];
            $dbValue = $val['Default'];

            $this->dataArr[$dbKey] = $dbValue;
        }
    }

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
        $query = "SELECT * FROM $dbTableName WHERE `$column`=$value";
        $queryResult = mysqli_query(Database::connect(), $query);
        $results = mysqli_fetch_all($queryResult, MYSQLI_ASSOC);
        return $results;
    }

    public static function findById($id)
    {
        $dbTableName = static::getTableName();
        $query = "SELECT * FROM $dbTableName WHERE `id`=$id";
        $queryResult = mysqli_query(Database::connect(), $query);
        $results = mysqli_fetch_assoc($queryResult);
        return $results;
    }

    public function save()
    {
        $action = $this->dataArr['id'] != null ? "UPDATE" : "INSERT";
        $query = $action . " " . self::createSafeDataToPost(Database::connect(), static::getTableName(), $this->dataArr);
        dump($query);
        mysqli_query(Database::connect(), $query);
    }

    private function createSafeDataToPost($conn, $table, $data)
    {
        $columns = implode(", ", array_keys($data));
        $escaped_values = array_map(array($conn, 'real_escape_string'), array_values($data));

        $values  = implode("', '", $escaped_values);
        return "INTO `$table`($columns) VALUES ('$values')";
    }

    public function delete()
    {
    }
}
