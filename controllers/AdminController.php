<?php
require_once 'C:/xampp/htdocs/roadsters/models/CarModel.php';

session_start();

if ($_SESSION['role'] !== 'Admin') {
    header("Location: /roadsters/views/authentication/login.php");
    exit();
}

$carModel = new CarModel();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['deleteCar'])) {
        $carID = $_POST['carID'] ?? null;
        if ($carID) {
            $carModel->deleteCar($carID);
            echo "<script>
                    alert('Car Deleted Successfully');
                    window.location.href = '/roadsters/views/admin/adminIndex.php';
                </script>";
            exit();
        }
    }

    if (isset($_GET['action']) && $_GET['action'] === 'addCar') {
        // Collect form data for adding a car
        $make = htmlspecialchars(trim($_POST['make'] ?? ''));
        $model = htmlspecialchars(trim($_POST['model'] ?? ''));
        $year = htmlspecialchars(trim($_POST['year'] ?? ''));
        $price = htmlspecialchars(trim($_POST['price'] ?? ''));
        $category = htmlspecialchars(trim($_POST['category'] ?? ''));
        $leaseOption = htmlspecialchars(trim($_POST['leaseOption'] ?? ''));
        $financeOption = htmlspecialchars(trim($_POST['financeOption'] ?? ''));

        // Validate required fields
        if (!empty($make) && !empty($model) && !empty($year) && !empty($price) && !empty($category)) {
            $success = $carModel->addCar($make, $model, $year, $price, $category, $leaseOption, $financeOption);
            if ($success) {
                echo "<script>
                    alert('Car added successfully.');
                    window.location.href = '/roadsters/views/admin/adminIndex.php';
                </script>";
                exit();
            } else {
                echo "Failed to add car. Please try again.";
            }
        } else {
            echo "All fields are required.";
        }
    }

    if (isset($_GET['action']) && $_GET['action'] === 'editCar') {
        // Get carID from query parameters
        $carID = $_GET['carID'] ?? null;

        if (!$carID) {
            echo "Car ID is required.";
            exit();
        }

        // Collect form data
        $make = htmlspecialchars(trim($_POST['make'] ?? ''));
        $model = htmlspecialchars(trim($_POST['model'] ?? ''));
        $year = htmlspecialchars(trim($_POST['year'] ?? ''));
        $price = htmlspecialchars(trim($_POST['price'] ?? ''));
        $category = htmlspecialchars(trim($_POST['category'] ?? ''));
        $leaseOption = htmlspecialchars(trim($_POST['leaseOption'] ?? ''));
        $financeOption = htmlspecialchars(trim($_POST['financeOption'] ?? ''));
        

        // Handle image upload
        if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'C:/xampp/htdocs/roadsters/images/';
            $uploadedFileName = basename($_FILES['fileToUpload']['name']);
            $targetFile = $uploadDir . $uploadedFileName;
        
            // Define the existing car file to be replaced
            $existingCar = $uploadDir . $make . ".png";
        
            // Validate the file type (e.g., only PNG images allowed)
            $allowedTypes = ['image/png'];
            if (in_array($_FILES['fileToUpload']['type'], $allowedTypes)) {
                // Delete the existing file if it exists
                if (file_exists($existingCar)) {
                    if (!unlink($existingCar)) {
                        echo "Error: Could not delete the existing file.";
                        exit();
                    }
                }
        
                // Move the new uploaded file to replace the old one
                if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $existingCar)) {
                    echo "File uploaded and replaced successfully.";
                } else {
                    echo "Error uploading the file.";
                    exit();
                }
            } else {
                echo "Invalid file type. Only PNG files are allowed.";
                exit();
            }
        }
        
        

        // Validate required fields for car data
        if (!empty($make) && !empty($model) && !empty($year) && !empty($price) && !empty($category)) {
            $success = $carModel->updateCar($carID, $make, $model, $year, $price, $category, $leaseOption, $financeOption);
            if ($success) {
                echo "<script>
                    alert('Car updated successfully.');
                    window.location.href = '/roadsters/views/admin/adminIndex.php';
                </script>";
                exit();
            } else {
                echo "Failed to update car. Please try again.";
            }
        } else {
            echo "All fields are required.";
        }
    }
}
