<?php

include_once(__DIR__ . '/../Classes/Controller.php');
include_once(__DIR__ . '/../Models/TableModel.php');

$controller = new Controller();

$table = TableModel::findById($_GET['id']);

$newTable = new TableModel();

$idStolika = $table['id'];
$controller->setTitle("Edycja stolika #$idStolika");

$newTable->dataArr['table_number'] = 8;
$newTable->dataArr['places_count'] = 4;
$newTable->dataArr['is_occupied'] = 1;
$newTable->dataArr['occupied_p1laces_count'] = 2;

// $newTable->save();

$controller->render();
