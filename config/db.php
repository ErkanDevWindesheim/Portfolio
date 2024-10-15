<?

define('DB_HOST', 'localhost');  // host, meestal localhost
define('DB_NAME', 'portfoliodb');  // Naam van je database
define('DB_USER', 'root');  // database gebruikersnaam
define('DB_PASS', '+jeVj4qC.~qF&43');  // database wachtwoord

class Database {
    protected $pdo;

    public function __construct() {
        // Probeer de verbinding te maken met de database
        try {
            $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';
            $this->pdo = new PDO($dsn, DB_USER, DB_PASS);
            // Zet PDO error mode naar uitzondering voor foutafhandeling
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Database connection failed: ' . $e->getMessage());
        }
    }

    // een functie om PDO-verbinding op te halen
    public function getConnection() {
        return $this->pdo;
    }
}