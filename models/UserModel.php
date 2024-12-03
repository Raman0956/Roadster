<?php
require_once 'C:/xampp/htdocs/roadsters/config/database.php';

class UserModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function findUserByUsername($username) {
        $query = "SELECT * FROM user WHERE username = :username LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser($username, $password,$email, $role) {
        try {
            $query = "INSERT INTO user (username, password, email, role) VALUES (:username,:password,:email, :role)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':role', $role);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error creating user: " . $e->getMessage());
            return false;
        }
    }

    public function isUsernameTaken($username) {
        $query = "SELECT COUNT(*) FROM user WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetchColumn() > 0; // Returns true if username exists
    }

    public function getAllUsers() {
        $query = "SELECT userID, username, email, role FROM user";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDistinctRoles() {
        $query = "SELECT DISTINCT role FROM user";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN); // Returns an array of roles
    }

    public function updateUserRole($userID, $role) {
        $query = "UPDATE user SET role = :role WHERE userID = :userID";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':userID', $userID);
        return $stmt->execute();
    }

    public function deleteUser($userID) {
        $query = "DELETE FROM user WHERE userID = :userID";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        return $stmt->execute();
    }

}

?>
