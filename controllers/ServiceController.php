<?php
session_start();
require_once 'C:/xampp/htdocs/roadsters/models/InquiryModel.php';
require_once 'C:/xampp/htdocs/roadsters/models/ServiceModel.php';

class ServiceController {
    
    private $inquiryModel;
    private $serviceModel;

    public function __construct() {
        
        $this->inquiryModel = new InquiryModel();
        $this->serviceModel = new ServiceModel();
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

    public function addService() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $promotion = isset($_POST['promotion']) ? 1 : 0;

            $this->serviceModel->addService($name, $description, $price, $promotion);
            echo "<script>
                    alert('1 new Service added Successfully');
                    window.location.href = '/roadsters/views/admin/manageServices.php';
                </script>";
            
        }
    }

    public function updateService() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $serviceID = $_POST['serviceID'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $promotion = isset($_POST['promotion']) ? 1 : 0;

            $this->serviceModel->updateService($serviceID, $name, $description, $price, $promotion);
            echo "<script>
                    alert('Updated Successfully');
                    window.location.href = '/roadsters/views/admin/manageServices.php';
                </script>";
        }
    }

    public function deleteService() {
        if (isset($_POST['serviceID'])) {
            $serviceID = $_POST['serviceID'];
            $this->serviceModel->deleteService($serviceID);
            echo "<script>
                    alert('Deleted Successfully');
                    window.location.href = '/roadsters/views/admin/manageServices.php';
                </script>";
            
        }
    }
}

// Handle actions
if (isset($_POST['inquireService'])) {
    $controller = new ServiceController();
    $controller->handleServiceInquiry();
}


$action = $_GET['action'] ?? null;
$controller = new ServiceController();

if ($action === 'addService') {
    $controller->addService();
} elseif ($action === 'updateService') {
    $controller->updateService();
} elseif ($action === 'deleteService') {
    $controller->deleteService();
} else {
    echo "Action not found.";
}