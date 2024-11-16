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
    <title>Browse Cars</title>
</head>
<body>
<?php require_once '../../views/header.php'; ?>



<h2>Browse Cars</h2>        

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
    <input type="number" id="price_min" name="price_min" value="<?php echo htmlspecialchars($_GET['price_min'] ?? ''); ?>">
    
    <label for="price_max">Price Max:</label>
    <input type="number" id="price_max" name="price_max" value="<?php echo htmlspecialchars($_GET['price_max'] ?? 100000); ?>">

    
    <button type="submit">Search</button>
</form>

<!-- Display Cars -->
<?php if (!empty($cars)): ?>
    <div id="carCarousel" class="carousel row">
        <?php foreach ($cars as $car): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="../../images/<?= htmlspecialchars($car['make']) ?>.png" alt="<?= htmlspecialchars($car['make'] . ' ' . $car['model']) ?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($car['make'] . ' ' . $car['model']) ?></h5>
                        <p class="card-text">Year: <?= htmlspecialchars($car['year']) ?></p>
                        <p class="card-text">Price: $<?= htmlspecialchars(number_format($car['price'], 2)) ?></p>
                    </div>
                </div>
             </div>
        <?php endforeach; ?>
    </div>

<?php else: ?>
    <p>This is empty No cars found. Please adjust your search criteria and try again.</p>
<?php endif; ?>

</body>
</html>
