<?php

require __DIR__ . '/../src/db.php';

$pdo = connect();

$count = (int) $pdo->query('SELECT COUNT(*) FROM authors')->fetchColumn();
if ($count > 0) {
    echo "Authors already exist.\n";
    exit;
}

$names = ['Machado de Assis', 'Clarice Lispector', 'George Orwell'];

$stmt = $pdo->prepare('INSERT INTO authors (name) VALUES (:name)');

foreach ($names as $name) {
    $stmt->execute(['name' => $name]);
}

echo "Authors inserted.\n";
