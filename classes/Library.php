<?php
require_once __DIR__ . '/../config.php';

class Library {
    public static function getAllBooks() {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM books");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
