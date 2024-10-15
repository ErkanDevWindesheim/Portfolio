<?php

class ContactController {
    public function index(): void {
        $title = "Contact";
        $content = "
        <main class=\"main-2\">
            <h1>Contact</h1>
            <div class=\"contact-section\">
                <div class=\"contact-box\">
                    <strong>E-mail:</strong><p>1213580@student.windesheim.nl</p>
                    <strong>Social Media:</strong><p>@ErkanWindesheim</p>
                    <strong>School:</strong><p>Windesheim Almere Stad</p>
                </div>
            </div>
        </main>";
        

        include(__DIR__ . "/../views/index.view.php");
    }
}