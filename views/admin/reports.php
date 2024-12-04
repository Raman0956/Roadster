<?php
require_once 'C:/xampp/htdocs/roadsters/views/header.php'; 
require_once 'C:/xampp/htdocs/roadsters/controllers/UserController.php';


if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
    header("Location: /roadsters/index.php");
    exit();
}

$userController = new UserController();
$users = $userController->getAllUsersCount();

?>


<div class="container mt-5">
    <h2 class="text-center">Admin Dashboard</h2>
    <h3>Total number of users in the system </h3>
    <table class="table table-bordered">
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['role']); ?></td>
                    <td><?php echo htmlspecialchars($user['count']); ?></td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>