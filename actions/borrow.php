<?php
require_once '../config.php';
require_once '../classes/Borrowable.php';
require_once '../classes/Member.php';
require_once '../classes/Admin.php';
session_start();

// Ensure user is logged in
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
if (!$user) {
    echo "<script>alert('Access Denied! You need to log in.'); window.location.href='../login.php';</script>";
    exit;
}

// Create the appropriate User object based on role
if ($user['role'] === 'member') {
    $borrower = new Member($user['id'],$user['name'], $user['email'], $user['role']);
} elseif ($user['role'] === 'admin') {
    $borrower = new Admin($user['id'],$user['name'], $user['email'], $user['role']);
} else {
    echo "<script>alert('Invalid user role.'); window.location.href='../login.php';</script>";
    exit;
}

// Ensure form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_id'])) {
    $bookId = $_POST['book_id'];

    // Call the polymorphic method
    $message = $borrower->borrowBook($bookId);
    
    echo "<script>alert('$message'); window.location.href='../member_dashboard.php';</script>";
} else {
    echo "<script>alert('Invalid request.'); window.location.href='../member_dashboard.php';</script>";
}
?>
