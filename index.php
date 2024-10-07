<?php

require(__DIR__ . "/controllers/homeController.php");
require(__DIR__ . "/controllers/contactController.php");
require(__DIR__ . "/controllers/OverMijController.php");
require(__DIR__ . "/controllers/projectController.php");


$url = $_SERVER['REQUEST_URI'];

$HomePagina = new HomeController();
$ProjectPagina = new HomeController();
$ContactPagina = new HomeController();
$OverMijPagina = new HomeController();

switch ($url) {
    case '':
    case '/':
    case 'home':
        $HomePagina->index();
        break;
    case 'project':
    case 'projects':
        $ProjectPagina->index();
        break;
    case 'contact':
        $ContactPagina->index();
        break;
    case 'OverMij':
        $OverMijPagina->index();
        break;
    default:
        echo "404 - Page not found";
        break;
}