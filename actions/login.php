<?php
require_once '../classes/User.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = User::login($_POST['email'], $_POST['password']);

    if ($user) {
        // Store only user data, not the entire object
        $_SESSION['user'] = [
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'role' => $user->getRole()
        ];
        
        // Redirect based on role
        if ($user->getRole() === 'admin') {
            header("Location: ../admin_dashboard.php");
        } else {
            header("Location: ../member_dashboard.php");
        }
        exit;
    } else {
        echo "<script>alert('Invalid email or password!'); window.location.href='../login.php';</script>";
    }
}
?>
