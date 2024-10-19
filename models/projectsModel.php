<?php
require_once __DIR__ . '/../config/db.php';

class ProjectModel extends Database {

    public function __construct() {
        parent::__construct(); // Haalt de PDO-verbinding op uit de Database class
    }

    // CREATE: Voeg een project toe
    public function addProject($title, $description, $technologies_used, $project_link, $github_link) {
        $sql = "INSERT INTO projects (title, description, technologies_used, project_link, github_link) 
                VALUES (:title, :description, :technologies_used, :project_link, :github_link)";
        
        // Voorbereiden van de SQL-statement
        $stmt = $this->pdo->prepare($sql);
    
        // Voer de query uit met de juiste parameters
        return $stmt->execute([
            ':title' => $title,
            ':description' => $description,
            ':technologies_used' => $technologies_used,
            ':project_link' => $project_link,
            ':github_link' => $github_link
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
    public function updateProject($id, $title, $description, $technologies_used, $project_link, $github_link): bool {
        $sql = "UPDATE projects SET 
                title = :title, 
                description = :description, 
                technologies_used = :technologies_used, 
                project_link = :project_link, 
                github_link = :github_link 
                WHERE id = :id";
    
        $stmt = $this->pdo->prepare($sql);
    
        // Bind de parameters aan de query
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':technologies_used', $technologies_used);
        $stmt->bindParam(':project_link', $project_link);
        $stmt->bindParam(':github_link', $github_link);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
        // Voer de query uit
        return $stmt->execute();
    }
    

    // DELETE: Verwijder een project
    public function deleteProject($id) {
        $sql = "DELETE FROM projects WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    // READ: Haal projecten op op basis van technologie
    public function getProjectsByTechnology($technology) {
        // Bouw de LIKE-query met spaties en komma's aan beide zijden van de technologie
        $sql = "SELECT * FROM projects 
                WHERE technologies_used LIKE :technology 
                OR technologies_used LIKE :technology_start 
                OR technologies_used LIKE :technology_end 
                OR technologies_used LIKE :technology_exact";
    
        $stmt = $this->pdo->prepare($sql);
    
        // Plaats houders voor technologieën met verschillende patronen
        $stmt->execute([
            ':technology' => "%, " . $technology . ",%",
            ':technology_start' => $technology . ",%",
            ':technology_end' => "%, " . $technology,
            ':technology_exact' => $technology
        ]);
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
