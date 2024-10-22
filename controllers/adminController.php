<?php
require_once __DIR__ . '/../models/projectsModel.php';
require_once __DIR__ . '/../models/skillsModel.php';

class AdminController {

    private $projectModel;
    private $skillModel;

    public function __construct() {
        $this->projectModel = new ProjectModel();
        $this->skillModel = new SkillModel();
    }
    // De admin-pagina waar projecten en skills kunnen worden toegevoegd
    public function index(): void {
        $title = "Admin Paneel";
        $projects = $this->projectModel->getAllProjects();
        $skills = $this->skillModel->getAllSkills();

        // Separate success or error messages for projects and skills
        $Projectmessage = '';
        $Skillsmessage = '';

        // Check for project success or error
        if (isset($_GET['project_success'])) {
            $Projectmessage = "<span class='success-message'>" . htmlspecialchars($_GET['project_success']) . "</span>";
        } elseif (isset($_GET['project_error'])) {
            $Projectmessage = "<span class='error-message'>" . htmlspecialchars($_GET['project_error']) . "</span>";
        }

        // Check for skill success or error
        if (isset($_GET['skill_success'])) {
            $Skillsmessage = "<span class='success-message'>" . htmlspecialchars($_GET['skill_success']) . "</span>";
        } elseif (isset($_GET['skill_error'])) {
            $Skillsmessage = "<span class='error-message'>" . htmlspecialchars($_GET['skill_error']) . "</span>";
        }
    
        // Hoofdinformatie container
        $content = "
        <main class='main-2'>
            <h1>Admin Paneel</h1>
            
            <h2>Voeg een Project Toe</h2>
            <form action='/admin/project/create' method='POST' class='form-container'>
                <label for='title'>Titel:</label>
                <input type='text' id='title' name='title' required>
    
                <label for='description'>Beschrijving:</label>
                <textarea id='description' name='description' required></textarea>
    
                <label for='technologies_used'>Technologieën:</label>
                <input type='text' id='technologies_used' name='technologies_used' required>
                
                <label for='project_link'>Project Link:</label>
                <input type='url' id='project_link' name='project_link' placeholder='https://example.com' required>
    
                <label for='github_link'>GitHub Link:</label>
                <input type='url' id='github_link' name='github_link' placeholder='https://github.com/example' required>
    
                <button type='submit'>Voeg Project Toe</button>

                $Projectmessage
            </form>
    
            <h2>Projecten Overzicht</h2>
            <p><strong>Beter te zien op grotere schermen</strong></p>
            <table>
                <tr>
                    <th>Titel</th>
                    <th>Beschrijving</th>
                    <th>Technologieën</th>
                    <th>Project Link</th>
                    <th>GitHub Link</th>
                    <th>Acties</th>
                </tr>";
    
        foreach ($projects as $project) {
            $content .= "
            <tr>
                <td>" . htmlspecialchars($project['title']) . "</td>
                <td>" . htmlspecialchars($project['description']) . "</td>
                <td>" . htmlspecialchars($project['technologies_used']) . "</td>
                <td><a href='" . htmlspecialchars($project['project_link']) . "' target='_blank'>Bekijk Project</a></td>
                <td><a href='" . htmlspecialchars($project['github_link']) . "' target='_blank'>Bekijk op GitHub</a></td>
                <td>
                    <div class=\"actions\">
                        <a href='/admin/editproject?id=" . htmlspecialchars($project['id']) . "'>Bewerk</a>
                        <a href='/admin/deleteproject?id=" . htmlspecialchars($project['id']) . "' onclick='return confirm(\"Weet je zeker dat je dit project wilt verwijderen?\")'>Verwijder</a>
                    </div>
                </td>
            </tr>";
        }
        
        $content .= "</table><br><br>";
        
        // Vaardigheid toevoegen formulier
        $content .= "
        <h2>Voeg een Vaardigheid Toe</h2>
        <form action='/admin/skill/create' method='POST' class='form-container'>
            <label for='skill_name'>Naam Vaardigheid:</label>
            <input type='text' id='skill_name' name='skill_name' required>
            <button type='submit'>Voeg Vaardigheid Toe</button>

            $Skillsmessage
        </form>
        <h2>Vaardigheden Overzicht</h2>
        <table>
            <tr>
                <th>Naam</th>
                <th>Acties</th>
            </tr>";
    
        foreach ($skills as $skill) {
            $content .= "
            <tr>
                <td>" . htmlspecialchars($skill['skill_name']) . "</td>
                <td class='actions'>
                    <a href='/admin/editskill?id=" . htmlspecialchars($skill['id']) . "'>Bewerk</a>
                    <a href='/admin/deleteskill?id=" . htmlspecialchars($skill['id']) . "' onclick='return confirm(\"Weet je zeker dat je deze vaardigheid wilt verwijderen?\")'>Verwijder</a>
                </td>
            </tr>";
        }
    
        $content .= "</table></main>"; // Sluit de container
    
        include(__DIR__ . '/../views/index.view.php');
    }

