<?php

class ProjectController {
    public function index(): void {
        $title = "Project";
        $HeaderTitle = "Projecten";
        
        include(__DIR__ . "/../views/index.view.php");
    }
}