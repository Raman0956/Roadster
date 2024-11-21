<?php
session_start();
require_once 'C:/xampp/htdocs/roadsters/models/CarModel.php';
require_once 'C:/xampp/htdocs/roadsters/views/header.php';

// Ensure the user is logged in and is an admin
if (!isset($_SESSION['userID']) || $_SESSION['role'] !== 'Admin') {
    header("Location: /roadsters/views/authentication/login.php");
    exit();
}

// Get carID from query parameters
$carID = $_GET['carID'] ?? null;

if (!$carID) {
    echo "Car ID is required.";
    exit();
}

// Fetch car details
$carModel = new CarModel();
$car = $carModel->getCarById($carID);

if (!$car) {
    echo "Car not found.";
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Car</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Edit Car</h2>
    <form method="POST" action="/roadsters/controllers/AdminController.php?action=editCar&carID=<?= $carID ?>" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="make" class="form-label">Make</label>
            <input type="text" id="make" name="make" class="form-control" value="<?= htmlspecialchars($car['make']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="model" class="form-label">Model</label>
            <input type="text" id="model" name="model" class="form-control" value="<?= htmlspecialchars($car['model']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="year" class="form-label">Year</label>
            <input type="number" id="year" name="year" class="form-control" value="<?= htmlspecialchars($car['year']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" step="0.01" id="price" name="price" class="form-control" value="<?= htmlspecialchars($car['price']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select id="category" name="category" class="form-control" required>
                <option value="SUV" <?= $car['category'] === 'SUV' ? 'selected' : '' ?>>SUV</option>
                <option value="Sedan" <?= $car['category'] === 'Sedan' ? 'selected' : '' ?>>Sedan</option>
                <option value="Truck" <?= $car['category'] === 'Truck' ? 'selected' : '' ?>>Truck</option>
                <option value="Coupe" <?= $car['category'] === 'Coupe' ? 'selected' : '' ?>>Coupe</option>
                <option value="Convertible" <?= $car['category'] === 'Convertible' ? 'selected' : '' ?>>Convertible</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="leaseOption" class="form-label">Lease Option</label>
            <select id="leaseOption" name="leaseOption" class="form-control" required>
                <option value="1" <?= $car['leaseOption'] ? 'selected' : '' ?>>Available</option>
                <option value="0" <?= !$car['leaseOption'] ? 'selected' : '' ?>>Not Available</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="financeOption" class="form-label">Finance Option</label>
            <select id="financeOption" name="financeOption" class="form-control" required>
                <option value="1" <?= $car['financeOption'] ? 'selected' : '' ?>>Available</option>
                <option value="0" <?= !$car['financeOption'] ? 'selected' : '' ?>>Not Available</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary w-100">Save Changes</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    (function () {
        'use strict';
        var forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>
</body>
</html>
