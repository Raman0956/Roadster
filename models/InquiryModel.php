<?php
require_once 'C:/xampp/htdocs/roadsters/config/database.php';

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
    
    public function addServiceInquiry($userID, $carID = null, $serviceID = null, $message) {
        $query = "INSERT INTO Inquiry (userID, carID, serviceID, message, status) 
                  VALUES (:userID, :carID, :serviceID, :message, 'Pending')";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':carID', $carID);
        $stmt->bindParam(':serviceID', $serviceID);
        $stmt->bindParam(':message', $message);
        return $stmt->execute();
    }

    // Fetch all inquires
    public function getAllInquiries() {
        $query = "
            SELECT 
                i.inquiryID,
                i.userID,
                i.carID,
                c.make,
                c.model,
                s.name AS serviceName,
                u.email,
                i.message,
                i.status
            FROM 
                inquiry i
            LEFT JOIN 
                carinventory c ON i.carID = c.carID
            LEFT JOIN 
                service s ON i.serviceID = s.serviceID
            LEFT JOIN 
                user u ON i.userID = u.userID
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function updateInquiryStatus($inquiryID, $newStatus) {
        $query = "UPDATE inquiry SET status = :status WHERE inquiryID = :inquiryID";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':status', $newStatus);
        $stmt->bindParam(':inquiryID', $inquiryID);
        return $stmt->execute();
    }

 
    
}
