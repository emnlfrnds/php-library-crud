<?php
require __DIR__ . '/../src/db.php';
require __DIR__ . '/../src/books.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method not allowed.');
}

$id = (int) ($_POST['id'] ?? 0);

if ($id > 0) {
    $pdo = connect();
    delete_book($pdo, $id);
}

header('Location: index.php');
exit;