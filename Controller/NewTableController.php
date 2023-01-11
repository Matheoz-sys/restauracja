<?php

include_once(__DIR__ . '/../Classes/Controller.php');
include_once(__DIR__ . '/../Models/TableModel.php');

$controller = new Controller();
$controller->setSiteTitle("Nowy stolik");

function processPost()
{
    if (!empty($_POST) && dataAvailable() && dataCorrect()) {
        $table = new TableModel();
        $table->setTableNumber($_POST['table_number']);
        $table->setPlacesCount($_POST['places_count']);
        $table->insert();
        header("Location: new_table.php");
        exit();
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

    if (!tableNumberValid())
        $controller->addError("table_number", "Istnieje już stolik o takim numerze.");

    if (!placesCountValid())
        $controller->addError("places_count", "Należy przypisać co najmniej jedno miejsce do stolika.");

    return $controller->noErrorsOccured();
}

function tableNumberValid()
{
    $model = TableModel::findBy("table_number", $_POST['table_number']);
    return empty($model);
}

function placesCountValid()
{
    return $_POST['places_count'] > 0;
}

processPost();
$controller->insertPage();

$errors = $controller->getErrors();
