<?php

include_once(__DIR__ . '/../Models/TableModel.php');

$controller = new Controller();

$table = TableModel::findById($_GET['id'])->getData();

$idStolika = $table['id'];
$controller->setSiteTitle("Stolik #$idStolika");


$controller->insertPage();
