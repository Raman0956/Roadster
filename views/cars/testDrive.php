<?php 

require_once 'C:/xampp/htdocs/roadsters/views/header.php'; 

// Get car details from query parameters
$carID = $_GET['carID'] ?? '';
$make = $_GET['make'] ?? '';
$model = $_GET['model'] ?? '';
?>

<div class="container mt-5">
<h2 class="text-center">Book a Test Drive</h2>
    <form method="POST" action="/roadsters/controllers/TestDriveController.php?action=bookTestDrive" class="needs-validation" novalidate>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="username" class="form-label">User ID</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="carID" class="form-label">Stock ID</label>
                <input type="text" id="carID" name="carID" value="<?= htmlspecialchars($carID) ?>" class="form-control" readonly>
            </div>
            <div class="col-md-6">
                <label for="make" class="form-label">Make</label>
                <input type="text" id="make" name="make" value="<?= htmlspecialchars($make) ?>" class="form-control" readonly>
            </div>
            <div class="col-md-6">
                <label for="model" class="form-label">Model</label>
                <input type="text" id="model" name="model" value="<?= htmlspecialchars($model) ?>" class="form-control" readonly>
            </div>
        </div>
        <div class="mb-3">
            <label for="preferredDate" class="form-label">Preferred Date</label>
            <input type="date" id="preferredDate" name="preferredDate" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="preferredTime" class="form-label">Preferred Time</label>
            <input type="time" id="preferredTime" name="preferredTime" class="form-control" required>
        </div>
        <div class="d-flex justify-content-center" >
            
        <button type="submit" class="btn-stndrd mt-2">Book Test Drive</button>
        </div>
    </form>
</div>


<?php require_once '../footer.php'; ?>

<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Bootstrap validation script
    (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
</body>
</html>