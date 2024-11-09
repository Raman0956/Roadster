<?php
class CarModel {
    private $db;

    public function __construct() {
        // Assuming a database connection setup here
        $this->db = new PDO("mysql:host=localhost;dbname=roadster", "root", "");
    }

    public function getAllCars() {
        $stmt = $this->db->query("SELECT * FROM carinventory");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCarCategories() {
        $stmt = $this->db->query("SELECT DISTINCT category FROM carinventory");
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function getCarsByCategory($category) {
        $stmt = $this->db->prepare("SELECT * FROM carinventory WHERE category = :category");
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
