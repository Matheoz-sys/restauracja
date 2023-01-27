<?php
include_once __DIR__ . '/../Models/TableModel.php';

function addPersonToTable($uri)
{
    $tableId = explode("/", $uri);
    $tableId = end($tableId);

    $table = TableModel::findById($tableId);
    $tableData = $table->getData();

    if ($tableData['occupied_places_count'] < $tableData['places_count']) {
        $table->setOccupiedPlacesCount($tableData['occupied_places_count'] + 1);
        $table->setIsOccupied(1);
        $table->update();
    }

    echo json_encode(["occupiedPlaces" => $table->getData()['occupied_places_count']]);
}
