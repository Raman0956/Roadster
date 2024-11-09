<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- For responsive design -->
    <title>Car Dealership</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <!-- Main heading section -->
    <div class="text-center my-4">
        <h2>Welcome to Roadsters</h2>
    </div>

    <!-- Navbar using Bootstrap classes -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto"> <!-- ms-auto aligns the items to the right -->
                    <li class="nav-item">
                        <a class="nav-link" href="../roadsters/index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/browse.php">Search</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/list.php">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact.php">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Bootstrap JS (optional, for dropdowns, modals, etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
