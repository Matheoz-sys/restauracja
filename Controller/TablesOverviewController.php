<?php

include_once(__DIR__ . '/../Classes/Controller.php');
include_once(__DIR__ . '/../Models/TablesModel.php');

function buildTablesOverviewView($tables)
{
    $html = "";
    foreach ($tables as $table) {
        $tableId = $table['id'];
        $html .= "<div class='table' id='$tableId'>" . $table['table_number'] . "</div>";
    }
    return $html;
}

$controller = new Controller();
$controller->setTitle("Wybór stolików");

$tables = TablesModel::findAll();

$controller->render();
