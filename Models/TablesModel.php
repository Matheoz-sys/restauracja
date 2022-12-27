<?php

require_once 'Model.php';

class TablesModel extends Model
{
    protected static function getTableName(): string
    {
        return "tables";
    }
}