    // Verwerking van project toevoegen
    public function createProject(): void {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $technologies_used = $_POST['technologies_used'] ?? '';
            $project_link = $_POST['project_link'] ?? '';
            $github_link = $_POST['github_link'] ?? '';

            
            
            $projectAdded = $this->projectModel->addProject($title, $description, $technologies_used, $project_link, $github_link);

            if ($projectAdded) {
                header('Location: /admin?project_success=Project%20successfully%20added');
            } else {
                header('Location: /admin?project_error=Something%20went%20wrong.%20Contact%20developers.');
            }
            exit;
        }
    }

    // Verwerking van skill toevoegen
    public function createSkill(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['skill_name'] ?? '';

            // Check of er al 3 vaardigheden zijn toegevoegd
            $skillAdded = $this->skillModel->addSkill($name);

            if ($skillAdded) {
                header('Location: /admin?skill_success=Skill%20successfully%20added');
            } else {
                header('Location: /admin?skill_error=Limit%20of%203%20skills%20reached');
            }
            exit;
        }
    }

    public function deleteProject(): void {
        $id = $_GET['id'];
        if ($id && is_numeric($id)) {
            $this->projectModel->deleteProject($id);
            header("Location: /admin?deleted");
            exit;
        }
        header("Location: /admin?deleted");
        exit;
    }

    public function deleteSkill(): void {
        $id = $_GET['id'];
        if (is_numeric($id)) {
            $this->skillModel->deleteSkill($id);
            header("Location: /admin?deleted");
        }
        header("Location: /admin?deleted");
        exit;
    }

    public function editProject(): void {
        
        $id = $_GET['id'];

        if (is_numeric($id) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            // Haal alle benodigde waarden op vanuit het formulier
            $title = $_POST['title'];
            $description = $_POST['description'];
            $technologies_used = $_POST['technologies_used'];
            $project_link = $_POST['project_link'];
            $github_link = $_POST['github_link'];
    
            // Roep de updateProject functie aan met alle benodigde parameters
            $this->projectModel->updateProject($id, $title, $description, $technologies_used, $project_link, $github_link);
            
            // Verwijs terug naar de admin pagina
            header("Location: /admin?successEdit");
            exit;
        }
    
        // Haal het project op om voor te vullen in het formulier
        $project = $this->projectModel->getProjectById($id);
        if (!$project) { // Controleer of het project bestaat
            header("HTTP/1.0 404 Not Found"); // Stuur 404 als het project niet bestaat
            exit;
        }
    
        // Laad de bewerkpagina voor het project
        ob_start(); // Start output buffering
        ?>
        <main class="main-2">
            <form action="/admin/editProject?id=<?= $project['id'] ?>" method="POST">
                <label for="title">Titel:</label>
                <input type="text" id="title" name="title" value="<?= htmlspecialchars($project['title']) ?>" required>
                
                <label for="description">Beschrijving:</label>
                <textarea id="description" name="description" required><?= htmlspecialchars($project['description']) ?></textarea>
        
                <label for="technologies_used">Technologieën:</label>
                <input type="text" id="technologies_used" name="technologies_used" value="<?= htmlspecialchars($project['technologies_used']) ?>" required>
        
                <label for="project_link">Project Link:</label>
                <input type="url" id="project_link" name="project_link" value="<?= htmlspecialchars($project['project_link']) ?>" placeholder="https://example.com" required>
        
                <label for="github_link">GitHub Link:</label>
                <input type="url" id="github_link" name="github_link" value="<?= htmlspecialchars($project['github_link']) ?>" placeholder="https://github.com/example" required>
        
                <button type="submit">Update Project</button>
            </form>
        </main>
        <?php
        $content = ob_get_clean(); // Verkrijg de output en stop met bufferen
    
        // Dit geeft de content weer, zorg ervoor dat je deze code toevoegt aan je index.php of het juiste view-bestand
        include(__DIR__ . '/../views/index.view.php'); // Zorg ervoor dat je de juiste view opneemt
    }

    public function editSkill(): void {
        $id = $_GET['id'];
        if (is_numeric($id) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $skill_name = $_POST['skill_name'];
            $this->skillModel->updateSkill($id, $skill_name);
            header("Location: /admin?successEdit");
            exit;
        }

        $skill = $this->skillModel->getSkillById($id);

        if (!$skill) {
            header("location: /404"); // Stuur 404 als de vaardigheid niet bestaat
            exit;
        }

        ob_start();
        ?>
        <main class="main-2">
            <form action="/admin/editSkill?id=<?= htmlspecialchars($skill['id']) ?>" method="POST" class="form-container">
                <label for="skill_name">Naam Vaardigheid:</label>
                <input type="text" id="skill_name" name="skill_name" value="<?= htmlspecialchars($skill['skill_name']) ?>"
                required>
                <button type="submit">Update Skill</button>
            </form>
        </main>
        <?php
        $content = ob_get_clean();

        include(__DIR__ . '/../views/index.view.php');
    }
}
