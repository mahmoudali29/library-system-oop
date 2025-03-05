<?php
require_once 'config.php';
require_once 'templates/header.php';
require_once 'classes/Library.php';

$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
if (!$user || $user['role'] !== 'member') {
    header("Location: login.php");
    exit;
}

 

$books = Library::getAllBooks();
$userId = $user['id']; // ✅ Now the ID is available
 
// Get books borrowed by the member
$stmt = $pdo->prepare("SELECT b.id, b.title FROM borrowed_books bb 
                       JOIN books b ON bb.book_id = b.id 
                       WHERE bb.user_id = ? AND bb.returned_at IS NULL");
$stmt->execute([$userId]);
$borrowedBooks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <h2 class="text-center">Member Dashboard</h2>
        
        <!-- Borrow a Book -->
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

<!-- Return a Book -->
<?php if (!empty($borrowedBooks)): ?>
<div class="row justify-content-center mt-4">
    <div class="col-md-6">
        <h3 class="text-center">Return a Book</h3>
        <form action="actions/return.php" method="POST" class="border p-4 shadow-sm rounded bg-light">
            <div class="mb-3">
                <select name="book_id" class="form-select" required>
                    <?php foreach ($borrowedBooks as $book): ?>
                        <option value="<?= $book['id'] ?>"><?= $book['title'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success w-100">Return</button>
        </form>
    </div>
</div>
<?php endif; ?>

<?php require_once 'templates/footer.php'; ?>
