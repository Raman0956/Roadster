<?php
require_once 'config/Database.php';

class Car {
    private $conn;
    private $table = "carinventory";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Fetch cars with optional filters
    public function getCars($filters = []) {
        $query = "SELECT * FROM " . $this->table . " WHERE available = 1";
        
        // Apply filters
        if (!empty($filters['make'])) $query .= " AND make = :make";
        if (!empty($filters['model'])) $query .= " AND model = :model";
        if (!empty($filters['year'])) $query .= " AND year = :year";
        if (!empty($filters['price_min'])) $query .= " AND price >= :price_min";
        if (!empty($filters['price_max'])) $query .= " AND price <= :price_max";
        
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        if (!empty($filters['make'])) $stmt->bindParam(':make', $filters['make']);
        if (!empty($filters['model'])) $stmt->bindParam(':model', $filters['model']);
        if (!empty($filters['year'])) $stmt->bindParam(':year', $filters['year']);
        if (!empty($filters['price_min'])) $stmt->bindParam(':price_min', $filters['price_min']);
        if (!empty($filters['price_max'])) $stmt->bindParam(':price_max', $filters['price_max']);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
