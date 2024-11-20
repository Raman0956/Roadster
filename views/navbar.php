<?php
// Base URL of your project
global $baseURL;
$baseURL = '/roadsters';
?> 

    <!-- Navbar using Bootstrap classes -->
    <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <div >
                <a href="<?= $baseURL; ?>/index.php">
                    <img class="img_logo" src="/roadsters/images/logos/roadsters.png" alt="logo">
                </a>
            </div>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= $baseURL; ?>/index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $baseURL; ?>/views/cars/browse.php">Search</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $baseURL; ?>/views/services/list.php">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $baseURL; ?>/views/contact_us.php">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $baseURL; ?>/views/authentication/login.php">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
