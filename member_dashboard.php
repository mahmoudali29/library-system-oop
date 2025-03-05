<?php
require_once 'templates/header.php';
require_once 'classes/Library.php';

$member = isset($_SESSION['user']) ? $_SESSION['user'] : null;

if (!$member || $member['role'] !== 'member') {  // ✅ Fix: Using array notation
    header("Location: login.php");
    exit;
}

$books = Library::getAllBooks();
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <h2 class="text-center">Member Dashboard</h2>
        <h3 class="text-center">Borrow a Book</h3>
        <form action="actions/borrow.php" method="POST" class="border p-4 shadow-sm rounded bg-light">
            <div class="mb-3">
                <select name="book_id" class="form-select" required>
                    <?php foreach ($books as $book): ?>
                        <?php if ($book['available']): ?>
                            <option value="<?= $book['id'] ?>"><?= $book['title'] ?> by <?= $book['author'] ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-warning w-100">Borrow</button>
        </form>
    </div>
</div>

<?php require_once 'templates/footer.php'; ?>
