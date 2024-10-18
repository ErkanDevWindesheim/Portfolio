<?php

require_once __DIR__ . '/../models/contactsModel.php';

class ContactController {

    private $model;

    public function __construct() {
        $this->model = new ContactsModel();
    }

    public function index(): void {
        $title = "Contact";
        $content = "
        <main class=\"main-2\">
            <h1>Contact</h1>
            <div class=\"contact-section\">
                <div class=\"contact-box\">
                    <strong>E-mail:</strong><p>1213580@student.windesheim.nl</p>
                    <strong>Social Media:</strong>
                    <p class=\"social_links\">
                        <a href=\"https://www.linkedin.com/in/erkan-aslantas-38ab86333/\" alt=\"Linkedln logo\" target=\"_blank\"><img class=\"linkedln\"s src=\"/media/tinified/LinkedIn_logo.png\"></a>
                        <a href=\"https://github.com/ErkanDevWindesheim\" alt=\"Github logo\" target=\"_blank\"><img class=\"github\"s src=\"/media/tinified/github_logo.png\"></a>
                    </p>
                    <strong>School:</strong><p>Windesheim Almere Stad</p>
                </div>
            </div>
            
            <form action=\"contact?create\" method=\"POST\" autocomplete=\"on\">
                <label for=\"name\">Naam:</label><br>
                <input type=\"text\" id=\"name\" name=\"name\" required><br>

                <label for=\"email\">Email:</label><br>
                <input type=\"email\" id=\"email\" name=\"email\" required><br>

                <label for=\"message\">Bericht:</label><br>
                <textarea id=\"message\" name=\"message\" required></textarea><br>

                <button type=\"submit\">verzenden</button>
            </form>
        </main>";
        

        include(__DIR__ . "/../views/index.view.php");
    }

    public function create(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Use 'name' to match the database column, not 'naam'
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $message = $_POST['message'] ?? '';
    
            // Call the model method to add the contact
            $success = $this->model->addContact($name, $email, $message);
    
            if ($success) {
                // Redirect to the contact page
                header("Location: /contact?succuss");
                exit;
            } else {
                // Handle failure case
                echo "Failed to add contact.";
            }
        }
    }
}