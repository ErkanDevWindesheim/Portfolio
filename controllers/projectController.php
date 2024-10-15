<?php

require_once __DIR__ . '/../models/projectsModel.php';

class ProjectController {


    private $model;

    public function __construct() {
        $this->model = new ProjectModel();
    }

    public function index(): void {
        $projects = $this->model->getAllProjects();

        $title = "Project";
        $content = "
        <main class=\"main-2\">
            <h1>Projects</h1>
            <div class=\"project-section\">
                <div class=\"project-box\">
                    <h2 class\"project-title\">Titel</h2>
                    <p>Descriptie</p>
                    <button href=\"\">BEKIJK PROJECT</button>
                </div>
            </div>
        </main>";
        
        include(__DIR__ . "/../views/index.view.php");
    }

    public function AdminPanel() {
        // Laad de view die het formulier bevat

        // $title = "Project";
        // $content = "
        // <main class=\"main-2\">
        //     <h1>Projects</h1>
        //     <div class=\"project-section\">
        //         <div class=\"project-box\">
        //             <h2 class\"project-title\">Titel</h2>
        //             <p>Descriptie</p>
        //             <button href=\"\">BEKIJK PROJECT</button>
        //         </div>
        //     </div>
        // </main>";

        require_once __DIR__ . "/../views/index.view.php";
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

            // Validatie van de ingevoerde gegevens (optioneel)
            if (empty($title) || empty($description)) {
                // Toon een foutmelding als er verplichte velden ontbreken
                echo "Title and Description are required.";
                return;
            }

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
            $this->AdminPanel();
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


}