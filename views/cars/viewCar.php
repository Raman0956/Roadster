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

<?php require_once '../navbar.php'; ?>


<div class="container text-center">
<div class="row pt-5">
    <div class="col-8"><img src="../../images/<?= htmlspecialchars($car['make']); ?>.png" alt="<?= htmlspecialchars($car['make'] . ' ' . $car['model']); ?>" class="card-img-top car-idni"></div>
    <div class="col-4 ">
        <h3><?= htmlspecialchars($car['make'] . ' ' . $car['model']); ?></h3>
        <p class="p-4">Year: <?= htmlspecialchars($car['year']); ?></p>
        <p class="p-4">Price: $<?= htmlspecialchars(number_format($car['price'], 2)); ?></p>
        <p class="p-4">Category: <?= htmlspecialchars($car['category']); ?></p>
        <p class="p-4">Lease Option: <?= $car['leaseOption'] ? 'Available' : 'Not Available'; ?></p>
        <p class="p-4">Finance Option: <?= $car['financeOption'] ? 'Available' : 'Not Available'; ?></p>
        <button class="btn-stndrd" onclick="location.href='/roadsters/views/cars/testDrive.php?carID=<?= $car['carID'] ?>&make=<?= urlencode($car['make']) ?>&model=<?= urlencode($car['model']) ?>'">Book a Test Drive</button>


        <button class="btn-stndrd">Send Inquiry </button> 
    </div>
    
</div>

<?php require_once '../footer.php'; ?>

</body>
</html>