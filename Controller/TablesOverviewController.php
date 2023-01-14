<?php

include_once(__DIR__ . '/../Models/TableModel.php');
class TablesOverviewController extends Controller
{
    protected function process()
    {
        $this->setBodyClass("body");
        $tables = TableModel::findAll();
        $this->setTemplateData($tables, 'tables');
        $this->setSiteTitle("Wybór stolików");
    }
}
