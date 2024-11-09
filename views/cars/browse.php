<!DOCTYPE html>
<html>
<head>
    <title>Browse Cars</title>
</head>
<body>
    <h1>Browse Cars</h1>

    <!-- Filter Form -->
    <form method="GET" action="index.php">
        <input type="hidden" name="action" value="browseCars">
        <label>Make:</label> <input type="text" name="make" value="<?php echo $_GET['make'] ?? ''; ?>">
        <label>Model:</label> <input type="text" name="model" value="<?php echo $_GET['model'] ?? ''; ?>">
        <label>Year:</label> <input type="text" name="year" value="<?php echo $_GET['year'] ?? ''; ?>">
        <label>Price Min:</label> <input type="number" name="price_min" value="<?php echo $_GET['price_min'] ?? ''; ?>">
        <label>Price Max:</label> <input type="number" name="price_max" value="<?php echo $_GET['price_max'] ?? ''; ?>">
        <button type="submit">Search</button>
    </form>

    <!-- Display Cars -->
    <?php if (!empty($cars)): ?>
        <ul>
            <?php foreach ($cars as $car): ?>
                <li><?php echo htmlspecialchars($car['make'] . ' ' . $car['model'] . ' (' . $car['year'] . ') - $' . $car['price']); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No cars found.</p>
    <?php endif; ?>
</body>
</html>
