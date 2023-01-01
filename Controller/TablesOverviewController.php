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
        $isOccupiedClass = $table['is_occupied'] == 1 ? " is_occupied" : "";
        $placesOccupied = $table['occupied_places_count'];
        $html .= "<a href='/restauracja/Public/staff/table_overview.php?id=$tableId' class='table$isOccupiedClass' id='$tableId'>";
        $html .= "<span class='table__number'><i class=\"fa-regular fa-hashtag\"></i> $tableNumber</span>";
        $html .= "<span><i class=\"fa-solid fa-person\"></i> $placesOccupied/$placesTotal</span>";
        $html .= "<span style=\"width:100%; text-align:center\">Id: $tableId";
        $html .= "</a>";
    }
    return $html;
}

$controller = new Controller();
$controller->setTitle("Wybór stolików");

$tables = TableModel::findAll();

$controller->insertHtmlBeginning();
