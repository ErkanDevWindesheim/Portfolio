<?php
require_once __DIR__ . '/../config/db.php';

class SkillModel extends Database {
    public function __construct() {
        parent::__construct();
    }

    public function addSkill($skill_name) {
        // Stap 1: Controleer het huidige aantal vaardigheden in de tabel
        $sql = "SELECT COUNT(*) as skill_count FROM skills";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Stap 2: Als er al 3 of meer vaardigheden zijn, geef een foutmelding terug
        if ($result['skill_count'] >= 3) {
            return false; // Geen vaardigheid toevoegen
        }
    
        // Stap 3: Voeg de nieuwe vaardigheid toe als de limiet niet is bereikt
        $sql = "INSERT INTO skills (skill_name) VALUES (:skill_name)";
        $stmt = $this->pdo->prepare($sql);
    
        return $stmt->execute([':skill_name' => $skill_name]);
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
