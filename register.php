<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require_once __DIR__ . "/controllers/UserController.php";
    (new UserController())->register();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Book Donation App</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <main class="auth-page">
        <form class="panel" method="post">
            <h1>Create Account</h1>
            <?php include __DIR__ . "/shared_messages.php"; ?>
            <label>Name <input type="text" name="name" required></label>
            <label>Email <input type="email" name="email" required></label>
            <label>Password <input type="password" name="password" required></label>
            <button type="submit">Register</button>
            <p>Already have an account? <a href="login.php">Login</a></p>
        </form>
    </main>
</body>
</html>
