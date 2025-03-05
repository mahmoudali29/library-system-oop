<?php
require_once 'templates/header.php';
require_once 'classes/Library.php';

$books = Library::getAllBooks();
?>

<h2 class="text-center mb-4">Available Books</h2>
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
            <?php foreach ($books as $book): ?>
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
