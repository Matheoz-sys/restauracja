<?php

include_once(__DIR__ . '/../Models/OrderModel.php');
include_once(__DIR__ . '/../Models/OrderItemModel.php');
include_once(__DIR__ . '/../Controller/DishesManagementController.php');

class NewOrderController extends Controller
{
    protected function process()
    {
        $categories = DishCategoryModel::findAll();
        $meals = DishModel::findAll();
        $tableId = $_GET['id'];
        $tableNr = $_GET['nr'];

        $this->processPOST();

        $this->setTemplateData($categories, 'categories');
        $this->setTemplateData($meals, 'meals');
        $this->setTemplateData($tableId, 'tableId');
        $this->setTemplateData($tableNr, 'tableNr');
        $this->setPageTitle("Nowe zamówienie");
    }

    private function processPOST()
    {
        if (isset($_POST['order-details'])) {
            $this->manageOrder();
        }
    }

    private function manageOrder()
    {
        $stringData = $_POST['order-details'];
        $data = json_decode($stringData, true);

        $orderId = $this->insertNewOrder($_GET['id']);
        $this->insertOrderItems($orderId, $data);

        Redirect::redirect("order_management");
    }

    private function insertOneOrderItem($orderId, $mealId, $meal_amount)
    {
        $orderItem = new OrderItemModel();
        $orderItem->setOrderId($orderId);
        $orderItem->setMealId($mealId);
        $orderItem->setMealAmount($meal_amount);
        $orderItem->insert();
    }

    private function insertOrderItems($orderId, $data)
    {
        foreach ($data as $key) {
            foreach ($key as $value) {
                $this->insertOneOrderItem($orderId, $value['mealId'], $value['amount']);
            }
        }
    }

    private function insertNewOrder($tableId)
    {
        $order = new OrderModel();
        $order->setTablesId($tableId);
        $order->setOrderStatus("w realizacji");
        return $order->insert();
    }
}
