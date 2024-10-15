<?php
require_once __DIR__ . '/../config/db.php';

class ProjectModel extends Database {

    public function __construct() {
        parent::__construct(); // Haalt de PDO-verbinding op uit de Database class
    }

    // CREATE: Voeg een project toe
    public function addProject($title, $description, $technologies, $projectLink, $githubLink) {
        $sql = "INSERT INTO projects (title, description, technologies, project_link, github_link) VALUES (:title, :description, :technologies, :project_link, :github_link)";
        $stmt = $this->pdo->prepare($sql); // Gebruik $this->pdo van de Database class
        return $stmt->execute([
            ':title' => $title,
            ':description' => $description,
            ':technologies' => $technologies,
            ':project_link' => $projectLink,
            ':github_link' => $githubLink
        ]);
    }

    // READ: Haal alle projecten op
    public function getAllProjects() {
        $sql = "SELECT * FROM projects";
        $stmt = $this->pdo->query($sql); // Gebruik $this->pdo
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ: Haal een project op via ID
    public function getProjectById($id) {
        $sql = "SELECT * FROM projects WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE: Werk een project bij
    public function updateProject($id, $title, $description, $technologies, $projectLink, $githubLink) {
        $sql = "UPDATE projects SET title = :title, description = :description, technologies = :technologies, project_link = :project_link, github_link = :github_link WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':title' => $title,
            ':description' => $description,
            ':technologies' => $technologies,
            ':project_link' => $projectLink,
            ':github_link' => $githubLink,
            ':id' => $id
        ]);
    }

    // DELETE: Verwijder een project
    public function deleteProject($id) {
        $sql = "DELETE FROM projects WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
