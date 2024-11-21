<?php
// Base URL of your project
global $baseURL;
$baseURL = '/roadsters';
if (session_status() === PHP_SESSION_NONE) {
    // Session has not started, so start it
    session_start();
}
$username = $_SESSION['username'] ?? 'Guest';
$role = $_SESSION['role'] ?? 'Guest'; // Get the user role (default is Guest)
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
            <?php if ($role === 'Admin'): ?>
                    <!-- Admin-specific navigation -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $baseURL; ?>/views/admin/adminIndex.php">Manage Inventory</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $baseURL; ?>/views/admin/users.php">Manage Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $baseURL; ?>/views/admin/users.php">Manage Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $baseURL; ?>/views/admin/reports.php">Reports</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $baseURL; ?>/views/authentication/logout.php">Logout (<?= htmlspecialchars($username) ?>)</a>
                    </li>
                
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $baseURL; ?>/index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $baseURL; ?>/views/cars/browse.php">Search</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $baseURL; ?>/views/services/services.php">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $baseURL; ?>/views/contact_us.php">Contact Us</a>
                </li>
                <?php if (isset($_SESSION['userID'])): ?>
                <li class="nav-item">
                <li class="nav-item">
                    <a class="nav-link" href="<?= $baseURL; ?>/views/cars/viewFavoriteCars.php">Saved Cars</a>
                </li>
                    <a class="nav-link" href="<?= $baseURL; ?>/views/authentication/logout.php">Logout (<?= htmlspecialchars($username) ?>)</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $baseURL; ?>/views/authentication/login.php">Login</a>
                </li>
            <?php endif; ?>
            <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
