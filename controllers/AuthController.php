<?php
require_once 'C:/xampp/htdocs/roadsters/models/UserModel.php';


class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel(); // Initialize UserModel here
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = htmlspecialchars(trim($_POST['username'] ?? ''));
            $password = htmlspecialchars(trim($_POST['password'] ?? ''));

            if (empty($username) || empty($password)) {
                echo "Both username and password are required.";
                return;
            }

            // Call UserModel to find the user
            $user = $this->userModel->findUserByUsername($username); // Ensure $this->userModel is initialized
            if ($user && hash('sha256', $password) === $user['password']) {
                session_start();
                $_SESSION['userID'] = $user['userID'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                if ($user['role'] === 'Admin') {
                     $redirect = $_GET['redirect'] ?? '/roadsters/views/admin/adminIndex.php';
                } else{
                // Redirect back to the original page
                $redirect = $_GET['redirect'] ?? '/roadsters/index.php';
                }
                
                // Append 'make' and 'model' parameters if they exist in the URL
                if (isset($_GET['make'])) {
                    $redirect .= (strpos($redirect, '?') === false ? '?' : '&') . 'make=' . urlencode($_GET['make']);
                }
                if (isset($_GET['model'])) {
                    $redirect .= (strpos($redirect, '?') === false ? '?' : '&') . 'model=' . urlencode($_GET['model']);
                }
                
                header("Location: $redirect");
                exit();
            } else {
                echo "Invalid username or password.";
            }
        } else {
            echo "Invalid request method.";
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: /roadsters/views/auth/login.php');
        exit();
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = htmlspecialchars(trim($_POST['username']));
            $password = htmlspecialchars(trim($_POST['password']));
            $email = htmlspecialchars(trim($_POST['email']));
            $role = htmlspecialchars(trim($_POST['role']));

            if (empty($username) || empty($email) || empty($password) || empty($role)) {
                echo "All fields are required.";
                return;
            }

            // Check if username is already taken
            if ($this->userModel->isUsernameTaken($username)) {
                echo "The username is already taken. Please choose another one.";
                return;
            }


            $hashedPassword = hash('sha256', $password);
            $success = $this->userModel->createUser($username, $hashedPassword,$email, $role);

            if ($success) {
                echo "<script>
                    alert('Registered Successfully');
                    window.location.href = '/roadsters/views/authentication/login.php';
                </script>";
                
                exit();
            } else {
                echo "Failed to register account. Please try again.";
            }
        }
    }
}

// Handle actions
$action = $_GET['action'] ?? null;
$controller = new AuthController();

if ($action === 'login') {
    $controller->login();
} elseif ($action === 'register') {
    $controller->register();
} else {
    echo "Action not found.";
}
?>
