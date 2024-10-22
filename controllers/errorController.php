<?php


class errorController {
    

    public function index() {

        $title = "404 error";

        ob_start();
        include __DIR__ . '/../views/php/404.view.php';
        $content = ob_get_clean(); // Sla de output op in $content

        include(__DIR__ . "/../views/index.view.php");
    }
}