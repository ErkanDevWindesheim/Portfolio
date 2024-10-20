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
                    <p><strong>Bio:</strong> Naam: Erkan Aslantas
                        Geboortedatum: 13 juli 2001
                        Geboorteplaats: Blaricum, Nederland
                        Nationaliteit: Turks</p>
                    <a href=\"/media/CV_Erkan_Aslantas.pdf\" download>
                        <button>CV downloaden</button>
                    </a>
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