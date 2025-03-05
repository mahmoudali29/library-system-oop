<?php
require_once '../config.php';
require_once '../classes/Member.php';
session_start();

// Ensure user is logged in
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
if (!$user || $user['role'] !== 'member') {
    echo "<script>alert('Access Denied! Only members can return books.'); window.location.href='../login.php';</script>";
    exit;
}

// Create a Member object
$member = new Member($user['id'],$user['name'], $user['email'], $user['role']);

// Ensure form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_id'])) {
    $bookId = $_POST['book_id'];

    // Call returnBook() method
    $message = $member->returnBook($bookId);
    
    echo "<script>alert('$message'); window.location.href='../member_dashboard.php';</script>";
} else {
    echo "<script>alert('Invalid request.'); window.location.href='../member_dashboard.php';</script>";
}
?>
