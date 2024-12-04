<?php
session_start();
require_once 'C:/xampp/htdocs/roadsters/models/ServiceModel.php';
require_once 'C:/xampp/htdocs/roadsters/views/header.php';

// Fetch all services
$serviceModel = new ServiceModel();
$services = $serviceModel->getAllServices();

// Get logged-in user ID
$userID = $_SESSION['userID'] ?? null;
require_once '../../views/header.php'; 

?>

<div class="container-fluid mt-5">
    <div class="row service-container">
        <!-- Services List -->
        <div class="col-md-6 service-list">
            <h2 class="text-center">Our Services</h2>
            <?php if (!empty($services)): ?>
                <?php foreach ($services as $service): ?>
                    <div class="service-card">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($service['name']); ?></h5>
                            <p class="card-text"><?= htmlspecialchars($service['description']); ?></p>
                            <p class="card-text">Price: $<?= htmlspecialchars(number_format($service['price'], 2)); ?></p>
                            <?php if ($service['promotion']): ?>
                                <p class="text-success">Promotion Available!</p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">No services available at the moment. Please check back later!</p>
            <?php endif; ?>
        </div>

        <!-- Inquiry Form -->
        <div class="col-md-6 inquiry-form">
            <h2 class="text-center">Inquire About a Service</h2>
            <?php if ($userID): ?>
            <form method="POST" action="/roadsters/controllers/ServiceController.php" class="needs-validation" novalidate>
                <div class="mb-3">
                    <label for="serviceID" class="form-label">Select a Service</label>
                    <select id="serviceID" name="serviceID" class="form-control" required>
                        <option value="" disabled selected>Select a service</option>
                        <?php foreach ($services as $service): ?>
                            <option value="<?= $service['serviceID']; ?>"><?= htmlspecialchars($service['name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">Please select a service.</div>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea id="message" name="message" class="form-control" rows="4" required placeholder="Need a Service Appointment? Send us a message."></textarea>
                    <div class="invalid-feedback">Please enter a message.</div>
                </div>
                <div class = "d-flex justify-content-center mt-4">
                    
                <button type="submit" name="inquireService" class="btn-stndrd">Submit Inquiry</button>
             
        </div>
            </form>
            
            <?php else: ?>
                <p class="text-center mt-5">
                    <a href="/roadsters/views/authentication/login.php?redirect=/roadsters/views/services/services.php" class="btn-stndrd">Login to Inquire</a>
                </p>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    (function () {
        'use strict';
        var forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>
</body>
</html>
