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

$image_filename = '../../images/' . htmlspecialchars($car['make']) . '.png';
$image_alt = 'Image: ' . htmlspecialchars($car['make']) . '.png';

?>  

<div class="container mt-5">
    <h2 class="text-center">Edit Car</h2>
    <form method="POST" action="/roadsters/controllers/AdminController.php?action=editCar&carID=<?= htmlspecialchars($carID) ?>" enctype="multipart/form-data" class="needs-validation" novalidate>
        
        <!-- Car Details -->
         
        <div class="row mb-3">
        <div class="col-md-6">
            <label for="make" class="form-label">Make</label>
            <input type="text" id="make" name="make" class="form-control" value="<?= htmlspecialchars($car['make']) ?>" required>
        </div>
        <div class="col-md-6">
            <label for="model" class="form-label">Model</label>
            <input type="text" id="model" name="model" class="form-control" value="<?= htmlspecialchars($car['model']) ?>" required>
        </div>
        <div class="col-md-6">
            <label for="year" class="form-label">Year</label>
            <input type="number" id="year" name="year" class="form-control" value="<?= htmlspecialchars($car['year']) ?>" required>
        </div>
        <div class="col-md-6">
            <label for="price" class="form-label">Price</label>
            <input type="number" step="0.01" id="price" name="price" class="form-control" value="<?= htmlspecialchars($car['price']) ?>" required>
        </div>
        </div>
        <div class="row mb-3">
        <div class="col-md-4">
            <label for="category" class="form-label">Category</label>
            <select id="category" name="category" class="form-control" required>
                <option value="SUV" <?= $car['category'] === 'SUV' ? 'selected' : '' ?>>SUV</option>
                <option value="Sedan" <?= $car['category'] === 'Sedan' ? 'selected' : '' ?>>Sedan</option>
                <option value="Truck" <?= $car['category'] === 'Truck' ? 'selected' : '' ?>>Truck</option>
                <option value="Coupe" <?= $car['category'] === 'Coupe' ? 'selected' : '' ?>>Coupe</option>
                <option value="Convertible" <?= $car['category'] === 'Convertible' ? 'selected' : '' ?>>Convertible</option>
            </select>
        </div>
        <div class="col-md-4">
            <label for="leaseOption" class="form-label">Lease Option</label>
            <select id="leaseOption" name="leaseOption" class="form-control" required>
                <option value="1" <?= $car['leaseOption'] ? 'selected' : '' ?>>Available</option>
                <option value="0" <?= !$car['leaseOption'] ? 'selected' : '' ?>>Not Available</option>
            </select>
        </div>
        <div class="col-md-4">
            <label for="financeOption" class="form-label">Finance Option</label>
            <select id="financeOption" name="financeOption" class="form-control" required>
                <option value="1" <?= $car['financeOption'] ? 'selected' : '' ?>>Available</option>
                <option value="0" <?= !$car['financeOption'] ? 'selected' : '' ?>>Not Available</option>
            </select>
        </div>
</div>
        
    <div class = "d-flex justify-content-center mt-4">
    <div class="service-card col-md-6">
        <img class="card-img-top" src="<?= htmlspecialchars($image_filename) ?>" alt="<?= htmlspecialchars($image_alt) ?>" />
    </div>
    <div class="col-md-2 mx-4">
        <label for="fileToUpload">Update Image</label>
        <input type="file" name="fileToUpload" id="fileToUpload">
    </div>
            
        </div>
        <div class = "d-flex justify-content-center mt-4"> 
    <button type="submit" class="btn-stndrd">Update</button>
</div>
</form>

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
