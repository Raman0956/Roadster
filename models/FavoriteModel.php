<?php
require_once 'C:/xampp/htdocs/roadsters/config/database.php';

class FavoriteModel {

    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function isCarFavorite($userID, $carID) {
        $query = "SELECT COUNT(*) FROM FavoriteCars WHERE userID = :userID AND carID = :carID";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->bindParam(':carID', $carID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function saveCarAsFavorite($userID, $carID) {
        $query = "INSERT INTO FavoriteCars (userID, carID) VALUES (:userID, :carID)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->bindParam(':carID', $carID, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function removeCarFromFavorite($userID, $carID) {
        $query = "DELETE FROM FavoriteCars WHERE userID = :userID AND carID = :carID";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->bindParam(':carID', $carID, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getFavoriteCars($userID) {
        $query = "SELECT ci.* 
                  FROM FavoriteCars fc
                  JOIN CarInventory ci ON fc.carID = ci.carID
                  WHERE fc.userID = :userID";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
?>
