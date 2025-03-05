<?php require_once 'templates/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <h2 class="text-center">Register</h2>
        <form action="actions/register.php" method="POST" class="border p-4 shadow-sm rounded bg-light">
            <div class="mb-3">
                <input type="text" name="name" class="form-control" placeholder="Full Name" required>
            </div>
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="mb-3">
                <select name="role" class="form-select">
                    <option value="member">Member</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>
    </div>
</div>

<?php require_once 'templates/footer.php'; ?>
