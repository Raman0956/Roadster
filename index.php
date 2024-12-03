<?php
require_once '../roadsters/controllers/CarController.php';

$action = $_GET['action'] ?? 'browseCars'; // Default action is browseCars

$carController = new CarController();

switch ($action) {
    case 'browseCars':
        $carController->browseCars();
        break;
    
}

// Get the selected category from the query parameter (if any)
$selectedCategory = $_GET['category'] ?? null;

// Get cars based on the selected category or fetch all cars if no category is selected
if ($selectedCategory) {
    $allCars = $carController->filterByCategory($selectedCategory);
} else {
    $allCars = $carController->getAllCars();
}

// Get all car categories
$categories = $carController->getCarCategories();
?>

<?php require_once 'views/header.php'; ?>

<!-- Category Filter -->
<div class="container">
    <div class="row">
        <div class="col-12">
            <h4>Browse Categories</h4>
        </div>
    </div>
    <div class="row">
        <?php foreach ($categories as $category): ?>
            <div class="col-md-2 col-sm-4 col-6 mb-3">
                <div class="card text-center">
                    <img src="images/logos/<?= htmlspecialchars($category) ?>.svg" alt="<?= htmlspecialchars($category) ?>" class="card-img-top" style="max-height: 100px; object-fit: contain;">
                    <div class="card-body">
                        <a href="index.php?category=<?= urlencode($category) ?>" class="btn btn-primary"><?= htmlspecialchars($category) ?></a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Car Carousel -->
<div id="carCarousel" class="carousel row">
    <?php foreach ($allCars as $car): ?>
        <div class="col-md-4 mb-4">
            <a href="views/cars/viewCar.php?carID=<?= htmlspecialchars($car['carID']); ?>" class="card-link" style="text-decoration: none; color: inherit;">
                <div class="card">
                    <img src="images/<?= htmlspecialchars($car['make']) ?>.png" alt="<?= htmlspecialchars($car['make'] . ' ' . $car['model']) ?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($car['make'] . ' ' . $car['model']) ?></h5>
                        <p class="card-text">Year: <?= htmlspecialchars($car['year']); ?></p>
                        <p class="card-text">Price: $<?= htmlspecialchars(number_format($car['price'], 2)) ?></p>
                    </div>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>

<?php require_once './views/footer.php'; ?>
