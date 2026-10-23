<?php
require __DIR__ . '/../src/db.php';
require __DIR__ . '/../src/books.php';

$pdo = connect();
$authors = list_authors($pdo);
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
var_dump($_POST);

    $title = trim($_POST['title'] ?? '');
    $year_input = trim($_POST['publication_year'] ?? '');
    $author_id = (int) ($_POST['author_id'] ?? 0);

    if ($title === '') {
        $errors[] = 'Title is required.';
    }

    if ($author_id === 0) {
        $errors[] = 'Choose an author.';
    }

    $year = null;
    if ($year_input !== '') {
        $year = filter_var($year_input, FILTER_VALIDATE_INT);
        if ($year === false) {
            $errors[] = 'Year must be a whole number.';
        }
    }

    if (!$errors) {
        create_book($pdo, $title, $year, $author_id);
        header('Location: index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add book</title>
</head>

<body>
    <h1>Add book</h1>

    <?php foreach ($errors as $error): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endforeach; ?>

    <form method="post">
        <p>
            <label>Title<br />
                <input type="text" name="title" value="<?= htmlspecialchars($title ?? '') ?>">
            </label>
        </p>
        <p>
            <label>Publication year<br />
                <input type="number" name="publication_year" value="<?= htmlspecialchars($year_input ?? '') ?>">
            </label>
        </p>
        <p>
            <label>Author<br />
                <select name="author_id">
                    <option value="">-- choose --</option>
                    <?php foreach ($authors as $author): ?>
                        <option value="<?= (int) $author['id'] ?>"
                            <?= (int) $author['id'] === ($author_id ?? 0) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($author['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label>
        </p>
        <button type="submit">Save</button>
    </form>

    <p><a href="index.php">Back to list</a></p>
</body>

</html>