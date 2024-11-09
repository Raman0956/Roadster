<!DOCTYPE html>
<html>
<head>
    <title>Our Services and Promotions</title>
</head>
<body>
    <h1>Services and Promotions</h1>

    <?php if (!empty($services)): ?>
        <ul>
            <?php foreach ($services as $service): ?>
                <li><?php echo htmlspecialchars($service['name'] . ': ' . $service['description'] . ' - $' . $service['price']); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No services or promotions available.</p>
    <?php endif; ?>
</body>
</html>
