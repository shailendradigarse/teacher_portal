<!-- authenticate.php -->
<?php
session_start();
require_once 'includes/auth_helper.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $user = authenticate($username, $password);
    if ($user) {
        $_SESSION['teacher_id'] = $user['id'];
        header("Location: dashboard.php");
        exit;
    } else {
        // echo "Invalid username or password.";
        header("Location: index.php?error=auth_failed");
        exit;
    }
}
?>
