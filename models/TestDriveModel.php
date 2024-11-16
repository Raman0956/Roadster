<?php
require_once '../config/Database.php';

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
}
