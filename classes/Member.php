<?php
require_once 'User.php';

class Member extends User {
    public function borrowBook($bookId) {
        $stmt = $this->pdo->prepare("UPDATE books SET available = 0 WHERE id = ?");
        if ($stmt->execute([$bookId])) {
            $stmt = $this->pdo->prepare("INSERT INTO borrowed_books (user_id, book_id) VALUES (?, ?)");
            return $stmt->execute([$this->id, $bookId]);
        }
        return false;
    }

    public function returnBook($bookId) {
        $stmt = $this->pdo->prepare("UPDATE books SET available = 1 WHERE id = ?");
        if ($stmt->execute([$bookId])) {
            $stmt = $this->pdo->prepare("UPDATE borrowed_books SET returned_at = NOW() WHERE book_id = ? AND user_id = ?");
            return $stmt->execute([$bookId, $this->id]);
        }
        return false;
    }
}
?>
