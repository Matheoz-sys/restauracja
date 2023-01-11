<?php

include_once(__DIR__ . '/../Classes/Controller.php');
include_once(__DIR__ . '/../Models/TableModel.php');

$controller = new Controller();
$controller->setPageTitle("Edycja stolika");

$table = TableModel::findById($_GET['id']);

$tableData = $table->getData();


$controller->setSiteTitle("Edycja stolika #" . $tableData['id']);

function processPost()
{
    global $table;

    if (empty($_POST)) return;

    if (dataAvailable() && dataCorrect()) {
        $table->setTableNumber($_POST['table_number']);
        $table->setPlacesCount($_POST['places_count']);
    }

    if ($table->valuesChanged()) {
        $tableData = $table->getData();
        $dataUpdated = $table->update();

        if ($dataUpdated) Messager::addConfirmation("Stolik został zaktualizowany.<br>Nowy numer stolika:" . $tableData['table_number'] . "<br>Nowa liczba miejsc: " . $tableData['places_count']);
        else Messager::addWarning("Coś poszło nie tak.");

        header("Location: table_edit.php?id=" . $_GET['id']);
    } else {
        Messager::addNotice("Brak danych do zaktualizowania");
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

    if (!tablePlacesValid())
        $controller->addError("places_count", "Należy przypisać co najmniej jedno miejsce do stolika.");

    return $controller->noErrorsOccured();
}

function tableNumberValid()
{
    global $tableData;

    $models = TableModel::findBy("table_number", $_POST['table_number']);

    switch (count($models)) {
        case 0:
            return true;
        case 1:
            return $tableData['id'] == current($models)['id'];
        default:
            return false;
    }
}

function tablePlacesValid()
{
    return $_POST['places_count'] > 0;
}

$controller->insertPage();
processPost();

$errors = $controller->getErrors();
