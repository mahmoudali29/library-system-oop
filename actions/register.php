<?php
require_once '../classes/User.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = new User($_POST['name'], $_POST['email'], $_POST['role']);
    $result = $user->register($_POST['password']);

    echo "<script>alert('$result'); window.location.href='../register.php';</script>";
}
?>
