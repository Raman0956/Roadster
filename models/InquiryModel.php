<?php
require_once '../config/Database.php';

class InquiryModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function inquiry($userID, $carID, $message) {
        // Set default values
        $serviceID = null;
        $response = null;
        $status = 'Pending';
    
        // Correct query spelling for 'response' and remove unused serviceID if needed
        $query = "INSERT INTO Inquiry (userID, carID, serviceID, message, response, status) 
                  VALUES (:userID, :carID, :serviceID, :message, :response, :status)";
    
        $stmt = $this->conn->prepare($query);
    
        // Bind parameters
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->bindParam(':carID', $carID, PDO::PARAM_INT);
        $stmt->bindParam(':serviceID', $serviceID, PDO::PARAM_NULL); // Explicitly bind null for serviceID
        $stmt->bindParam(':message', $message, PDO::PARAM_STR);
        $stmt->bindParam(':response', $response, PDO::PARAM_NULL); // Correct 'response' spelling
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
    
        // Execute the query
        return $stmt->execute();
    }
    
}
