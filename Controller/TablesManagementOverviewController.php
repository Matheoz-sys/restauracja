<?php

include_once(__DIR__ . '/../Classes/Controller.php');
include_once(__DIR__ . '/../Models/TableModel.php');

$controller = new Controller();
$controller->setSiteTitle("Wybór stolików");

$tables = TableModel::findAll();

$controller->insertPage();
