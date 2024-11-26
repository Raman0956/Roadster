<?php
require_once 'C:/xampp/htdocs/roadsters/config/database.php';

class TestDriveModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function bookTestDrive($userID, $carID, $preferredDate, $preferredTime) {
        $query = "INSERT INTO testdrivebooking (userID, carID, preferredDate, preferredTime) 
                  VALUES (:userID, :carID, :preferredDate, :preferredTime)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':carID', $carID);
        $stmt->bindParam(':preferredDate', $preferredDate);
        $stmt->bindParam(':preferredTime', $preferredTime);

        return $stmt->execute();
    }


    // Fetch all inquires
    public function getAllTestDriveInquiries() {
        $query = "
            SELECT
                t.bookingID, 
                t.userID,
                t.carID,
                c.make,
                c.model,
                u.email,
                t.preferredDate,
                t.preferredTime,
                t.status
            FROM 
                testdrivebooking t
            LEFT JOIN 
                carinventory c ON t.carID = c.carID
            LEFT JOIN 
                user u ON t.userID = u.userID
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateBookingStatus($bookingID, $newStatus) {
        $query = "UPDATE testdrivebooking SET status = :status WHERE bookingID = :bookingID";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':status', $newStatus);
        $stmt->bindParam(':bookingID', $bookingID);
        return $stmt->execute();
    }
    
}
