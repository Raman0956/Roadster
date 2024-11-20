<?php
require_once 'C:/xampp/htdocs/roadsters/models/TestDriveModel.php';

class TestDriveController {
    private $testDriveModel;

    public function __construct() {
        $this->testDriveModel = new TestDriveModel();
    }

    public function bookTestDrive() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve and sanitize input
            $userID = $_POST['userID'];
            $username = htmlspecialchars(trim($_POST['username'] ?? ''));
            $carID = htmlspecialchars(trim($_POST['carID'] ?? ''));
            $make = htmlspecialchars(trim($_POST['make'] ?? ''));
            $model = htmlspecialchars(trim($_POST['model'] ?? ''));
            $preferredDate = htmlspecialchars(trim($_POST['preferredDate'] ?? ''));
            $preferredTime = htmlspecialchars(trim($_POST['preferredTime'] ?? ''));

            // Basic validation
            if (empty($userID) || empty($carID) || empty($make) || empty($model) || empty($preferredDate) || empty($preferredTime)) {
                echo "All fields are required.";
                return;
            }

            // Save the test drive request
            $success = $this->testDriveModel->bookTestDrive($userID, $carID, $preferredDate, $preferredTime);

            if ($success) {
                // Redirect to success page
                header('Location: /roadsters/views/cars/confirmation.php');
                exit();
            } else {
                echo "Failed to book the test drive. Please try again.";
            }
        } else {
            echo "Invalid request method.";
        }
    }
}

// Handle action
$action = $_GET['action'] ?? null;
$controller = new TestDriveController();

if ($action === 'bookTestDrive') {
    $controller->bookTestDrive();
} else {
    echo "Action not found.";
}
