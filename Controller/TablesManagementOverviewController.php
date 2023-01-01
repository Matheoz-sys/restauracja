<?php

include_once(__DIR__ . '/../Classes/Controller.php');
include_once(__DIR__ . '/../Models/TableModel.php');

function buildTablesOverviewView($tables)
{
    $html = "";
    foreach ($tables as $table) {
        $tableId = $table['id'];
        $tableNumber = $table['table_number'];
        $placesTotal = $table['places_count'];
        $html .= "<a href='/restauracja/Public/management/table_edit.php?id=$tableId' class='table' id='$tableId'>";
        $html .= "<span><i class=\"fa-solid fa-person\"></i> $placesTotal</span>";
        $html .= "<span class='table__number'><i class=\"fa-regular fa-hashtag\"></i> $tableNumber</span>";
        $html .= "</a>";
    }
    return $html;
}

$controller = new Controller();
$controller->setTitle("Wybór stolików");

$tables = TableModel::findAll();

$controller->render();
