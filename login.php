<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require_once __DIR__ . "/controllers/UserController.php";
    (new UserController())->login();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Book Donation App</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <main class="auth-page">
        <form class="panel" method="post">
            <h1>Login</h1>
            <?php include __DIR__ . "/shared_messages.php"; ?>
            <label>Email <input type="email" name="email" required></label>
            <label>Password <input type="password" name="password" required></label>
            <button type="submit">Login</button>
            <p>No account yet? <a href="register.php">Register</a></p>
            <p><a href="index.php">Back to Home</a></p>
        </form>
    </main>
</body>
</html>
