<?php require_once 'templates/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <h2 class="text-center">Login</h2>
        <form action="actions/login.php" method="POST" class="border p-4 shadow-sm rounded bg-light">
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Login</button>
        </form>
    </div>
</div>

<?php require_once 'templates/footer.php'; ?>
