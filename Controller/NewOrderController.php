<?php

include_once(__DIR__ . '/../Classes/Controller.php');
include_once(__DIR__ . '/../Models/OrderModel.php');
include_once(__DIR__ . '/../Models/OrderItemModel.php');
include_once(__DIR__ . '/../Controller/DishesManagementController.php');

$controller = new Controller();

$categories = getCategories();
$meals = getMeals();
$tableId = $_GET['id'];

if(isset($_POST['order-details'])){
    manageOrder();
}

function insertOneOrderItem($orderId, $mealId, $meal_amount)
{
    $orderItem = new OrderItemModel();
    $orderItem->setOrderId($orderId);
    $orderItem->setMealId($mealId);
    $orderItem->setMealAmount($meal_amount);
    $orderItem->insert();
}

function insertOrderItems($orderId, $data)
{
    foreach($data as $key){
        foreach($key as $value){
            insertOneOrderItem($orderId, $value['mealId'], $value['amount']);
        }
    }
}

function insertNewOrder($tableId)
{
    $order = new OrderModel();
    $order->setTablesId($tableId);
    $order->setOrderStatus("w realizacji");
    return $order->insert();
}

function manageOrder()
{
    $stringData = $_POST['order-details'];
    $data = json_decode($stringData, true);

    $orderId = insertNewOrder($_GET['id']);
    insertOrderItems($orderId, $data);

    header("Location: /restauracja/Public/management/order_management.php");
}
$controller->insertPage();
