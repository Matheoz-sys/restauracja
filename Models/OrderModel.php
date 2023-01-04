<?php

require_once 'Model.php';

class OrderModel extends Model
{
    protected static function getTableName(): string
    {
        return "orders";
    }
}
