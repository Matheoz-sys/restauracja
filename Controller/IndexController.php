<?php

include_once('../Classes/Controller.php');

$controller = new Controller("index");
$controller->setTitle("Strona główna");
// $controller->template();
$controller->render();
