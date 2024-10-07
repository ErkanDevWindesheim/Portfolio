<?php

class ContactController {
    public function index(): void {
        $title = "Contact";
        

        include(__DIR__ . "/../views/index.view.php");
    }
}