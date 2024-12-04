<?php
require_once 'C:/xampp/htdocs/roadsters/models/UserModel.php';

class UserController {
    private $userModel;
    
    public function __construct() {
        $this->userModel = new UserModel();
    }

    // Find a user by username
    public function getUserByUsername($username) {
        return $this->userModel->findUserByUsername($username);
    }

    // Retrieve all users
    public function getAllUsers() {
        return $this->userModel->getAllUsers();
    }

    public function getAllUsersCount() {
        return $this->userModel->getAllUsersCount();
    }

    // Retrieve distinct roles
    public function getDistinctRoles() {
        return $this->userModel->getDistinctRoles();
    }

    // Update a user's role
    public function updateUserRole($userID, $role) {
        return $this->userModel->updateUserRole($userID, $role);
    }

    public function deleteUser($userID) {
        if (empty($userID)) {
            return false; // Handle invalid input
        }
        return $this->userModel->deleteUser($userID);
    }
    public function handlePostRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if the request is to delete a user
            if (isset($_POST['action']) && $_POST['action'] === 'delete') {
                $userID = htmlspecialchars(trim($_POST['userID']));
    
                if (empty($userID)) {
                    header('Location: ../views/admin/manageUsers.php?error=invalid_input');
                    exit();
                }
    
                if ($this->deleteUser($userID)) {
                    header('Location: ../views/admin/manageUsers.php?success=user_deleted');
                } else {
                    header('Location: ../views/admin/manageUsers.php?error=delete_failed');
                }
                exit();
            }
    
            // Existing code for updating a user's role
            $userID = htmlspecialchars(trim($_POST['userID']));
            $role = htmlspecialchars(trim($_POST['role']));
    
            if (empty($userID) || empty($role)) {
                header('Location: ../views/admin/manageUsers.php?error=invalid_input');
                exit();
            }
    
            if ($this->updateUserRole($userID, $role)) {
                header('Location: ../views/admin/manageUsers.php?success=role_updated');
            } else {
                header('Location: ../views/admin/manageUsers.php?error=update_failed');
            }
            exit();
        }
    }
    

    }


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller = new UserController();
        $controller->handlePostRequest();
    }
