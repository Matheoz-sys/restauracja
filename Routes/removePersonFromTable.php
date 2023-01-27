<?php
include_once __DIR__ . '/../Models/TableModel.php';

function removePersonFromTable($uri)
{
    $tableId = explode("/", $uri);
    $tableId = end($tableId);

    $table = TableModel::findById($tableId);
    $tableData = $table->getData();

    if ($tableData['occupied_places_count'] > 0) {
        $table->setOccupiedPlacesCount($tableData['occupied_places_count'] - 1);
        if (($tableData['occupied_places_count'] - 1) == 0) {
            $table->setIsOccupied(0);
        };
        $table->update();
    }

    echo json_encode(["occupiedPlaces" => $table->getData()['occupied_places_count']]);
}
