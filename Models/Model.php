<?php

include_once(__DIR__ . '/../Classes/Database.php');

abstract class Model
{
    private $dataArr;
    private $changedValues;
    private $availableMagicMethods;
    
    /**
     * Funkcja powinna zwracać nazwę tabeli w bazie danych
     */
    abstract protected static function getTableName(): string;

    public function __construct()
    {
        $dbTableName = static::getTableName();
        $query = "DESCRIBE $dbTableName";   // Describe - zwraca sktrukture tabeli w db
        $queryResult = mysqli_query(Database::connect(), $query, MYSQLI_USE_RESULT);
        $results = mysqli_fetch_all($queryResult, MYSQLI_ASSOC);

        $this->mapValuesToDataArr($results);
        $this->createSetters();
    }

    private function mapValuesToDataArr($tableDescription): void
    {
        foreach ($tableDescription as $key => $val) {
            $dbKey = $val['Field'];
            $dbValue = $val['Default'];

            $this->dataArr[$dbKey] = $dbValue;
        }
    }

    private function createSetters()
    {
        foreach ($this->dataArr as $key => $val) {
            $this->availableMagicMethods[$key] = "set" . ucfirst(underlinesToCamelCase($key));
        }
    }

    public function __call($name, $arguments)
    {
        $this->isCorrectMethod($name);

        $dbKey = array_search($name, $this->availableMagicMethods);

        $this->changedValues[$dbKey] = $arguments[0];
        $this->dataArr[$dbKey] = $arguments[0];
    }

    private function isCorrectMethod($name)
    {
        if ($name == "setId")
        throw new Error("Nie można edytować ID");

        if (!in_array($name, $this->availableMagicMethods))
            throw new Error(dump($this) . "Brak takiego settera.");
    }

    public static function findAll(): array
    {
        $dbTableName = static::getTableName();
        $query = "SELECT * FROM $dbTableName";
        $queryResult = mysqli_query(Database::connect(), $query, MYSQLI_USE_RESULT);
        $results = mysqli_fetch_all($queryResult, MYSQLI_ASSOC);
        return $results;
    }

    public static function findBy($column, $value): array
    {
        $dbTableName = static::getTableName();
        $query = "SELECT * FROM $dbTableName WHERE `$column`=$value";
        $queryResult = mysqli_query(Database::connect(), $query);
        $results = mysqli_fetch_all($queryResult, MYSQLI_ASSOC);
        return $results;
    }

    public static function findById($id): self
    {
        $dbTableName = static::getTableName();
        $query = "SELECT * FROM $dbTableName WHERE `id`=$id";
        $queryResult = mysqli_query(Database::connect(), $query);
        $results = mysqli_fetch_assoc($queryResult);

        $thisObj = new static();
        $thisObj->dataArr = $results;
        return $thisObj;
    }

    public function update()
    {
        if (is_null($this->dataArr['id'])) throw new Error(dump($this->dataArr) . "Nie można zaktualizować nieistniejącego rekordu");

        $tableName = static::getTableName();
        $query = "UPDATE `$tableName` SET " . self::createUpdateString($this->changedValues) . " WHERE `id` = " . $this->dataArr['id'];

        mysqli_query(Database::connect(), $query);
    }

    /**
     * Zamienia znaczniki w zwykłe stringi, aby zapobiec SQL Injection
     */
    private static function createUpdateString($data)
    {
        $updateString = "";

        foreach ($data as $key => $value) {
            $updateString .= "`$key` = '" . mysqli_real_escape_string(Database::connect(), $value) .  "', ";
        }

        $updateString = substr($updateString, 0, -2);

        return $updateString;
    }

    public function insert()
    {
        if (!is_null($this->dataArr['id'])) throw new Error(dump($this->dataArr) . "Nie można wstawić istniejącego rekordu - id musi byc null");

        $tableName = static::getTableName();
        $query = "INSERT INTO `$tableName` " . self::createInsertString($this->dataArr);

        $connection = Database::connect();
        mysqli_query($connection, $query);
        return mysqli_insert_id($connection);
    }

    /**
     * Zamienia znaczniki w zwykłe stringi, aby zapobiec SQL Injection
     */
    private static function createInsertString($data)
    {
        $columns = implode(", ", array_keys($data));
        $escaped_values = array_map(array(Database::connect(), 'real_escape_string'), array_values($data));

        $values  = implode("', '", $escaped_values);
        return "($columns) VALUES ('$values')";
    }

    public function delete()
    {
    }

    public function getData(): array
    {
        return $this->dataArr;
    }

}
