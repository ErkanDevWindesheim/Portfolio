<?php

class HomeController {
    public function index(): void {
        $title = "Home";
        $content = "
        <main>
                <div class=\"bio-section\">
                    <h1>Erkan Aslantas</h1>      
                    <p><i>Never jump the fence unless you're willing to face what's on the other side.</i></p>
                <div class=\"buttons\">
                    <a href=\"/project\"><button>Bekijk Portfolio</button></a>
                    <a href=\"/contact\">
                        <button style=\"display: flex; align-items: center; justify-content: space-between; padding: 10px 20px; border: none;\">
                            <img src=\"media/mail.png\" alt=\"My Icon\" class=\"icon-contact\">
                        Neem Contact op
                        </button>
                    </a>
                </div>
            </div>
        </main>";

        include(__DIR__ . "/../views/index.view.php");
    }
}