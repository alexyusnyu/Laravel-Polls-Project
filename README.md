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

# Linux/macOS
touch database/database.sqlite

# Windows (PowerShell)
New-Item -Path .\database\database.sqlite -ItemType File

# Windows (cmd.exe)
type nul > database\database.sqlite


6. **Generate application key:**

```powershell
php artisan key:generate
```

7. **Run migrations and seed the database:**

```powershell
php artisan migrate --seed
```

8. **Start the development server:**

```powershell
php artisan serve
```

Visit [http://127.0.0.1:8000](http://127.0.0.1:8000) in your browser.

---

## Option 2: Run with Docker (Recommended for Windows)

### 1. Dockerfile

Create a file named `Dockerfile` in your project root:

```dockerfile
FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    git curl libsqlite3-dev unzip libzip-dev \
    && docker-php-ext-install pdo pdo_sqlite zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# Install PHP dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 8000
CMD php artisan serve --host=0.0.0.0 --port=8000
```

---

### 2. docker-compose.yml

Create `docker-compose.yml` in your project root:

```yaml
services:
  app:
    build: .
    container_name: laravel-polls
    ports:
      - "8000:8000"
    volumes:
      - ./storage:/var/www/html/storage
      - ./database:/var/www/html/database
      - ./public:/var/www/html/public
      - ./.env:/var/www/html/.env
    environment:
      DB_CONNECTION: sqlite
      DB_DATABASE: /var/www/html/database/database.sqlite
      DB_FOREIGN_KEYS: "true"
```

---

### 3. Create SQLite database file

# Linux/macOS
touch database/database.sqlite

# Windows (PowerShell)
New-Item -Path .\database\database.sqlite -ItemType File

# Windows (cmd.exe)
type nul > database\database.sqlite


Make sure `.env` exists:

```powershell
copy .env.example .env
```

---

### 4. Build and start Docker

```powershell
docker-compose up --build -d
```

---

### 5. Inside the container: Laravel setup

```powershell
docker-compose exec app composer install
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate --seed
```

---

### 6. Open the app

Visit [http://localhost:8000](http://localhost:8000) in your browser. Your polls app should now run correctly with database and storage working.

---

## Running Tests

```
# Local
php artisan test

# Docker
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
