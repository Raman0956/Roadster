<?php
session_start();
require_once 'C:/xampp/htdocs/roadsters/models/CarModel.php';
require_once 'C:/xampp/htdocs/roadsters/views/header.php';

// Ensure the user is logged in and is an admin
if (!isset($_SESSION['userID']) || $_SESSION['role'] !== 'Admin') {
    header("Location: /roadsters/views/authentication/login.php");
    exit();
}

$carModel = new CarModel();

// Fetch all cars for inventory display
$cars = $carModel->getAllCars();
?>

<div class="container my-5">
    <h2 class="text-center mb-4">Inventory Management</h2>
    <div class="d-flex justify-content-end mb-3">
        <button class="btn-stndrd" onclick="location.href='/roadsters/views/admin/addCar.php'">Add New Car</button>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Year</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Lease Option</th>
                    <th>Finance Option</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cars as $car): ?>
                    <tr>
                        <td><?= htmlspecialchars($car['make']); ?></td>
                        <td><?= htmlspecialchars($car['model']); ?></td>
                        <td><?= htmlspecialchars($car['year']); ?></td>
                        <td>$<?= htmlspecialchars(number_format($car['price'], 2)); ?></td>
                        <td><?= htmlspecialchars($car['category']); ?></td>
                        <td class="text-center"><?= $car['leaseOption'] ? 'Yes' : 'No'; ?></td>
                        <td class="text-center"><?= $car['financeOption'] ? 'Yes' : 'No'; ?></td>
                        <td class="text-center">
                            <a href="/roadsters/views/admin/editCar.php?carID=<?= $car['carID']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <form method="POST" action="/roadsters/controllers/AdminController.php" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete <?= htmlspecialchars($car['make']); ?> <?= htmlspecialchars($car['model']); ?>?');">
                                <input type="hidden" name="carID" value="<?= $car['carID']; ?>">
                                <button type="submit" name="deleteCar" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
