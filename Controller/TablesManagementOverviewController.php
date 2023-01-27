<?php
include_once(__DIR__ . '/../Models/TableModel.php');
class TablesManagementOverviewController extends Controller
{
    protected function process()
    {
        $this->setSiteTitle("Edycja stolików");
        $this->setPageTitle("Edycja stolików");

        $tables = TableModel::findAll();

        uasort($tables, function ($a, $b) {
            return $a['table_number'] > $b['table_number'] ? 1 : 0;
        });

        $this->setTemplateData($tables, 'tables');
    }
}
