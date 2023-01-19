<?php

require __DIR__ . '/vendor/autoload.php';
include_once __DIR__ . "/config.php";
include_once __DIR__ . '/Classes/Session.php';
include_once __DIR__ . '/Classes/Messager.php';
include_once __DIR__ . '/Classes/Redirect.php';
include_once __DIR__ . '/Classes/Database.php';
include_once __DIR__ . '/Classes/Controller.php';
include_once __DIR__ . "/Functions/StringUtils.php";

$request = $_SERVER['REQUEST_URI'];


$uri = cutOutUriOnly($request);
$uri = str_replace("/restauracja", "", $uri);

switch ($uri) {

    case '':
    case 'index.php':
    case '/':
    case '/index.php':
        require_once __DIR__ . '/Controller/IndexController.php';
        $controller = new IndexController("index.php");
        $controller->execute();
        break;

    case '/management/dish_edit':
        require_once __DIR__ . '/Controller/DishEditController.php';
        $controller = new DishEditController('management/dish_edit.php');
        $controller->execute();
        break;

    case '/management/dishes_management':
        require_once __DIR__ . '/Controller/DishesManagementController.php';
        $controller = new DishesManagementController("management/dishes_management.php");
        $controller->execute();
        break;

    case '/management/new_dish':
        require_once __DIR__ . '/Controller/NewDishController.php';
        $controller = new NewDishController("management/new_dish.php");
        $controller->execute();
        break;

    case '/management/new_order':
        require_once __DIR__ . '/Controller/NewOrderController.php';
        $controller = new NewOrderController("management/new_order.php");
        $controller->execute();
        break;

    case '/management/new_table':
        require_once __DIR__ . '/Controller/NewTableController.php';
        $controller = new NewTableController("management/new_table.php");
        $controller->execute();
        break;

    case '/management/table_edit':
        require_once __DIR__ . '/Controller/TableEditController.php';
        $controller = new TableEditController("management/table_edit.php");
        $controller->execute();
        break;

    case '/management/order_management':
        require_once __DIR__ . '/Controller/OrderManagementController.php';
        $controller = new OrderManagementController("management/order_management.php");
        $controller->execute();
        break;

    case '/management/tables_management_overview':
        require_once __DIR__ . '/Controller/TablesManagementOverviewController.php';
        $controller = new TablesManagementOverviewController("management/tables_management_overview.php");
        $controller->execute();
        break;

    case '/staff/table_overview':
        require_once __DIR__ . '/Controller/TableOverviewController.php';
        $controller = new TableOverviewController("staff/table_overview.php");
        $controller->execute();
        break;

    case '/staff/tables_overview':
        require_once __DIR__ . '/Controller/TablesOverviewController.php';
        $controller = new TablesOverviewController("staff/tables_overview.php");
        $controller->execute();
        break;

    case '/management/waiter_registration':
        require_once __DIR__ . '/Controller/WaiterRegistrationController.php';
        $controller = new WaiterRegistrationController('management/waiter_registration.php');
        $controller->execute();
        break;

    default:
        http_response_code(404);
        require_once __DIR__ . '/views/404.php';
        break;
}

function cutOutUriOnly($request): string
{
    if (!str_contains($request, "?")) return $request;
    $uriAndParams = explode("?", $request);
    return $uriAndParams[0];
}
