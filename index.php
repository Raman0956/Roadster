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
    <title>Car Dealership</title>
    <style>
        /* Basic styling */
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; }
        .category-filter, .carousel { margin-bottom: 20px; }
        
        /* Styling for categories */
        .category { display: inline-block; padding: 10px 15px; background-color: #007bff; color: white; margin: 5px; border-radius: 5px; cursor: pointer; text-decoration: none; }
        .category:hover { background-color: #0056b3; }

        /* Carousel styling */
        .carousel { display: flex; overflow-x: auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px; }
        .car-card { flex: 0 0 auto; width: 200px; margin-right: 15px; padding: 10px; border: 1px solid #ddd; border-radius: 5px; text-align: center; }
        .car-card img { max-width: 100%; height: auto; border-radius: 5px; }
    </style>
</head>
<body>
    <h1>Welcome to Our Car Dealership</h1>

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
