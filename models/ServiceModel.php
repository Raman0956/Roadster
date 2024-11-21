<?php
require_once 'C:/xampp/htdocs/roadsters/config/database.php';

class ServiceModel {
    private $conn;
    private $table = "service";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Fetch all available services
    public function getAllServices() {
        $query = "SELECT * FROM Service";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
