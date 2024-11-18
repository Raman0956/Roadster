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

// Determine the title dynamically
$sectionTitle = $selectedCategory ? "You are currently viewing all: " . htmlspecialchars($selectedCategory) ."'s" : "Browse Categories";

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
<div class="container categories-container py-4">
    <div class="row mb-3">
        <div class="col-12 text-center">
        <h4 class="section-title"><?= $sectionTitle ?></h4>
        </div>
    </div>
    <div class="row justify-content-center">
        <?php foreach ($categories as $category): ?>
            <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-4">
                <a href="index.php?category=<?= urlencode($category) ?>" 
                   class="card category-card text-decoration-none <?= ($selectedCategory === $category) ? 'selected' : '' ?>">
                    <img 
                        src="images/logos/<?= htmlspecialchars($category) ?>.svg" 
                        alt="<?= htmlspecialchars($category) ?>" 
                        class="card-img-top">
                    <div class="card-body">
                        <span class="btn category-btn w-100">
                            <?= htmlspecialchars($category) ?>
                        </span>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>




<!-- Car Carousel -->
<div id="carCarousel" class="carousel row">
    <?php foreach ($allCars as $car): ?>
        <div class="car-card col-md-4 mb-4">
            <a class="card-link" href="views/cars/viewCar.php?carID=<?= htmlspecialchars($car['carID']); ?>">
                    <img class="card-img-top" src="images/<?= htmlspecialchars($car['make']) ?>.png" alt="<?= htmlspecialchars($car['make'] . ' ' . $car['model']) ?>" >
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($car['make'] . ' ' . $car['model']) ?></h5>
                        <p class="card-text">Year: <?= htmlspecialchars($car['year']); ?></p>
                        <p class="card-text">Price: $<?= htmlspecialchars(number_format($car['price'], 2)) ?></p>
                    </div>
                
            </a>
        </div>
    <?php endforeach; ?>
</div>

<?php require_once './views/footer.php'; ?>
<!--  Single Image Carousel 
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="position-relative">
                <img id="carouselImage" src="images/<?= htmlspecialchars($allCars[0]['make']) ?>.png" alt="Car Image" class="img-fluid">
                <div class="carousel-buttons justify-content-center">
                    <button class="btn btn-dark" onclick="changeImage(-1)">&#10094;</button>
                    <button class="btn btn-dark" onclick="changeImage(1)">&#10095;</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript for image carousel
    let currentImageIndex = 0;
    const carImages = <?= json_encode(array_column($allCars, 'make')); ?>;

    function changeImage(direction) {
        currentImageIndex += direction;
        if (currentImageIndex < 0) {
            currentImageIndex = carImages.length - 1;
        } else if (currentImageIndex >= carImages.length) {
            currentImageIndex = 0;
        }
        document.getElementById("carouselImage").src = "images/" + carImages[currentImageIndex] + ".png";
    }
</script> -->
