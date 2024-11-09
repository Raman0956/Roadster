<?php
require_once 'controllers/CarController.php';

// Instantiate the controller
$carController = new CarController();

// Get the selected category from the query parameter (if any)
if (isset($_GET['category'])) {
    $selectedCategory = $_GET['category'];
    $carouselDisplay = 'flex'; // Show carousel when a category is selected
} else {
    $selectedCategory = null;
    $carouselDisplay = 'none'; // Hide carousel when no category is selected
}

// Get cars based on the selected category or all cars if no category is selected
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
<div id="carCarousel" class="carousel row" style="display: <?= htmlspecialchars($carouselDisplay) ?>;">
    <?php foreach ($allCars as $car): ?>
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="images/<?= htmlspecialchars($car['make']) ?>.png" alt="<?= htmlspecialchars($car['make'] . ' ' . $car['model']) ?>" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($car['make'] . ' ' . $car['model']) ?></h5>
                    <p class="card-text">Year: <?= htmlspecialchars($car['year']) ?></p>
                    <p class="card-text">Price: $<?= htmlspecialchars(number_format($car['price'], 2)) ?></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Single Image Carousel at the Bottom -->
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
    // Initial settings
    var currentImageIndex = 0;
    var carImages = <?php echo json_encode(array_column($allCars, 'make')); ?>; // Get car makes

    function changeImage(direction) {
        currentImageIndex += direction;
        if (currentImageIndex < 0) {
            currentImageIndex = carImages.length - 1;
        } else if (currentImageIndex >= carImages.length) {
            currentImageIndex = 0;
        }
        document.getElementById("carouselImage").src = "images/" + carImages[currentImageIndex] + ".png";
    }

    // Show carousel when a category link is clicked
    var categoryLinks = document.querySelectorAll('.category');
    categoryLinks.forEach(function(link) {
        link.addEventListener('click', function() {
            document.getElementById("carCarousel").style.display = 'flex';  // Show the carousel
        });
    });
</script>

