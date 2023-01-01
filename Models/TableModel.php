<?php

require_once 'Model.php';

class TableModel extends Model
{
    protected static function getTableName(): string
    {
        return "tables";
    }
}
