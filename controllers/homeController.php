<?php

class HomeController {
    public function index(): void {
        $title = "Home";

        include(__DIR__ . "/../views/index.view.php");
    }
}