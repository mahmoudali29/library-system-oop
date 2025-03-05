<?php
require_once '../config.php';
session_start();

// Ensure user is logged in and is a member
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
if (!$user || $user['role'] !== 'member') {
    echo "<script>alert('Access Denied! Only members can borrow books.'); window.location.href='../login.php';</script>";
    exit;
}

// Ensure form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_id'])) {
    $bookId = $_POST['book_id'];
    $userId = $user['id']; // Get user ID from session

    try {
        // Check if book is available
        $stmt = $pdo->prepare("SELECT available FROM books WHERE id = ?");
        $stmt->execute([$bookId]);
        $book = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$book || !$book['available']) {
            echo "<script>alert('Book is not available for borrowing.'); window.location.href='../member_dashboard.php';</script>";
            exit;
        }

        // Mark book as borrowed
        $pdo->beginTransaction();

        // Insert into borrowed_books table
        $stmt = $pdo->prepare("INSERT INTO borrowed_books (user_id, book_id) VALUES (?, ?)");
        $stmt->execute([$userId, $bookId]);

        // Update books table to mark it as unavailable
        $stmt = $pdo->prepare("UPDATE books SET available = 0 WHERE id = ?");
        $stmt->execute([$bookId]);

        $pdo->commit();

        echo "<script>alert('Book borrowed successfully!'); window.location.href='../member_dashboard.php';</script>";
    } catch (Exception $e) {
        $pdo->rollBack();
        echo "<script>alert('Error borrowing book: " . $e->getMessage() . "'); window.location.href='../member_dashboard.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request.'); window.location.href='../member_dashboard.php';</script>";
}
?>
