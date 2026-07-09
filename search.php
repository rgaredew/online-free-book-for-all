<?php

session_start();

require_once __DIR__ . "/config/Database.php";
require_once __DIR__ . "/models/Book.php";

$database = new Database();
$bookModel = new Book($database->connect());

$keyword = trim($_GET["q"] ?? "");
$category = trim($_GET["category"] ?? "");
$books = $bookModel->search($keyword, $category);
$categories = ["Textbook", "Novel", "Science", "Technology", "History", "Children", "Other"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Books | Book Donation App</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header class="site-header">
        <a class="logo" href="index.php">BookDonationApp</a>
        <nav>
            <a href="donate.php">Donate</a>
            <a href="index.php">Home</a>
        </nav>
    </header>

    <main class="content">
        <h1>Search Books</h1>
        <form class="search-bar" method="get">
            <input type="search" name="q" placeholder="Title, author, or keyword" value="<?php echo htmlspecialchars($keyword); ?>">
            <select name="category">
                <option value="">All categories</option>
                <?php foreach ($categories as $item): ?>
                    <option value="<?php echo htmlspecialchars($item); ?>" <?php echo $category === $item ? "selected" : ""; ?>>
                        <?php echo htmlspecialchars($item); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Search</button>
        </form>

        <section class="book-grid">
            <?php if (!$books): ?>
                <p>No approved books found.</p>
            <?php endif; ?>

            <?php foreach ($books as $book): ?>
                <article class="book-card">
                    <?php if (!empty($book["cover_file"])): ?>
                        <img src="uploads/covers/<?php echo htmlspecialchars($book["cover_file"]); ?>" alt="">
                    <?php else: ?>
                        <div class="cover-placeholder">Book</div>
                    <?php endif; ?>
                    <div>
                        <h2><?php echo htmlspecialchars($book["title"]); ?></h2>
                        <p>By <?php echo htmlspecialchars($book["author"]); ?></p>
                        <p class="muted"><?php echo htmlspecialchars($book["category"]); ?> · Donated by <?php echo htmlspecialchars($book["donor_name"]); ?></p>
                        <p><?php echo htmlspecialchars($book["description"]); ?></p>
                        <a class="button small" href="download.php?id=<?php echo (int) $book["id"]; ?>">Download</a>
                    </div>
                </article>
            <?php endforeach; ?>
        </section>
    </main>
</body>
</html>
