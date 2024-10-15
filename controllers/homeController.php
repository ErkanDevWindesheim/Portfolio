<?php

class HomeController {
    public function index(): void {
        $title = "Home";
        $content = "
        <main>
                <div class=\"bio-section\">
                    <h1>Erkan Aslantas</h1>      
                    <p>orem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <div class=\"buttons\">
                    <a href=\"/project\"><button>Portfolio</button></a>
                    <a href=\"/contact\"><button>Contact</button></a>
                </div>
            </div>
        </main>";

        include(__DIR__ . "/../views/index.view.php");
    }
}