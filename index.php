<?php

require __DIR__ . '/vendor/autoload.php';
include_once __DIR__ . "/config.php";
include_once __DIR__ . '/Classes/Session.php';
include_once __DIR__ . '/Classes/Messager.php';
include_once __DIR__ . '/Classes/Database.php';
include_once __DIR__ . '/Classes/Controller.php';
include_once __DIR__ . "/Functions/StringUtils.php";

$request = $_SERVER['REQUEST_URI'];

$uriAndParams = splitUriAndParams($request);

switch ($uriAndParams[0]) {

    case '':
    case '/':
        require_once __DIR__ . '/Controller/IndexController.php';
        require_once __DIR__ . '/views/index.php';
        break;

    case '/management/dish_edit':
        require_once __DIR__ . '/Controller/DishEditController.php';
        require_once __DIR__ . '/views/management/dish_edit.php';
        break;

    case '/management/dishes_management':
        require_once __DIR__ . '/Controller/DishesManagementController.php';
        require_once __DIR__ . '/views/management/dishes_management.php';
        break;

    case '/management/new_dish':
        require_once __DIR__ . '/Controller/NewDishController.php';
        require_once __DIR__ . '/views/management/new_dish.php';
        break;

    case '/management/new_order':
        require_once __DIR__ . '/Controller/NewOrderController.php';
        require_once __DIR__ . '/views/management/new_order.php';
        break;

    case '/management/new_table':
        require_once __DIR__ . '/Controller/NewTableController.php';
        require_once __DIR__ . '/views/management/new_table.php';
        break;

    case '/management/tables_management_overview':
        require_once __DIR__ . '/Controller/TablesManagementOverviewController.php';
        require_once __DIR__ . '/views/management/tables_management_overview.php';
        break;

    case '/management/table_edit':
        require_once __DIR__ . '/Controller/TableEditController.php';
        require_once __DIR__ . '/views/management/table_edit.php';
        break;

    case '/management/order_management':
        require_once __DIR__ . '/Controller/OrderManagementController.php';
        require_once __DIR__ . '/views/management/order_management.php';
        break;

    case '/staff/table_overview':
        require_once __DIR__ . '/Controller/TableOverviewController.php';
        require_once __DIR__ . '/views/staff/table_overview.php';
        break;

    case '/staff/tables_overview':
        require_once __DIR__ . '/Controller/TablesOverviewController.php';
        require_once __DIR__ . '/views/staff/tables_overview.php';
        break;

    default:
        http_response_code(404);
        require_once __DIR__ . '/views/404.php';
        break;
}


Controller::insertHtmlEnd();

function cutOutUriOnly($request): array
{
    if (!str_contains($request, "?")) return [$request];
    $uriAndParams = explode("?", $request);
    return $uriAndParams[0];
}

function splitUriAndParams($request): array
{
    if (!str_contains($request, "?")) return [$request];
    //staff/table_overview?id=6&ef=7

    $uriAndParams = explode("?", $request);

    $uri = $uriAndParams[0];                    //staff/table_overview
    $params = explode("&", $uriAndParams[1]);   //id=6&ef=7

    $paramsCollection = [];

    foreach ($params as $param) {
        $item = explode("=", $param);
        $paramsCollection[$item[0]] = $item[1]; // array[id = 6, ef = 7]
    };

    $uriAndParams = [$uri, $paramsCollection];
    // $uri                = array[0] = "staff/table_overview"
    // $paramsCollection   = array[1] = [id = 6, ef = 7]

    return $uriAndParams;
}
