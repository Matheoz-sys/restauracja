<?php

include_once(__DIR__ . '/../Classes/Controller.php');

$controller = new Controller();
$controller->setPageTitle("Witamy - " . SITE_NAME);
$controller->insertPage();
