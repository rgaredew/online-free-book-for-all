<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require_once __DIR__ . "/controllers/BookController.php";
    (new BookController())->donate();
}

if (empty($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$categories = ["Textbook", "Novel", "Science", "Technology", "History", "Children", "Other"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donate a Book | Book Donation App</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header class="site-header">
        <a class="logo" href="index.php">BookDonationApp</a>
        <nav>
            <a href="search.php">Search Books</a>
            <a href="index.php">Home</a>
        </nav>
    </header>

    <main class="content narrow">
        <form class="panel" method="post" enctype="multipart/form-data">
            <h1>Donate a Book</h1>
            <?php include __DIR__ . "/shared_messages.php"; ?>
            <label>Title <input type="text" name="title" required></label>
            <label>Author <input type="text" name="author" required></label>
            <label>Category
                <select name="category" required>
                    <?php foreach ($categories as $item): ?>
                        <option value="<?php echo htmlspecialchars($item); ?>"><?php echo htmlspecialchars($item); ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
            <label>Description <textarea name="description" rows="5"></textarea></label>
            <label>Book File <input type="file" name="book_file" accept=".pdf,.doc,.docx,.txt" required></label>
            <label>Cover Image <input type="file" name="cover_file" accept=".jpg,.jpeg,.png,.webp"></label>
            <button type="submit">Submit Donation</button>
        </form>
    </main>
</body>
</html>
