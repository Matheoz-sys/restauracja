<?php

require_once 'Model.php';

class OrderItemModel extends Model
{
    protected static function getTableName(): string
    {
        return "order_item";
    }
}
