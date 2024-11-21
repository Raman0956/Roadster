<?php
session_start();
require_once 'C:/xampp/htdocs/roadsters/models/InquiryModel.php';

class ServiceController {
    
    private $inquiryModel;

    public function __construct() {
        
        $this->inquiryModel = new InquiryModel();
    }

    public function handleServiceInquiry() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userID = $_SESSION['userID'] ?? null;
            $serviceID = $_POST['serviceID'] ?? null;
            $message = htmlspecialchars(trim($_POST['message']));

            // Check if user is logged in
            if (!$userID) {
                // Redirect to login page with the current page as redirect URL
                $redirectUrl = urlencode('/roadsters/views/services/services.php');
                header("Location: /roadsters/views/authentication/login.php?redirect=$redirectUrl");
                exit();
            }
            
            if ($userID && $serviceID && $message) {
                $success = $this->inquiryModel->addServiceInquiry($userID, null, $serviceID, $message);   
            } 

            if ($success) {
                // Redirect to success page
                header('Location: /roadsters/views/cars/confirmation.php');
                exit();
            } else {
                echo "Failed to send inquiry. Please try again.";
            }
        }
    }
}

// Handle actions
if (isset($_POST['inquireService'])) {
    $controller = new ServiceController();
    $controller->handleServiceInquiry();
}