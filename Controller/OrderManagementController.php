<?php

include_once(__DIR__ . '/../Models/TableModel.php');
include_once(__DIR__ . '/../Models/OrderModel.php');
include_once(__DIR__ . '/../Models/OrderItemModel.php');
include_once(__DIR__ . '/../Models/DishModel.php');
include_once(__DIR__ . '/../Models/DishCategoryModel.php');

class OrderManagementController extends Controller
{
    protected function process()
    {
        $orders = OrderModel::findAll();

        $this->processPOST();

        $this->setSiteTitle("Zamówienia");
        $this->setTemplateData($orders, 'orders');
        $this->setPageTitle("Zamówienia");
    }

    private function processPOST()
    {
        if(isset($_POST['delete-order']))
        {
            $id = $_POST['delete-order'];
            $this->deleteOrder($id);
            Redirect::redirect("order_management");
        }
    }

    private function deleteOrder($id)
    {
        $this->deleteOrderItems($this->getOrderItems($id));

        $model = OrderModel::findById($id);
        $model->delete();
    }

    private function deleteOrderItems($items)
    {
        foreach ($items as $key)
        {
            $model = OrderItemModel::findById($key['id']);
            $model->delete();
        }
    }

    public static function getTableNr($tableId)
    {
        return TableModel::findById($tableId)->getData()['table_number'];
    }

    public static function getOrderItems($orderId)
    {
        return OrderItemModel::findBy('order_id', $orderId);
    }

    public static function getMealName($id)
    {
        $res = DishModel::findBy('id', $id);
        return $res[0]['meal_name'];
    }
}
