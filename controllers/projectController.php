<?php

require_once __DIR__ . '/../models/projectsModel.php';

class ProjectController {


    private $model;

    public function __construct() {
        $this->model = new ProjectModel();
    }

    public function index(): void {
        // Haal de geselecteerde technologie uit de query-parameters
        $allowed_technologies = ['PHP', 'JavaScript', 'HTML', 'CSS', 'MySQL'];
        $technology = $_GET['technology'] ?? '';

        // validatie technology
        if (!in_array($technology, $allowed_technologies)) {
            $technology = ''; // Reset naar leeg als het een ongeldige waarde is
        }
    
        // Als er een technologie is geselecteerd, filter projecten op die technologie
        if (!empty($technology)) {
            $projects = $this->model->getProjectsByTechnology($technology);
        } else {
            // Haal alle projecten op als er geen filter is
            $projects = $this->model->getAllProjects();
        }
    
        $title = "Projects";
    
        // Output buffering gebruiken om de view-output op te slaan als string
        ob_start();
        include __DIR__ . '/../views/php/projects.view.php';
        $content = ob_get_clean(); // Sla de output op in $content
    
        include(__DIR__ . "/../views/index.view.php");
    }


    // READ: een enkel project
    public function show($id) {
        $project = $this->model->getProjectById($id);
        if ($project) {
            require_once 'views/projects/show.php'; // Toon details van project
        } else {
            echo "Project not found.";
        }
    }

    public function showProjectDetails($id): void {
        // Haal project op op basis van het ID
        $project = $this->model->getProjectById($id);
    
        // Als het project niet gevonden is, toon een foutmelding of 404
        if (!$project) {
            header("location: /404");
        }
    
        // Stel de paginatitel en content in
        $title = "Project Details";
    
        // Bouw de HTML-content op voor de projectdetails
        ob_start();
        include __DIR__ . '/../views/php/project-details.view.php';
        $content = ob_get_clean();
    
        // Laad de view met de inhoud
        include(__DIR__ . "/../views/index.view.php");
    }


}