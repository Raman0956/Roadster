<?php
session_start();
require_once 'C:/xampp/htdocs/roadsters/models/ServiceModel.php';
require_once 'C:/xampp/htdocs/roadsters/views/header.php';

// Ensure the user is an admin
if ($_SESSION['role'] !== 'Admin') {
    header("Location: /roadsters/index.php");
    exit();
}

// Fetch service details
$serviceID = $_GET['serviceID'] ?? null;
if (!$serviceID) {
    echo "No service selected.";
    exit();
}

$serviceModel = new ServiceModel();
$service = $serviceModel->getServiceById($serviceID);
if (!$service) {
    echo "Service not found.";
    exit();
}
?>

<div class="container mt-5">
    <h2 class="text-center">Edit Service</h2>
    <form method="POST" action="/roadsters/controllers/ServiceController.php?action=updateService">
        <input type="hidden" name="serviceID" value="<?= htmlspecialchars($service['serviceID']); ?>">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="name" class="form-label">Service Name</label>
                <input type="text" id="name" name="name" class="form-control" value="<?= htmlspecialchars($service['name']); ?>" required>
            </div>
            <div class="col-md-6">
                <label for="description" class="form-label">Description</label>
                <input type="text" id="description" name="description" class="form-control" value="<?= htmlspecialchars($service['description']); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="price" class="form-label">Price</label>
                <input type="number" step="0.01" id="price" name="price" class="form-control" value="<?= htmlspecialchars($service['price']); ?>" required>
            </div>
            <div class="col-md-6">
                <label for="promotion" class="form-label">Promotion</label>
                <input type="checkbox" id="promotion" name="promotion" <?= $service['promotion'] ? 'checked' : ''; ?>>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update Service</button>
        <a href="/roadsters/views/admin/manageServices.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
