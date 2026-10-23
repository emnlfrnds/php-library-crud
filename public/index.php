<?php
require __DIR__ . '/../src/db.php';
require __DIR__ . '/../src/books.php';

$pdo = connect();
$books = list_books($pdo);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>library</title>
</head>

<body>
    <h1>Library</h1>
    <p><a href="create_book.php">Add book</a></p>

    <?php if (!$books): ?>
        <p>No books yet.</p>
    <?php else: ?>
        <table border="1" cellpadding="6">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Year</th>
                <th>Author ID</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($books as $book): ?>
                <tr>
                    <td><?= (int) $book['id'] ?></td>
                    <td><?= htmlspecialchars($book['title']) ?></td>
                    <td><?= htmlspecialchars((string) $book['publication_year']) ?></td>
                    <td><?= (int) $book['author_id'] ?></td>
                    <td>
                        <a href="edit_book.php?id=<?= (int) $book['id'] ?>">Edit</a>
                        <form method="post" action="delete_book.php" style="display: inline;"
                            onsubmit="return confirm('Delete this book?');">
                            <input type="hidden" name="id" value="<?= (int) $book['id'] ?>">
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>

</html>