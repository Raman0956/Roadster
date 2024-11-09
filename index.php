<?php

require('car_inventory_db.php');

$all_categories = get_categories();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <ul>
    <?php foreach($all_categories as $category) : ?>
            <li>
                <?php echo $category['category']; ?>
                </a>
            </li>
            <?php endforeach; ?>    
</ul>
    
</body>
</html>