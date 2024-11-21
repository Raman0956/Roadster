<?php
session_start();
require_once 'C:/xampp/htdocs/roadsters/models/CarModel.php';
require_once 'C:/xampp/htdocs/roadsters/views/header.php';

// Ensure the user is logged in and is an admin
if (!isset($_SESSION['userID']) || $_SESSION['role'] !== 'Admin') {
    header("Location: /roadsters/views/authentication/login.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Car</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Add New Car</h2>
    <form method="POST" action="/roadsters/controllers/AdminController.php?action=addCar" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="make" class="form-label">Make</label>
            <input type="text" id="make" name="make" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="model" class="form-label">Model</label>
            <input type="text" id="model" name="model" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="year" class="form-label">Year</label>
            <input type="number" id="year" name="year" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" step="0.01" id="price" name="price" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select id="category" name="category" class="form-control" required>
                <option value="SUV">SUV</option>
                <option value="Sedan">Sedan</option>
                <option value="Truck">Truck</option>
                <option value="Coupe">Coupe</option>
                <option value="Convertible">Convertible</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="leaseOption" class="form-label">Lease Option</label>
            <select id="leaseOption" name="leaseOption" class="form-control" required>
                <option value="1">Available</option>
                <option value="0">Not Available</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="financeOption" class="form-label">Finance Option</label>
            <select id="financeOption" name="financeOption" class="form-control" required>
                <option value="1">Available</option>
                <option value="0">Not Available</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary w-100">Add Car</button>
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
