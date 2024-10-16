<?php
require_once __DIR__ . '/../config/db.php';

class ContactsModel extends Database {
    public function __construct() {
        parent::__construct();
    }

    public function addContact($name, $email, $message): bool {
        // Prepared SQL statement to insert contact information
        $sql = "INSERT INTO contacts (name, email, message) VALUES (:name, :email, :message)";
        
        // Prepare the SQL query
        $stmt = $this->pdo->prepare($sql);
    
        // Execute the query with the given parameters
        return $stmt->execute([
            ':name' => $name,    // Match the column 'name'
            ':email' => $email,
            ':message' => $message
        ]);
    }
}