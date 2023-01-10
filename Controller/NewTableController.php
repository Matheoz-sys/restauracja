<?php

include_once(__DIR__ . '/../Classes/Controller.php');
include_once(__DIR__ . '/../Models/TableModel.php');

$controller = new Controller();
$controller->setTitle("Nowy stolik");

function processPost()
{
   // dump($_POST);
   // dump(dataAvailable() && dataCorrect());
   if (!empty($_POST) && dataAvailable() && dataCorrect()) {
      // dump($controller->noErrorsOccured());
      $table = new TableModel();
      $table->setTableNumber($_POST['table_number']);
      $table->setPlacesCount($_POST['places_count']);
      $table->insert();
      header("Location: new_table.php");
   }
}

function dataAvailable()
{
   global $controller;

   if (!isset($_POST['table_number']))
      $controller->addError("table_number", "Numer stolika nie przesłany w formularzu.");
   if (!isset($_POST['places_count']))
      $controller->addError("places_count", "Ilość miejsc nie przesłana w formularzu.");

   return $controller->noErrorsOccured();
}

function dataCorrect()
{
   global $controller;

   if (tableNumberAlreadyTaken())
      $controller->addError("table_number", "Istnieje już stolik o takim numerze.");

   if (!tableHasAtLeastOnePlace())
      $controller->addError("places_count", "Należy przypisać co najmniej jedno miejsce do stolika.");

   return $controller->noErrorsOccured();
}

function tableNumberAlreadyTaken()
{
   $model = TableModel::findBy("table_number", $_POST['table_number']);
   return count($model) ? true : false;
}

function tableHasAtLeastOnePlace()
{
   return $_POST['places_count'] > 0 ? true : false;
}

processPost();
$controller->insertHtmlBeginning();

$errors = $controller->getErrors();
