<?php
require_once '../../controllers/CarController.php';

$action = $_GET['action'] ?? 'browseCars'; // Default action is browseCars

$carController = new CarController();

switch ($action) {
    case 'browseCars':
        $cars = $carController->browseCars();
        break;
    
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Cars</title>
</head>
<body>
<?php require_once '../../views/header.php'; ?>



<h2>Search Cars</h2>        

<!-- Filter Form -->
<form method="GET" action="">
    <input type="hidden" name="action" value="browseCars">
    <label for="make">Make:</label>
    <input type="text" id="make" name="make" value="<?php echo htmlspecialchars($_GET['make'] ?? ''); ?>">
    
    <label for="model">Model:</label>
    <input type="text" id="model" name="model" value="<?php echo htmlspecialchars($_GET['model'] ?? ''); ?>">
    
    <label for="year">Year:</label>
    <input type="text" id="year" name="year" value="<?php echo htmlspecialchars($_GET['year'] ?? ''); ?>">
    
    <label for="price_min">Price Min:</label>
    <input type="number" id="price_min" name="price_min" value="<?php echo htmlspecialchars($_GET['price_min'] ?? 1000); ?>">
    
    <label for="price_max">Price Max:</label>
    <input type="number" id="price_max" name="price_max" value="<?php echo htmlspecialchars($_GET['price_max'] ?? 100000); ?>">

    
    <button class="btn-stndrd">Search</button>
</form>

<!-- Display Cars -->
<?php if (!empty($cars)): ?>
    <div id="carCarousel" class="carousel row search_page">
        <?php foreach ($cars as $car): ?>
            <div class="car-card col-md-4 mb-4">
                <a class="card-link" href="viewCar.php?carID=<?= htmlspecialchars($car['carID']); ?>">
                   
                        <img src="../../images/<?= htmlspecialchars($car['make']) ?>.png" alt="<?= htmlspecialchars($car['make'] . ' ' . $car['model']) ?>" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($car['make'] . ' ' . $car['model']) ?></h5>
                            <p class="card-text">Year: <?= htmlspecialchars($car['year']) ?></p>
                            <p class="card-text">Price: $<?= htmlspecialchars(number_format($car['price'], 2)) ?></p>
                        </div>
                    
                </a>
            </div>
        <?php endforeach; ?>
    </div>

<?php else: ?>
    <p>No cars found. Please adjust your search criteria and try again.</p>
<?php endif; ?>


</body>
</html>
