<?php

require_once __DIR__ . '/../models/skillsModel.php';

class OverMijController {

    private $skillModel;

    public function __construct() {
        $this->skillModel = new SkillModel();
    }

    public function index(): void {
        $title = "Over Mij";
        $skills = $this->skillModel->getAllSkills(); // Haal de skills op uit de database
        
        // Bouw de HTML voor de skills dynamisch op
        $skillList = "";
        foreach ($skills as $skill) {
            $skillList .= "<li>" . htmlspecialchars($skill['skill_name']) . "</li>";
        }

        $content = "
        <main class=\"main-2\">
            <h1>Over Mij</h1>
            <div class=\"content-container\">
                <div class=\"bio\">
                    <h2>Erkan Aslantas</h2>
                    <p><strong>Bio:</strong> Achtergrond</p>
                    <button>Download CV</button>
                </div>
                <div class=\"space\"></div>
                <div class=\"skills\">
                    <h2>Skills</h2>
                    <ul class=\"skill-list\">
                        $skillList
                    </ul>
                </div>
            </div>
        </main>";

        include(__DIR__ . '/../views/index.view.php');
    }
}