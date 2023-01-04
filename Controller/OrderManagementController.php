<?php

include_once(__DIR__ . '/../Classes/Controller.php');
include_once(__DIR__ . '/../Models/OrderModel.php');
include_once(__DIR__ . '/../Models/OrderItemModel.php');
include_once(__DIR__ . '/../Models/DishModel.php');
include_once(__DIR__ . '/../Models/DishCategoryModel.php');

$controller = new Controller();
$controller->setTitle("Zamówienia");
$orders = OrderModel::findAll();

if(isset($_POST['delete-order'])){
    $id = $_POST['delete-order'];
    deleteOrder($id);
    header("Location: order_management.php");
}

function getOrderItems($orderId)
{
    return OrderItemModel::findBy('order_id', $orderId);
}

function getMeal($id)
{
    return DishModel::findById($id);
}

function getMealName($id)
{
    $res = DishModel::findBy('id', $id);
    return $res[0]['meal_name'];
}

function deleteOrderItems($items)
{
    foreach($items as $key)
    {
        $model = OrderItemModel::findById($key['id']);
        $model->delete();
    }
}

function deleteOrder($id)
{
    deleteOrderItems(getOrderItems($id));

    $model = OrderModel::findById($id);
    $model->delete();
}

$controller->insertHtmlBeginning();
