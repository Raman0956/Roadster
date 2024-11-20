<?php

session_start();
require_once 'C:/xampp/htdocs/roadsters/models/CarModel.php';
require_once 'C:/xampp/htdocs/roadsters/models/FavoriteModel.php';
require_once 'C:/xampp/htdocs/roadsters/views/header.php';

// Check if carID is provided
$carID = $_GET['carID'] ?? null;

if (!$carID) {
    echo "No car selected.";
    exit;
}

// Fetch car details
$carModel = new CarModel();
$car = $carModel->getCarById($carID);

if (!$car) {
    echo "Car not found.";
    exit;
}

// Check if the car is in the user's favorites
$isFavorite = false;
if (isset($_SESSION['userID'])) {
    $favoriteModel = new FavoriteModel();
    $isFavorite = $favoriteModel->isCarFavorite($_SESSION['userID'], $carID);
}

?>

<?php require_once '../navbar.php'; ?>




<div class="container text-center">
<div class="row pt-6">
    <div class="col-8"><img src="../../images/<?= htmlspecialchars($car['make']); ?>.png" alt="<?= htmlspecialchars($car['make'] . ' ' . $car['model']); ?>" class="card-img-top car-idni"></div>
    <div class="col-4 ">
        <h3><?= htmlspecialchars($car['make'] . ' ' . $car['model']); ?></h3>
        <p class="p-6">Year: <?= htmlspecialchars($car['year']); ?></p>
        <p class="p-6">Price: $<?= htmlspecialchars(number_format($car['price'], 2)); ?></p>
        <p class="p-6">Category: <?= htmlspecialchars($car['category']); ?></p>
        <p class="p-6">Lease Option: <?= $car['leaseOption'] ? 'Available' : 'Not Available'; ?></p>
        <p class="p-6">Finance Option: <?= $car['financeOption'] ? 'Available' : 'Not Available'; ?></p>

        <p class="p-6">
        <!-- Save/Remove Favorite Button -->
        <?php if (isset($_SESSION['userID'])): ?>
                <form method="POST" action="/roadsters/controllers/FavoriteController.php">
                    <input type="hidden" name="carID" value="<?= $car['carID'] ?>">
                    <?php if ($isFavorite): ?>
                        <button type="submit" name="removeFavorite" class="btn btn-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                <path d="M8 1.314C3.053-3.248-7.534 4.735 8 15.417c15.534-10.682 4.947-18.665 0-14.103z"/>
                            </svg>
                            Saved
                        </button>
                    <?php else: ?>
                        <button type="submit" name="saveCar" class="btn btn-light">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                            </svg>
                            Save this Car
                        </button>
                    <?php endif; ?>
                </form>
            <?php endif; ?>


        <?php if (isset($_SESSION['userID'])): ?>
                <button class="btn-stndrd" onclick="location.href='/roadsters/views/cars/testDrive.php?carID=<?= $car['carID'] ?>&make=<?= urlencode($car['make']) ?>&model=<?= urlencode($car['model']) ?>'">Book a Test Drive</button>
            <?php else: ?>
                <button class="btn-stndrd" onclick="location.href='/roadsters/views/authentication/login.php?redirect=/roadsters/views/cars/testDrive.php?carID=<?= $car['carID'] ?>&make=<?= urlencode($car['make']) ?>&model=<?= urlencode($car['model']) ?>'">Login to Book</button>
            <?php endif; ?>

        <?php if (isset($_SESSION['userID'])): ?>
                <button class="btn-stndrd" onclick="location.href='/roadsters/views/cars/inquiry.php?carID=<?= $car['carID'] ?>&make=<?= urlencode($car['make']) ?>&model=<?= urlencode($car['model']) ?>'">Send Inquiry</button>
            <?php else: ?>
                <button class="btn-stndrd" onclick="location.href='/roadsters/views/authentication/login.php?redirect=/roadsters/views/cars/inquiry.php?carID=<?= $car['carID'] ?>&make=<?= urlencode($car['make']) ?>&model=<?= urlencode($car['model']) ?>'">Login to send Inquiry</button>
            <?php endif; ?>
                
    </div>
    
</div>

<?php require_once '../footer.php'; ?>

</body>
</html>
