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
    
    public function getFilteredCars($make = NULL, $model = NULL, $year = NULL, $priceMin = 0, $priceMax = NULL) {
        // Populate $filters with passed arguments
        $filters = [
            'make' => $make,
            'model' => $model,
            'year' => $year,
            'price_min' => $priceMin,
            'price_max' => $priceMax
        ];
    
        // Base query
        $query = "SELECT * FROM CarInventory WHERE available = 1";
    
        // Apply filters dynamically
        if (!empty($filters['make'])) $query .= " AND make = :make";
        if (!empty($filters['model'])) $query .= " AND model = :model";
        if (!empty($filters['year'])) $query .= " AND year = :year";
        if (!empty($filters['price_min'])) $query .= " AND price >= :price_min";
        if (!empty($filters['price_max'])) $query .= " AND price <= :price_max";
    
        // Debugging: Log the query and filters
        error_log("Query: $query");
        error_log("Filters: " . print_r($filters, true));
    
        $stmt = $this->db->prepare($query);
    
        // Bind parameters dynamically
        if (!empty($filters['make'])) $stmt->bindParam(':make', $filters['make']);
        if (!empty($filters['model'])) $stmt->bindParam(':model', $filters['model']);
        if (!empty($filters['year'])) $stmt->bindParam(':year', $filters['year']);
        if (!empty($filters['price_min'])) $stmt->bindParam(':price_min', $filters['price_min']);
        if (!empty($filters['price_max'])) $stmt->bindParam(':price_max', $filters['price_max']);
    
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    


    public function getCarById($carID) {
        $query = 'SELECT * FROM CarInventory WHERE carID = :carID';
        $stmt = $this->db->prepare($query);
        $stmt->execute([':carID' => $carID]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    
}

?>