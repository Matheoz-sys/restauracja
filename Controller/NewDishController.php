<?php
include_once(__DIR__ . '/../Models/DishModel.php');
include_once(__DIR__ . '/../Models/DishCategoryModel.php');

class NewDishController extends Controller
{
    protected function process()
    {
        $this->processPost();
    }

    private function processPost()
    {
        if ($this->isDishSet()) {
            $dish = $this->getDish();
            if($this->isDishValid($dish)){
                $this->insertDishToDatabase($dish);
                Messager::addConfirmation("Dodano nowe danie");
                header("Location: new_dish");
            }
        }
    }

    private function isDishValid($dish)
    {
        if(!$this->priceCorrect($dish['meal_price'])){
            Messager::addWarning("Niepoprawna cena");
            return false;
        }
        if(!$this->categoryCorrect($dish['meal_category'])){
            Messager::addWarning("Nie wybrano kategori");
            return false;
        }
        if(empty($dish['meal_name'])){
            Messager::addWarning("Nie wybrano nazwy");
            return false;
        }
        return true;
    }

    private function insertDishToDatabase($dish)
    {
        $model = new DishModel();
        $model->setMealName($dish['meal_name']);
        $model->setMealPrice($dish['meal_price']);
        $model->setMealIngredient($dish['meal_ingredient']);
        $model->setMealDescription($dish['meal_description']);
        $model->setCategoryId($dish['meal_category']);
        $model->setIsAvailable($dish['is_available']);
        $model->insert();
    }

    private function getDish()
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

    private function isDishSet()
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

    private function categoryCorrect($category)
    {
        foreach (DishCategoryModel::findAll() as $categories) {
            if($categories['id'] == $category){
                return true;
            }
        }
        return false;
    }

    private function priceCorrect($price){
        return $price > 0;
    }
}