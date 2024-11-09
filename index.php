<?php
require_once 'controllers/CarController.php';


// Instantiate the controller
$carController = new CarController();

// Get the selected category from the query parameter (if any)
$selectedCategory = isset($_GET['category']) ? $_GET['category'] : null;

// Get cars based on the selected category or all cars if no category is selected
$allCars = $selectedCategory ? $carController->filterByCategory($selectedCategory) : $carController->getAllCars();

// Get all car categories
$categories = $carController->getCarCategories();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Car Dealership</title><link rel="stylesheet" type="text/css"
    href="main.css">
    <style>
        
    </style>
</head>
<body>
    <h1>Welcome to Our Car Dealership</h1>

    <?php require_once 'views/navbar.php'; ?>

    <!-- Category Filter -->
    <div class="category-filter">
        <a href="index.php" class="category">All</a>
        <?php foreach ($categories as $category): ?>
            <a href="index.php?category=<?= urlencode($category) ?>" class="category"><?= $category ?></a>
        <?php endforeach; ?>


      <!-- Car Carousel -->
      <div id="carCarousel" class="carousel">
        <?php foreach ($allCars as $car): ?>
            <div class="car-card">
               <!--  <img src="<?= $car['image_url'] ?>" alt="<?= htmlspecialchars($car['make'] . ' ' . $car['model']) ?>">  --!>
                <h3><?= htmlspecialchars($car['make'] . ' ' . $car['model']) ?></h3>
                <p>Year: <?= htmlspecialchars($car['year']) ?></p>
                <p>Price: $<?= htmlspecialchars(number_format($car['price'], 2)) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>     
