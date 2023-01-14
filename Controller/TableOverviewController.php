<?php
include_once(__DIR__ . '/../Models/TableModel.php');

class TableOverviewController extends Controller
{
    protected function process()
    {
        $table = TableModel::findById($_GET['id'])->getData();
        $idStolika = $table['id'];

        $this->setSiteTitle("Stolik #$idStolika");
        $this->setTemplateData($table, 'table');
    }
}
