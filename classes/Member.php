<?php
require_once 'User.php';
require_once 'Borrowable.php'; // Include the interface

class Member extends User implements Borrowable {
    public function borrowBook($bookId) {
        // Check if book is available
        $stmt = $this->pdo->prepare("SELECT available FROM books WHERE id = ?");
        $stmt->execute([$bookId]);
        $book = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$book || !$book['available']) {
            return "This book is not available for borrowing.";
        }

        try {
            // Start transaction
            $this->pdo->beginTransaction();

            // Insert into borrowed_books table
            $stmt = $this->pdo->prepare("INSERT INTO borrowed_books (user_id, book_id) VALUES (?, ?)");
            $stmt->execute([$this->id, $bookId]);

            // Update books table to mark it as unavailable
            $stmt = $this->pdo->prepare("UPDATE books SET available = 0 WHERE id = ?");
            $stmt->execute([$bookId]);

            // Commit transaction
            $this->pdo->commit();

            return "Book borrowed successfully!";
        } catch (Exception $e) {
            $this->pdo->rollBack();
            return "Error borrowing book: " . $e->getMessage();
        }
    }

    // ✅ New function to return a book
    public function returnBook($bookId) {
        // Check if the book is currently borrowed by this user
        $stmt = $this->pdo->prepare("SELECT * FROM borrowed_books WHERE book_id = ? AND user_id = ? AND returned_at IS NULL");
        $stmt->execute([$bookId, $this->id]);
        $borrowedBook = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$borrowedBook) {
            return "You have not borrowed this book or it has already been returned.";
        }

        try {
            // Start transaction
            $this->pdo->beginTransaction();

            // Mark book as returned
            $stmt = $this->pdo->prepare("UPDATE borrowed_books SET returned_at = NOW() WHERE book_id = ? AND user_id = ?");
            $stmt->execute([$bookId, $this->id]);

            // Update books table to mark it as available again
            $stmt = $this->pdo->prepare("UPDATE books SET available = 1 WHERE id = ?");
            $stmt->execute([$bookId]);

            // Commit transaction
            $this->pdo->commit();

            return "Book returned successfully!";
        } catch (Exception $e) {
            $this->pdo->rollBack();
            return "Error returning book: " . $e->getMessage();
        }
    }
}
?>
