<?php
include_once(__DIR__ . '/../Models/TableModel.php');
class TablesManagementOverviewController extends Controller
{
    protected function process()
    {
        $this->setPageTitle("Wybierz obsługiwany stolik");
        $this->setSiteTitle("Wybór stolików");

        $tables = TableModel::findAll();

        $this->setTemplateData($tables, 'tables');
    }
}
