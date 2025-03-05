<?php
require_once '../classes/Admin.php';
session_start();

$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

// Ensure only admin users can add books
if (!$user || $user['role'] !== 'admin') {
    echo "<script>alert('Access Denied!'); window.location.href='../login.php';</script>";
    exit;
}

// Ensure form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $admin = new Admin($user['id'],$user['name'], $user['email'], $user['role']);
    
    if ($admin->addBook($_POST['title'], $_POST['author'], $_POST['isbn'])) {
        echo "<script>alert('Book added successfully!'); window.location.href='../admin_dashboard.php';</script>";
    } else {
        echo "<script>alert('Failed to add book.'); window.location.href='../admin_dashboard.php';</script>";
    }
}
?>
