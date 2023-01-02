<?php

require_once 'Model.php';

class DishCategoryModel extends Model
{
    protected static function getTableName(): string
    {
        return "meals_category";
    }
}
