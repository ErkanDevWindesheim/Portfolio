<?php

class ProjectController {
    public function index(): void {
        $title = "Project";
        
        include(__DIR__ . "/../views/index.view.php");
    }
}