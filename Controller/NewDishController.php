<?php

session_start();

include_once(__DIR__ . '/../Classes/Controller.php');

$controller = new Controller();
$controller->render();