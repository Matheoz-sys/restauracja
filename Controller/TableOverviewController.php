<?php
include_once(__DIR__ . '/../Models/TableModel.php');
include_once(__DIR__ . '/../Models/OrderModel.php');
include_once(__DIR__ . '/../Models/OrderItemModel.php');
include_once(__DIR__ . '/../Models/DishModel.php');
include_once(__DIR__ . '/../Models/DishCategoryModel.php');
require_once __DIR__ . '/../Controller/OrderManagementController.php';

class TableOverviewController extends Controller
{
    static $tableId;
    protected function process()
    {
        $table = TableModel::findById($_GET['id'])->getData();
        self::$tableId = $tableId = $table['id'];
        $tableNumber = $table['table_number'];

        $this->processPOST();

        $orders = OrderModel::findBy("tables_id", $tableId);

        $this->setSiteTitle("Stolik #$tableNumber (id:$tableId)");
        $this->setPageTitle("Stolik numer $tableNumber");
        $this->setTemplateData($table, 'table');
        $this->setTemplateData($orders, 'orders');
    }


    private function processPOST()
    {
        if (isset($_POST['delete-order'])) {
            $id = $_POST['delete-order'];
            $this->deleteOrder($id);
            Messager::addNotice("Zakończono obsługę klienta, usunięto rachunek.");
            Redirect::redirect("/restauracja/staff/table_overview?id=" . self::$tableId);
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
        foreach ($items as $key) {
            $model = OrderItemModel::findById($key['id']);
            $model->delete();
        }
    }

    public static function getOrderItems($orderId)
    {
        return OrderItemModel::findBy('order_id', $orderId);
    }
}
