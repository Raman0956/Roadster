<?php 
require_once 'C:/xampp/htdocs/roadsters/views/header.php'; 
require_once 'C:/xampp/htdocs/roadsters/models/ServiceModel.php';
    
    if ($_SESSION['role'] !== 'Admin') {
        header("Location: /roadsters/index.php");
        exit();
    }
    $serviceModel = new ServiceModel();

    // Fetch all cars for inventory display
    $services = $serviceModel->getAllServices();
?>

<div class="container mt-5">
    <h2 class="text-center">Manage Services</h2>

    <!-- Add Service Form -->
    <form method="POST" action="/roadsters/controllers/ServiceController.php?action=addService" class="mb-5">
        <h4>Add Service</h4>
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="name" class="form-control" placeholder="Service Name" required>
            </div>
            <div class="col-md-4">
                <input type="text" name="description" class="form-control" placeholder="Description">
            </div>
            <div class="col-md-2">
                <input type="number" step="0.01" name="price" class="form-control" placeholder="Price" required>
            </div>
            <div class="col-md-2">
                <label>
                    <input type="checkbox" name="promotion"> Promotion
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Add Service</button>
    </form>

    <!-- Service List -->
    <h4>Existing Services</h4>
    <table class="table table-bordered">
        
            <tr>
                <th>Service Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Promotion</th>
                <th></th>
            </tr>
        
            <?php foreach ($services as $service): ?>
                <tr>
                    <td><?= htmlspecialchars($service['name']); ?></td>
                    <td><?= htmlspecialchars($service['description']); ?></td>
                    <td>$<?= htmlspecialchars(number_format($service['price'], 2)); ?></td>
                    <td><?= $service['promotion'] ? 'Yes' : 'No'; ?></td>

                    <td>
                        <a href="/roadsters/views/admin/editService.php?serviceID=<?= $service['serviceID']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <form method="POST" action="/roadsters/controllers/ServiceController.php?action=deleteService" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete <?php echo ($service['name']); ?>?');">
                            <input type="hidden" name="serviceID" value="<?= $service['serviceID']; ?>">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>

                </tr>
            <?php endforeach; ?>
        
    </table>
</div>
