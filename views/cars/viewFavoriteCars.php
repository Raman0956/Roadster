<?php
session_start();
require_once 'C:/xampp/htdocs/roadsters/models/FavoriteModel.php';
require_once 'C:/xampp/htdocs/roadsters/views/header.php';

// Ensure the user is logged in
if (!isset($_SESSION['userID'])) {
    header("Location: /roadsters/views/authentication/login.php?redirect=/roadsters/views/cars/viewFavoriteCars.php");
    exit();
}

// Get the logged-in user's ID
$userID = $_SESSION['userID'];

// Fetch favorite cars for the user
$favoriteModel = new FavoriteModel();
$favorites = $favoriteModel->getFavoriteCars($userID);

?>

<!DOCTYPE html>
<html>
<head>
    <title>My Favorite Cars</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Saved Cars</h2>
    <?php if (!empty($favorites)): ?>
        <div class="row">
            <?php foreach ($favorites as $car): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="../../images/<?= htmlspecialchars($car['make']); ?>.png" alt="<?= htmlspecialchars($car['make'] . ' ' . $car['model']); ?>" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($car['make'] . ' ' . $car['model']); ?></h5>
                            <p class="card-text">Year: <?= htmlspecialchars($car['year']); ?></p>
                            <p class="card-text">Price: $<?= htmlspecialchars(number_format($car['price'], 2)); ?></p>
                            <p class="card-text">Category: <?= htmlspecialchars($car['category']); ?></p>
                            <form method="POST" action="/roadsters/controllers/FavoriteController.php">
                                <input type="hidden" name="carID" value="<?= $car['carID']; ?>">
                                <input type="hidden" name="redirect" value="favorites"> <!-- Redirect to favorites after removing -->
                                <button type="submit" name="removeFavorite" class="btn btn-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                        <path d="M8 1.314C3.053-3.248-7.534 4.735 8 15.417c15.534-10.682 4.947-18.665 0-14.103z"/>
                                    </svg>
                                    Remove 
                                </button>

                                <form method="POST" action="/roadsters/controllers/FavoriteController.php">
                                    <input type="hidden" name="carID" value="<?= $car['carID']; ?>">
                                    <button type="submit" name="viewCar" class="btn btn-primary">
                                        View Details
                                    </button>
                                </form>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-center">You have no favorite cars saved. Browse and add some!</p>
    <?php endif; ?>
</div>

<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
