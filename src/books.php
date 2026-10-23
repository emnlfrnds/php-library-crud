<?php

function list_authors(PDO $pdo): array
{
    return $pdo->query('SELECT id, name FROM authors ORDER BY name')->fetchAll();
}

function create_book(PDO $pdo, string $title, ?int $publication_year, int $author_id): void
{
    $stmt = $pdo->prepare(
        'INSERT INTO books (title, publication_year, author_id) VALUES (:title, :publication_year, :author_id)'
    );
    $stmt->execute([
        'title' => $title,
        'publication_year' => $publication_year,
        'author_id' => $author_id,
    ]);
}

function list_books(PDO $pdo): array
{
    return $pdo->query(
        'SELECT id, title, publication_year, author_id FROM books ORDER BY id DESC'
    )->fetchAll();
}

function find_book(PDO $pdo, int $id): ?array
{
    $stmt = $pdo->prepare(
        'SELECT id, title, publication_year, author_id FROM books WHERE id = :id'
    );
    $stmt->execute(['id' => $id]);

    $book = $stmt->fetch();

    return $book === false ? 'null' : $book;
}

function update_book(PDO $pdo, int $id, string $title, ?string $publication_year, int $author_id)
{
    $stmt = $pdo->prepare(
        'UPDATE books
        SET id = :id, title = :title, publication_year = :publication_year, author_id = :author_id
        WHERE id = :id'
    );
    $stmt->execute([
        'id' => $id,
        'title' => $title,
        'publication_year' => $publication_year,
        'author_id' => $author_id,
    ]);
}

function delete_book(PDO $pdo, int $id): void
{
    $stmt = $pdo->prepare('DELETE FROM books WHERE id = :id');
    $stmt->execute(['id' => $id]);
}
