<?php

require_once __DIR__ . "/config/Database.php";
require_once __DIR__ . "/models/Book.php";

$id = isset($_GET["id"]) ? (int) $_GET["id"] : 0;
$database = new Database();
$book = (new Book($database->connect()))->find($id);

if (!$book || $book["status"] !== "approved") {
    http_response_code(404);
    echo "Book not found.";
    exit();
}

$file = __DIR__ . "/uploads/books/" . basename($book["book_file"]);

if (!is_file($file)) {
    http_response_code(404);
    echo "File not found.";
    exit();
}

header("Content-Description: File Transfer");
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"" . basename($book["book_file"]) . "\"");
header("Content-Length: " . filesize($file));

readfile($file);
exit();
