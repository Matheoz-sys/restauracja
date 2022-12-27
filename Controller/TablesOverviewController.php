<?php

include_once('../Classes/Controller.php');
include_once('../Models/TablesModel.php');

function buildTablesOverviewView($tables)
{
    $html = "";
    foreach ($tables as $table) {
        $html .= "<div class='table' id=''>" . $table['table_number'] . "</div>";
    }
    return $html;
}

$controller = new Controller("tables");
$controller->setTitle("Wybór stolików");

$tables = TablesModel::findAll();
$controller->setProperty("tables", $tables);

$controller->render();
