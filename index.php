<?php

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$url = rtrim($url, '/');
$url = strtolower($url);

switch ($url) {
    case '':
    case '/':
    case '/home':
        require(__DIR__ . "/controllers/homeController.php");
        $HomePagina = new HomeController();
        $HomePagina->index();
        break;
        
    case '/project':
    case '/projects':
        require(__DIR__ . "/controllers/projectController.php");
        $ProjectPagina = new ProjectController();
        $ProjectPagina->index();
        break;
        
    case '/contact':
        require(__DIR__ . "/controllers/contactController.php");
        $ContactPagina = new ContactController();
        $ContactPagina->index();
        break;
        
    case '/overmij':
        require(__DIR__ . "/controllers/OverMijController.php");
        $OverMijPagina = new OverMijController();
        $OverMijPagina->index();
        break;
        
    default:
        // Send a 404 header and output an error message
        header("HTTP/1.0 404 Not Found");
        echo "404 - Page not found";
        break;
}