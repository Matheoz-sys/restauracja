<?php

require_once 'Model.php';

class WaiterModel extends Model
{
    protected static function getTableName(): string
    {
        return "waiters";
    }
}
