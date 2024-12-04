<?php
require_once 'C:/xampp/htdocs/roadsters/views/header.php'; 
require_once 'C:/xampp/htdocs/roadsters/controllers/UserController.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
    header("Location: /roadsters/index.php");
    exit();
}

if (isset($_GET['success']) || isset($_GET['error'])) {
    $messageType = isset($_GET['success']) ? 'success' : 'error';
    $messageKey = isset($_GET['success']) ? $_GET['success'] : $_GET['error'];
    
    switch ($messageKey) {
        case 'role_updated':
            $message = 'Role has been successfully updated!';
            break;
        case 'user_deleted':
            $message = 'User has been successfully deleted!';
            break;
        case 'update_failed':
            $message = 'Failed to update the role. Please try again.';
            break;
        case 'delete_failed':
            $message = 'Failed to delete the user. Please try again.';
            break;
        case 'invalid_input':
            $message = 'Invalid Input. Please try again.';
            break;
        case 'invalid_user_id':
            $message = 'Invalid User ID. Please check and try again.';
            break;
        default:
            $message = 'An unknown error occurred. Please try again.';
            break;
    }

    echo "<script>alert('$message');</script>";
}




$userController = new UserController();
$users = $userController->getAllUsers();
$userType = $userController->getDistinctRoles();

?>

<div class="container my-5">
    <h2 class="text-center mb-4">Manage Users</h2>
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td class="text-center"><?php echo htmlspecialchars($user['userID']); ?></td>
                        <td class="text-center"><?php echo htmlspecialchars($user['username']); ?></td>
                        <td class="text-center"><?php echo htmlspecialchars($user['email']); ?></td>
                        <td>
                            <form method="POST" action="/roadsters/controllers/UserController.php" class="d-flex justify-content-center">
                                <input type="hidden" name="userID" value="<?php echo htmlspecialchars($user['userID']); ?>">
                                <select name="role" class="form-select my-2">
                                    <?php foreach ($userType as $role): ?>
                                        <option value="<?php echo htmlspecialchars($role); ?>" 
                                            <?php echo $user['role'] === $role ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($role); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <button type="submit" class="btn btn-warning btn-sm ms-2 my-2">Update</button>
                            </form>
                        </td>
                        <td class="text-center">
                            <form method="POST" action="/roadsters/controllers/UserController.php" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                <input type="hidden" name="userID" value="<?php echo htmlspecialchars($user['userID']); ?>">
                                <input type="hidden" name="action" value="delete">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

