<?php

require_once __DIR__ . '/../models/projectsModel.php';

class ProjectController {


    private $model;

    public function __construct() {
        $this->model = new ProjectModel();
    }

    public function index(): void {
        $projects = $this->model->getAllProjects();

        $title = "Projects";
        // Output buffering gebruiken om de view-output op te slaan als string
        ob_start();
        include __DIR__ . '/../views/php/projects.view.php';
        $content = ob_get_clean(); // Sla de output op in $content
        
        include(__DIR__ . "/../views/index.view.php");
    }

    // Verwerk de formulierdata en voeg een project toe
    public function add() {
        // Controleer of het formulier is verzonden via POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Haal de ingevoerde gegevens uit het formulier
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $technologies = $_POST['technologies'] ?? '';
            $projectLink = $_POST['project_link'] ?? '';
            $githubLink = $_POST['github_link'] ?? '';


            // Voeg het project toe via het model
            $success = $this->model->addProject($title, $description, $technologies, $projectLink, $githubLink);

            // Controleer of het project succesvol is toegevoegd
            if ($success) {
                // Herleid naar de projectpagina of geef een succesmelding
                echo "Project successfully added!";
                // In een echte toepassing zou je bijvoorbeeld redirecten:
                // header("Location: /projects");
                // exit;
            } else {
                echo "Failed to add project.";
            }
        } else {
            // Als het formulier niet is verzonden, toon het formulier opnieuw
            // $this->AdminPanel();
            // momenteel niks.
        }
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

    // UPDATE: formulier om een project te bewerken
    public function editForm($id) {
        $project = $this->model->getProjectById($id);
        if ($project) {
            require_once 'views/projects/edit.php'; // Formulier voor bewerken
        } else {
            echo "Project not found.";
        }
    }

    // UPDATE: Werk een project bij
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $technologies = $_POST['technologies'] ?? '';
            $projectLink = $_POST['project_link'] ?? '';
            $githubLink = $_POST['github_link'] ?? '';

            if (empty($title) || empty($description)) {
                echo "Title and Description are required.";
                return;
            }

            $success = $this->model->updateProject($id, $title, $description, $technologies, $projectLink, $githubLink);
            if ($success) {
                header("Location: /projects");
                exit;
            } else {
                echo "Failed to update project.";
            }
        } else {
            $this->editForm($id);
        }
    }

    // DELETE: Verwijder een project
    public function delete($id) {
        $success = $this->model->deleteProject($id);
        if ($success) {
            header("Location: /projects");
            exit;
        } else {
            echo "Failed to delete project.";
        }
    }

    public function showProjectDetails($id): void {
        // Haal project op op basis van het ID
        $project = $this->model->getProjectById($id);
    
        // Als het project niet gevonden is, toon een foutmelding of 404
        if (!$project) {
            header("HTTP/1.0 404 Not Found");
            echo "Project niet gevonden";
            return;
        }
    
        // Stel de paginatitel en content in
        $title = "Project Details";
    
        // Bouw de HTML-content op voor de projectdetails
        $content = "
        <main class=\"main-2\">
            <h1 class=\"project-title\">" . htmlspecialchars($project['title']) . "</h1>
            <div class=\"project-details\">
                <div class=\"project-info\">
                    <p><strong>Beschrijving:</strong> " . htmlspecialchars($project['description']) . "</p>
                    <p><strong>Technologieën:</strong> " . htmlspecialchars($project['technologies_used'] ?? 'N.v.t.') . "</p>
                    <div class=\"project-links\">
                        <a href=\"" . htmlspecialchars($project['project_link']) . "\" class=\"project-btn\" target=\"_blank\">Bekijk Project</a>
                        <a href=\"" . htmlspecialchars($project['github_link']) . "\" class=\"github-btn\" target=\"_blank\">Bekijk op GitHub</a>
                    </div>
                </div>
            </div>
        </main>";
    
        // Laad de view met de inhoud
        include(__DIR__ . "/../views/index.view.php");
    }


}