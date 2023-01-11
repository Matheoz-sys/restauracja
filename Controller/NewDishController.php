<?php

// session_start();

include_once(__DIR__ . '/../Classes/Controller.php');
include_once(__DIR__ . '/../Models/DishModel.php');
include_once(__DIR__ . '/../Models/DishCategoryModel.php');

$controller = new Controller();

function isDishValid()
{
    // TODO  data validation
    return true;
}

function insertDishToDatabase($dish)
{
    if (isDishValid($dish)) {
        $model = new DishModel();
        $model->setMealName($dish['meal_name']);
        $model->setMealPrice($dish['meal_price']);
        $model->setMealIngredient($dish['meal_ingredient']);
        $model->setMealDescription($dish['meal_description']);
        $model->setCategoryId($dish['meal_category']);
        $model->setIsAvailable($dish['is_available']);
        $model->insert();
    }
}

function getDish()
{
    $Dish = array(
        'id' => NULL,
        "meal_name" => $_POST['DishName'],
        "meal_price" => $_POST['DishPrice'],
        "meal_ingredient" => $_POST['DishIngredient'],
        "meal_description" => $_POST['Description'],
        "meal_category" => $_POST['DishCategory'],
        "is_available" => '1',
    );
    return $Dish;
}

function isDishSet()
{
    if (!isset($_POST['DishName'])) {
        return false;
    }
    if (!isset($_POST['DishPrice'])) {
        return false;
    }
    if (!isset($_POST['DishIngredient'])) {
        return false;
    }
    if (!isset($_POST['Description'])) {
        return false;
    }
    return true;
}

function process()
{
    if (isDishSet()) {
        $dish = getDish();
        insertDishToDatabase($dish);
        //header("Location: new_dish.php");
    }
}

$controller->insertPage();
