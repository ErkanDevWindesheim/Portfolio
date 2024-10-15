<?php

class OverMijController {
    public function index(): void {
        $title = "Over Mij";
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
                    <li>HTML5</li>
                    <li>CSS3</li>
                    <li>PHP</li><li>PHP</li><li>PHP</li><li>PHP</li>
                </ul>
            </div>
        </main>";

        include(__DIR__ . "/../views/index.view.php");
    }
}