<?php

include_once(__DIR__ . '/../Classes/Controller.php');
include_once(__DIR__ . '/../Models/DishModel.php');
include_once(__DIR__ . '/../Models/DishCategoryModel.php');

$controller = new Controller();
$controller->setTitle("Dania");

function getCategories()
{
    return DishCategoryModel::findAll();
}

function getMeals()
{
    return DishModel::findAll();
}

$controller->insertHtmlBeginning();
