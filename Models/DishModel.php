<?php

require_once 'Model.php';

class DishModel extends Model
{
    protected static function getTableName(): string
    {
        return "meals";
    }
}
