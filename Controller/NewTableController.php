<?php
include_once(__DIR__ . '/../Models/TableModel.php');

class NewTableController extends Controller
{
    protected function process()
    {
        $this->setSiteTitle("Nowy stolik");
        $this->processPost();
    }

    private function processPost()
    {
        if (!empty($_POST) && $this->dataAvailable() && $this->dataCorrect()) {
            $table = new TableModel();
            $table->setTableNumber($_POST['table_number']);
            $table->setPlacesCount($_POST['places_count']);
            $table->insert();
            Messager::addConfirmation("Pomyślnie dodano stolik nr. " . $table->getData()['table_number'] . " o ilości miejsc: " . $table->getData()['places_count']);
            Redirect::redirect("tables_management_overview");
        }
    }

    private function dataAvailable()
    {
        global $controller;

        if (!isset($_POST['table_number']))
            $controller->addError("table_number", "Numer stolika nie przesłany w formularzu.");

        if (!isset($_POST['places_count']))
            $controller->addError("places_count", "Ilość miejsc nie przesłana w formularzu.");

        return $controller->noErrorsOccured();
    }

    private function dataCorrect()
    {
        global $controller;

        if (!$this->tableNumberValid())
            $controller->addError("table_number", "Istnieje już stolik o numerze " . $_POST['table_number'] . ".");

        if (!$this->placesCountValid())
            $controller->addError("places_count", "Należy przypisać co najmniej jedno miejsce do stolika.");

        return $controller->noErrorsOccured();
    }

    private function tableNumberValid()
    {
        $model = TableModel::findBy("table_number", $_POST['table_number']);
        return empty($model);
    }

    private function placesCountValid()
    {
        return $_POST['places_count'] > 0;
    }
}
