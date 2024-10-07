<?php

class OverMijController {
    public function index(): void {
        $title = "Over Mij";

        include(__DIR__ . "/../views/index.view.php");
    }
}