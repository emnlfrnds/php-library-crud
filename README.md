# PHP Library CRUD

A small book library built with plain PHP, PDO and SQLite, to practice CRUD, relational modeling and safe form handling without a framework.

## Features

- List, create, edit and delete books
- Server-side validation
- Prepared statements (against SQL injection)
- Output escaping with `htmlspecialchars` (against XSS)
- Deletion only through POST requests

## Stack

PHP 8, PDO, SQLite

## Requirements

PHP 8.1 or newer with the `pdo_sqlite` and `sqlite3` extensions enabled.

## Running locally

```
php database/create_tables.php
php database/seed.php
php -S localhost:8000 -t public
```

Then open http://localhost:8000.

The `-t public` option makes `public/` the document root, so files like the database stay out of reach of the browser.

## Project structure

```
library/
├── public/      pages served to the browser
├── src/         database connection and book queries
└── database/    schema and seed scripts
```

## Roadmap

- [x] Base structure and schema
- [x] Create and read books
- [x] Update and delete books
- [ ] Authors management and book-author JOIN
- [ ] Search by title
- [ ] Error handling and security review
- [ ] Switch from SQLite to PostgreSQL

## How I used AI

Claude guided the project step by step as a tutor and explained each concept. I typed the code myself and debugged my own mistakes.