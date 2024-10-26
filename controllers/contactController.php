<?php

require_once __DIR__ . '/../models/contactsModel.php';

class ContactController {

    private $model;

    public function __construct() {
        $this->model = new ContactsModel();
    }

    public function index(): void {
        $title = "Contact";

        // Controleer op succesbericht
        $successMessage = isset($_GET['success']) ? "Bericht succesvol verzonden!" : '';

        $content = "
        <main class=\"main-2\">
            <h1>Contact</h1>
            <section class=\"contact-section\">
                <div class=\"contact-box\">
                    <strong>E-mail:</strong><p>1213580@student.windesheim.nl</p>
                    <strong>Social Media:</strong>
                    <p class=\"social_links\">
                        <a href=\"https://www.linkedin.com/in/erkan-aslantas-38ab86333/\" target=\"_blank\"><img class=\"linkedln\" alt=\"LinkedIn logo\" src=\"/media/tinified/LinkedIn_logo.png\"></a>
                        <a href=\"https://github.com/ErkanDevWindesheim\" target=\"_blank\"><img class=\"github\" alt=\"Github logo\" src=\"/media/tinified/github_logo.png\"></a>
                    </p>
                    <strong>School:</strong><p>Windesheim Almere Stad</p>
                </div>
            </section>";

        // Succesbericht weergeven als het er is
        if ($successMessage) {
            $content .= "<p class=\"success-message\">$successMessage</p>";
        }

        $content .= "
            <form action=\"contact?create\" method=\"POST\" autocomplete=\"on\">
                <label for=\"name\">Naam:</label>
                <input type=\"text\" id=\"name\" name=\"name\" required><br>

                <label for=\"email\">Email:</label>
                <input type=\"email\" id=\"email\" name=\"email\" required><br>

                <label for=\"message\">Bericht:</label>
                <textarea id=\"message\" name=\"message\" required></textarea>

                <button type=\"submit\">verzenden</button>
            </form>
        </main>";

        include(__DIR__ . "/../views/index.view.php");
    }

    public function create(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $message = $_POST['message'] ?? '';

            // Hier zou je validatie en sanitizing moeten toepassen

            $success = $this->model->addContact($name, $email, $message);

            if ($success) {
                header("Location: /contact?success");
                exit;
            } else {
                // Hier kun je een foutmelding toevoegen
                echo "Het toevoegen van contact is mislukt.";
            }
        }
    }
}
