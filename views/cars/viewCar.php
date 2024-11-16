<?php
require_once 'C:/xampp/htdocs/roadsters/models/CarModel.php';
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
?>

<!DOCTYPE html>
<html>
<head>
    <title>Car Details</title>
</head>
<body>


<div class="container text-center">
<div class="row">
    <div class="col-8"><img src="../../images/<?= htmlspecialchars($car['make']); ?>.png" alt="<?= htmlspecialchars($car['make'] . ' ' . $car['model']); ?>" class="card-img-top"></div>
    <div class="col-4">
        <h3><?= htmlspecialchars($car['make'] . ' ' . $car['model']); ?></h3>
        <p>Year: <?= htmlspecialchars($car['year']); ?></p>
        <p>Price: $<?= htmlspecialchars(number_format($car['price'], 2)); ?></p>
        <p>Category: <?= htmlspecialchars($car['category']); ?></p>
        <p>Lease Option: <?= $car['leaseOption'] ? 'Available' : 'Not Available'; ?></p>
        <p>Finance Option: <?= $car['financeOption'] ? 'Available' : 'Not Available'; ?></p>
        <button class="btn btn-primary" onclick="location.href='/roadsters/views/cars/testDrive.php?carID=<?= $car['carID'] ?>&make=<?= urlencode($car['make']) ?>&model=<?= urlencode($car['model']) ?>'">Book a Test Drive</button>


        <button class="btn btn-primary">Send Inquiry </button> 
    </div>
    
</div>

</body>
</html>
