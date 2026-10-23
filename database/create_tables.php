<?php
require __DIR__ . '/../src/db.php';

$pdo = connect();
$pdo->exec("
    CREATE TABLE IF NOT EXISTS authors (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL
    );
    CREATE TABLE IF NOT EXISTS books (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        publication_year INTEGER,
        author_id INTEGER NOT NULL,
        FOREIGN KEY (author_id) REFERENCES authors(id)
    );
");

echo "Tables created.\n";