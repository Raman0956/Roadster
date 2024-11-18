<?php
require_once '../../controllers/CarController.php';

$action = $_GET['action'] ?? 'browseCars'; // Default action is browseCars

$carController = new CarController();
$carModel = new CarModel();

switch ($action) {
    case 'browseCars':
        $cars = $carController->browseCars();
        $filters = $carController->getSearchFilters();
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
<div class="search_row">
<!-- Filter Form -->
<form method="GET" action="">
    <input type="hidden" name="action" value="browseCars">
    <label for="make">Make:</label>
    <select id="make" class="form-control form-select mb-4"  name="make">
        <option value="">All</option>
        <?php foreach ($filters['makes'] as $make): ?>
            <option value="<?php echo htmlspecialchars($make); ?>" <?php echo (isset($_GET['make']) && $_GET['make'] == $make) ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($make); ?>
            </option>
        <?php endforeach; ?>
    </select>
    
    <!-- Model Select -->
    <label for="model">Model:</label>
    <select class="form-select"  id="model" name="model">
        <option value="">All</option>
        <?php foreach ($filters['models'] as $model): ?>
            <option value="<?php echo htmlspecialchars($model); ?>" <?php echo (isset($_GET['model']) && $_GET['model'] == $model) ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($model); ?>
            </option>
        <?php endforeach; ?>
    </select>
    
    <!-- Year Select -->
    <label for="year">Year:</label>
    <select class="form-select" id="year" name="year">
        <option value="">All</option>
        <?php foreach ($filters['years'] as $year): ?>
            <option value="<?php echo htmlspecialchars($year); ?>" <?php echo (isset($_GET['year']) && $_GET['year'] == $year) ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($year); ?>
            </option>
        <?php endforeach; ?>
    </select>
    
    <!-- Price Min Input -->
    <label for="price_min">Price Min:</label>
    <input  type="number" id="price_min" name="price_min" value="<?php echo htmlspecialchars($_GET['price_min'] ?? 1000); ?>">
    
    <!-- Price Max Input -->
    <label for="price_max">Price Max:</label>
    <input type="number" id="price_max" name="price_max" value="<?php echo htmlspecialchars($_GET['price_max'] ?? 100000); ?>">

    <button class="btn-stndrd">Search</button>

    </div>
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
