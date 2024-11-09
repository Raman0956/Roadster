<?php
require_once 'config/Database.php';

class Service {
    private $conn;
    private $table = "service";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Fetch all available services
    public function getServices() {
        $query = "SELECT * FROM " . $this->table . " WHERE promotion = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
