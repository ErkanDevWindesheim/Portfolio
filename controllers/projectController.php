<?php

class ProjectController {
    public function index(): void {
        $title = "Project";
        $content = "
        <main class=\"main-2\">
            <h1>Projects</h1>
            <div class=\"project-section\">
                <div class=\"project-box\">
                    <h2 class\"project-title\">Titel</h2>
                    <p>Descriptie</p>
                    <button href=\"\">GITHUB LINK</button>
                </div><div class=\"project-box\">
                    <h2 class\"project-title\">Titel</h2>
                    <p>Descriptie</p>
                    <button href=\"\">GITHUB LINK</button>
                </div><div class=\"project-box\">
                    <h2 class\"project-title\">Titel</h2>
                    <p>Descriptie</p>
                    <button href=\"\">GITHUB LINK</button>
                </div><div class=\"project-box\">
                    <h2 class\"project-title\">Titel</h2>
                    <p>Descriptie</p>
                    <button href=\"\">GITHUB LINK</button>
                </div>
            </div>
        </main>";
        
        include(__DIR__ . "/../views/index.view.php");
    }
}