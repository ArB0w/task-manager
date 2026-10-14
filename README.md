# Task Manager

A simple task management application built with Laravel and Blade. The project was created as a practical exercise in PHP web development, database operations, and automated testing.

## Features

- Create, edit, and delete tasks
- Mark tasks as completed or active
- Search tasks by title or description
- Filter tasks by completion status
- Set optional due dates
- Highlight overdue tasks
- Validate user input
- Automated feature tests

## Tech Stack

- PHP 8.3+
- Laravel
- Blade
- SQLite
- HTML and CSS
- PHPUnit / Laravel testing tools

## Requirements

- PHP and the required PHP extensions for Laravel
- Composer
- Node.js and npm (if frontend assets need to be built)

## Installation

Clone the repository and enter the project directory:

```bash
git clone <repository-url>
cd task-manager
```

Install PHP dependencies:

```bash
composer install
```

Create the environment configuration:

```bash
cp .env.example .env
php artisan key:generate
```

Create the SQLite database if it does not already exist:

```bash
touch database/database.sqlite
```

Run database migrations:

```bash
php artisan migrate
```

Start the development server:

```bash
php artisan serve
```

Open the URL shown in the terminal, usually `http://127.0.0.1:8000`.

## Running Tests

Run the automated tests with:

```bash
php artisan test
```

## Project Structure

- `app/Models/` — Eloquent models
- `app/Http/Controllers/` — application controllers
- `database/migrations/` — database schema migrations
- `resources/views/` — Blade templates
- `public/css/` — application styles
- `routes/web.php` — web routes
- `tests/Feature/` — feature tests

## License

This project is intended as a learning and portfolio project.
