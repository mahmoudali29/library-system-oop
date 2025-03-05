<?php
require_once 'templates/header.php';

$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

if (!$user || $user['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
?>

<h2 class="text-center">Admin Dashboard</h2>

<!-- Add Book Form -->
<div class="row justify-content-center">
    <div class="col-md-6">
        <h3 class="text-center">Add a New Book</h3>
        <form action="actions/add_book.php" method="POST" class="border p-4 shadow-sm rounded bg-light">
            <div class="mb-3">
                <input type="text" name="title" class="form-control" placeholder="Book Title" required>
            </div>
            <div class="mb-3">
                <input type="text" name="author" class="form-control" placeholder="Author" required>
            </div>
            <div class="mb-3">
                <input type="text" name="isbn" class="form-control" placeholder="ISBN" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Add Book</button>
        </form>
    </div>
</div>

<!-- Display Existing Books -->
<h3 class="text-center mt-4">Book List</h3>
<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>ISBN</th>
                <th>Available</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once 'classes/Library.php';
            $books = Library::getAllBooks();
            foreach ($books as $book): ?>
                <tr>
                    <td><?= htmlspecialchars($book['title']) ?></td>
                    <td><?= htmlspecialchars($book['author']) ?></td>
                    <td><?= htmlspecialchars($book['isbn']) ?></td>
                    <td>
                        <span class="badge <?= $book['available'] ? 'bg-success' : 'bg-danger' ?>">
                            <?= $book['available'] ? "Yes" : "No" ?>
                        </span>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once 'templates/footer.php'; ?>
