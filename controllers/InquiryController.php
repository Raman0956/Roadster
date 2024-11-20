<?php
require_once 'C:/xampp/htdocs/roadsters/models/InquiryModel.php';

class inquiryController {
    private $inquiryModel;

    public function __construct() {
        $this->inquiryModel = new InquiryModel();
    }

    public function inquiry() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve and sanitize input
            $userID = $_POST['userID'];
            $username = htmlspecialchars(trim($_POST['username'] ?? ''));
            $carID = htmlspecialchars(trim($_POST['carID'] ?? ''));
            $make = htmlspecialchars(trim($_POST['make'] ?? ''));
            $model = htmlspecialchars(trim($_POST['model'] ?? ''));
            $message = htmlspecialchars(trim($_POST['message'] ?? ''));
            

            // Basic validation
            if (empty($message)) {
                echo "Please tell us what do you want to inquire about in the text box!";
                return;
            }

            // Save the test drive request
            $success = $this->inquiryModel->inquiry($userID, $carID, $message);

            if ($success) {
                // Redirect to success page
                header('Location: /roadsters/views/cars/confirmation.php');
                exit();
            } else {
                echo "Failed to send inquiry. Please try again.";
            }
        } else {
            echo "Invalid request method.";
        }
    }
}

// Handle action
$action = $_GET['action'] ?? null;
$controller = new InquiryController();

if ($action === 'sendInquiry') {
    $controller->inquiry();
} else {
    echo "Action not found.";
}
