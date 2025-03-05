<?php
require_once 'User.php';

class Admin extends User {
    public function addBook($title, $author, $isbn) {
        $stmt = $this->pdo->prepare("INSERT INTO books (title, author, isbn) VALUES (?, ?, ?)");
        return $stmt->execute([$title, $author, $isbn]);
    }
}
?>
