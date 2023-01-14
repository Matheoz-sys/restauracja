<?php

include_once(__DIR__ . '/../Models/DishModel.php');
include_once(__DIR__ . '/../Models/DishCategoryModel.php');
class DishesManagementController extends Controller
{
    protected function process()
    {
        $this->setSiteTitle("Dania");

        $categories = DishCategoryModel::findAll();
        $meals = DishModel::findAll();

        $this->setTemplateData($categories, 'categories');
        $this->setTemplateData($meals, 'meals');
    }
}
