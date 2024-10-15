<?php

class ContactController {
    public function index(): void {
        $title = "Contact";
        $HeaderTitle = "Contact pagina";
        

        include(__DIR__ . "/../views/index.view.php");
    }
}