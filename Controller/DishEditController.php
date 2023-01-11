<?php

include_once(__DIR__ . '/../Classes/Controller.php');
include_once(__DIR__ . '/../Models/DishModel.php');
include_once(__DIR__ . '/../Models/DishCategoryModel.php');

$controller = new Controller();

$dish = DishModel::findById($_GET['id']);
$dishData = $dish->getData();

function isSame($oldDish, $newDish)
{
    // TODO
    return false;
}

function updateDish($oldDish, $newDish)
{
    if(!isSame($oldDish, $newDish))
    {
        $oldDish->setMealName($newDish['meal_name']);
        $oldDish->setMealPrice($newDish['meal_price']);
        $oldDish->setMealIngredient($newDish['meal_ingredient']);
        $oldDish->setMealDescription($newDish['meal_description']);
        $oldDish->setCategoryId($newDish['meal_category']);
        $oldDish->setIsAvailable($newDish['is_available']);
        $oldDish->update();
    }
}

function deleteDish()
{
    // TODO
    dump($_POST['delete']);
}

function getDish()
{
    $Dish = array(
        'id' =>NULL,
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
    if(!isset($_POST['DishName'])){
        return false;
    }
    if(!isset($_POST['DishPrice'])){
        return false;
    }
    if(!isset($_POST['DishIngredient'])){
        return false;
    }
    if(!isset($_POST['Description'])){
        return false;
    }
    return true;
}

function process()
{
    if(isDishSet())
    {
        $newDish = getDish();
        $oldDish = $GLOBALS['dish'];
        updateDish($oldDish, $newDish);

    }

    if(isset($_POST['delete']))
    {
        deleteDish();
    }
}

$controller->insertPage();
