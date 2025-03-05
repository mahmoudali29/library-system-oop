<?php
require_once 'User.php';
require_once '../classes/Borrowable.php';

class Admin extends User  implements Borrowable{
    public function addBook($title, $author, $isbn) {
        $stmt = $this->pdo->prepare("INSERT INTO books (title, author, isbn) VALUES (?, ?, ?)");
        return $stmt->execute([$title, $author, $isbn]);
    }

    // Since Admins don't borrow books, we can just return an error message.
    public function borrowBook($bookId) {
        return "Admins cannot borrow books!";
    }
}
?>
