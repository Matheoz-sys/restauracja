<?php

include_once(__DIR__ . '/../Models/DishModel.php');
include_once(__DIR__ . '/../Models/DishCategoryModel.php');

class DishEditController extends Controller
{
    protected function process()
    {
        $dish = DishModel::findById($_GET['id']);
        $dishData = $dish->getData();

        $this->processPOST($dish);

        $this->setTemplateData($dishData, 'dishData');
    }

    private function processPOST($dish)
    {
        if (empty($_POST)) return;

        if($_POST['delete']){
            $dish->delete();
            Redirect::redirect("dishes_management");
        }

        if ($this->isDishSet())
        {
            $this->setDish($dish);
        }

        if($dish->valuesChanged()){
            $dish->update();
            Messager::addConfirmation("Danie zaktualizowane");
            Redirect::redirect("dish_edit?id=" . $_GET['id']);
        }
        else{
            Messager::addNotice("Brak danych do zaktualizowania");
            return false;
        }
    }

    private function setDish(&$dish)
    {
        $dish->setMealName($_POST['DishName']);
        $dish->setMealPrice($_POST['DishPrice']);
        $dish->setMealIngredient($_POST['DishIngredient']);
        $dish->setMealDescription($_POST['Description']);
        $dish->setCategoryId($_POST['DishCategory']);
        $dish->setIsAvailable('1');
    }

    private function isDishSet()
    {
        if (!isset($_POST['DishName'])) {
            $this->addError("table_number", "Nazwa dania nie przesłany w formularzu.");
        }
        if (!isset($_POST['DishPrice'])) {
            $this->addError("dish_price", "Cena nie przesłany w formularzu.");
        }
        if (!isset($_POST['DishIngredient'])) {
            $this->addError("dish_ingredient", "Składniki nie przesłany w formularzu.");
        }
        if (!isset($_POST['Description'])) {
            $this->addError("dish_description", "Opis stolika nie przesłany w formularzu.");
        }
        return $this->noErrorsOccured();
    }
}