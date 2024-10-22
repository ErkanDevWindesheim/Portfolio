<?php

class HomeController {
    public function index(): void {
        $title = "Home";
        $content = "
        <main>
                <section class=\"bio-section\">
                    <h1>Erkan Aslantas</h1>      
                    <p><em>Never jump the fence unless you're willing to face what's on the other side.</em></p>
                    <div class=\"buttons\">
                        <a href=\"/project\">
                            <button class=\"button-style\">
                            <span class=\"material-symbols-outlined\">menu_book</span>
                            Bekijk Portfolio
                            </button>
                        </a>
                        <a href=\"/contact\">
                            <button class=\"button-style\">
                                <span class=\"material-symbols-outlined\">contacts</span>
                            Neem Contact op
                            </button>
                        </a>
                    </div>
                </section>
        </main>";

        include(__DIR__ . "/../views/index.view.php");
    }
}