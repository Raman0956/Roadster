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

    public function getServiceById($serviceID) {
        $query = "SELECT * FROM Service WHERE serviceID = :serviceID";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':serviceID', $serviceID);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function addService($name, $description, $price, $promotion) {
        $query = "INSERT INTO Service (name, description, price, promotion) VALUES (:name, :description, :price, :promotion)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':promotion', $promotion, PDO::PARAM_BOOL);
        return $stmt->execute();
    }

    public function updateService($serviceID, $name, $description, $price, $promotion) {
        $query = "UPDATE Service SET name = :name, description = :description, price = :price, promotion = :promotion WHERE serviceID = :serviceID";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':serviceID', $serviceID);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':promotion', $promotion, PDO::PARAM_BOOL);
        return $stmt->execute();
    }

    public function deleteService($serviceID) {
        $query = "DELETE FROM Service WHERE serviceID = :serviceID";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':serviceID', $serviceID);
        return $stmt->execute();
    }
}
?>
