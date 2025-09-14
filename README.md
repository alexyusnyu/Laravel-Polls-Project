# Laravel Polls Project

A simple Laravel application that allows users to create polls, vote on them, and view results.

---

## Features

* Create polls with a question and multiple options.
* Vote on polls.
* View poll results with vote counts.
* Delete polls.
* Poll expiration date.
* Built with Laravel 12, Bootstrap 5, and SQLite.

---

## Requirements

* Docker Desktop 
* PHP 8.2+ and Composer (only for local development, optional if using Docker)
* SQLite

> Note: The app can run locally using PHP or inside Docker. Docker is recommended for Windows.

---

## Option 1: Run Locally 

1. **Clone the repository:**

```
git clone https://github.com/alexyusnyu/Laravel-Polls-Project
cd Laravel-Polls-Project
```

2. **Install dependencies:**

```
composer install
```

3. **Set up environment file:**

```
copy .env.example .env
```

4. **Configure the database in `.env`:**

```env
DB_CONNECTION=sqlite
DB_DATABASE=absolute/path/to/Laravel-Polls-Project/database/database.sqlite
DB_FOREIGN_KEYS=true
```

> Replace `absolute/path/to/...` with your full path.

1. **Create SQLite database file:**

```Linux/macOS
touch database/database.sqlite
```

```Windows (PowerShell)
New-Item -Path .\database\database.sqlite -ItemType File
```

```Windows (cmd.exe)
type nul > database\database.sqlite
```

6. **Generate application key:**

```
php artisan key:generate
```

7. **Run migrations and seed the database:**

```
php artisan migrate --seed
```

8. **Start the development server:**

```
php artisan serve
```

Visit [http://127.0.0.1:8000](http://127.0.0.1:8000) in your browser.

---

## Option 2: Run with Docker (Recommended for Windows)


---

### 1. Create SQLite database file

```Linux/macOS
touch database/database.sqlite
```

```Windows (PowerShell)
New-Item -Path .\database\database.sqlite -ItemType File
```

```Windows (cmd.exe)
type nul > database\database.sqlite
```

## Make sure `.env` exists:

```Linux/macOS
cp .env.example .env
```

```Windows (PowerShell)
copy .env.example .env
```

---

### 2. Build and start Docker

```
docker-compose up --build -d
```

---

### 3. Inside the container: Laravel setup

```
docker-compose exec app composer install
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate --seed
```

---

### 4. Open the app

Visit [http://localhost:8000](http://localhost:8000) in your browser. Your polls app should now run correctly with database and storage working.

---

## Running Tests

```Local
php artisan test
```

```Docker
docker-compose exec app php artisan test
```

---

## Project Structure

* `app/Models` — Poll, Option, Vote models.
* `app/Http/Controllers` — PollController, VoteController.
* `database/migrations` — Migrations for polls, options, votes tables.
* `database/seeders` — Example poll + test user seeding.
* `resources/views/polls` — Blade templates.
* `routes/web.php` — Routes.
* `tests/Unit` — Unit tests.

---
