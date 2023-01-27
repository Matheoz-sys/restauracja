<?php

include_once(__DIR__ . '/../Models/TableModel.php');
include_once(__DIR__ . '/../Models/OrderModel.php');
include_once(__DIR__ . '/../Models/OrderItemModel.php');
class TableEditController extends Controller
{
    protected function process()
    {
        $table = TableModel::findById($_GET['id']);
        $tableData = $table->getData();

        $this->processPost($table);

        $this->setPageTitle("Edycja stolika");
        $this->setSiteTitle("Edycja stolika #" . $tableData['id']);

        $this->setTemplateData($tableData, 'table');
    }

    private function processPost(TableModel $table)
    {
        if (empty($_POST)) return;

        if (!empty($_POST['delete'])) {
            $orders = OrderModel::findBy("tables_id", $table->getData()['id']);
            foreach ($orders as $order) {
                $ordersItems = OrderItemModel::findBy("order_id", $order['id']);
                foreach ($ordersItems as $orderItem) {
                    OrderItemModel::findById($orderItem['id'])->delete();
                }
                OrderModel::findById($order['id'])->delete();
            }
            Messager::addConfirmation("Pomyślnie usunięto stolik nr: " . $table->getData()['table_number']);
            $table->delete();
            Redirect::redirect("tables_management_overview");
        }

        if ($this->dataAvailable() && $this->dataCorrect($table->getData())) {
            $table->setTableNumber($_POST['table_number']);
            $table->setPlacesCount($_POST['places_count']);
        } else {
            return;
        }

        if ($table->valuesChanged()) {

            $dataUpdateStatus = $table->update();
            $this->generateUpdateStatus($table, $dataUpdateStatus);

            header("Location: table_edit?id=" . $_GET['id']);
            exit();
        } else {
            Messager::addNotice("Brak danych do zaktualizowania");
        }
    }

    private function generateUpdateStatus(TableModel $table, bool $status)
    {
        $tableData = $table->getData();
        if ($status) Messager::addConfirmation("Stolik został zaktualizowany.<br>Nowy numer stolika:" . $tableData['table_number'] . "<br>Nowa liczba miejsc: " . $tableData['places_count']);
        else Messager::addWarning("Coś poszło nie tak.");
    }

    private function dataAvailable()
    {
        if (!isset($_POST['table_number']))
            $this->addError("table_number", "Numer stolika nie przesłany w formularzu.");
        if (!isset($_POST['places_count']))
            $this->addError("places_count", "Ilość miejsc nie przesłana w formularzu.");

        return $this->noErrorsOccured();
    }

    private function dataCorrect($tableData)
    {
        if (!$this->tableNumberValid($tableData))
            $this->addError("table_number", "Istnieje już stolik o numerze " . $_POST['table_number'] . ".");

        if (!$this->tablePlacesValid())
            $this->addError("places_count", "Należy przypisać co najmniej jedno miejsce do stolika.");

        return $this->noErrorsOccured();
    }

    private function tableNumberValid($tableData)
    {
        $models = TableModel::findBy("table_number", $_POST['table_number']);

        switch (count($models)) {
            case 0:
                return true;
            case 1:
                return $tableData['id'] == current($models)['id'];
            default:
                return false;
        }
    }

    private function tablePlacesValid()
    {
        return $_POST['places_count'] > 0;
    }
}
