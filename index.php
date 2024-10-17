<?php

// ROUTER


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
        // Check of een 'id' parameter aanwezig is in de URL
        if (isset($_GET['id'])) {
            $ProjectPagina->showProjectDetails($_GET['id']);
        } else {
            $ProjectPagina->index();  // Als er geen ID is, laad je alle projecten
        }
        break;
        
    case '/contact':
        require(__DIR__ . "/controllers/contactController.php");
        $ContactPagina = new ContactController();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ContactPagina->create();
        } else {
            $ContactPagina->index();
        }
        break;
    case '/overmij':
        require(__DIR__ . "/controllers/OverMijController.php");
        $OverMijPagina = new OverMijController();
        $OverMijPagina->index();
        break;
    case '/admin':
        require(__DIR__ . "/controllers/adminController.php");
        $adminPagina = new AdminController();
        $adminPagina->index();
        break;
    
    case '/admin/project/create':
        require(__DIR__ . "/controllers/adminController.php");
        $adminPagina = new AdminController();
        $adminPagina->createProject();
        break;
    
    case '/admin/skill/create':
        require(__DIR__ . "/controllers/adminController.php");
        $adminPagina = new AdminController();
        $adminPagina->createSkill();
        break;
    case '/admin/editproject':
        require(__DIR__ . "/controllers/adminController.php");
        $adminPagina = new AdminController();
        $adminPagina->editProject();
        break;
    case '/admin/deleteproject':
        require(__DIR__ . "/controllers/adminController.php");
        $adminPagina = new AdminController();
        $adminPagina->deleteProject();
        break;
    case '/admin/deleteskill':
        require(__DIR__ . "/controllers/adminController.php");
        $adminPagina = new AdminController();
        $adminPagina->deleteSkill();
        break;  
    case '/admin/editskill':
        require(__DIR__ . "/controllers/adminController.php");
        $adminPagina = new AdminController();
        $adminPagina->editSkill();
        break;    
    default:
        // Send a 404 header and output an error message
        header("HTTP/1.0 404 Not Found");
        echo "404 - Page not found";
        break;
}