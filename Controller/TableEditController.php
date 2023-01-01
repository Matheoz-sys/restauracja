<?php

include_once(__DIR__ . '/../Classes/Controller.php');
include_once(__DIR__ . '/../Models/TableModel.php');

$controller = new Controller();

$table = TableModel::findById($_GET['id']);

// $newTable = new TableModel();

$tableData = $table->getData();

$idStolika = $tableData['id'];

$controller->setTitle("Edycja stolika #$idStolika");

// $newTable->setTableNumber(7);
// $newTable->setPlacesCount(7);
// $newTable->setIsOccupied(7);
// $newTable->setOccupiedPlacesCount(7);

// $table->setTableNumber(6);
// $table->setPlacesCount(4);
// $table->setIsOccupied(1);
// $table->setOccupiedPlacesCount(2);

// dump($table);

// $table->update();
// $newTable->insert();

$controller->insertHtmlBeginning();
