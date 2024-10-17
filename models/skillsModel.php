<?php
require_once __DIR__ . '/../config/db.php';

class SkillModel extends Database {
    public function __construct() {
        parent::__construct();
    }

    public function addSkill($skill_name) {
        $sql = "INSERT INTO skills (skill_name) VALUES (:skill_name)";
        $stmt = $this->pdo->prepare($sql);
        
        // Voer de query uit met de juiste parameter
        return $stmt->execute([
            ':skill_name' => $skill_name
        ]);
    }

    public function deleteSkill(int $id): bool {
        $sql = "DELETE FROM skills WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
    
    public function updateSkill(int $id, string $skill_name): bool {
        $sql = "UPDATE skills SET skill_name = :skill_name WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'id' => $id,
            'skill_name' => $skill_name
        ]);
    }
    
    public function getSkillById(int $id): array {
        $sql = "SELECT * FROM skills WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllSkills() {
        $sql = "SELECT * FROM skills";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
