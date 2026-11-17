# Paw Ledger Pet Record Management

A small Laravel-based pet registry for recording pet profiles and owner contact details. It includes a dashboard, searchable and paginated records, full CRUD, MySQL migrations, and a Docker setup for deployment to Render.

## Features

- Dashboard totals for all pets, dogs, cats, and other pets, plus recently registered records.
- Add, view, edit, and delete pet records.
- Search by pet name or owner name.
- Server-side validation, CSRF protection, escaped output, prepared database queries through Laravel, and success/error feedback.
- Responsive Bootstrap 5 interface with reusable Blade layout components.
- MySQL support for local XAMPP use and external managed databases in production.

## Technology

- PHP 8.2+ and Laravel 12
- MySQL 8+ or MariaDB
- Bootstrap 5, HTML, CSS, and JavaScript
- Apache and Docker for Render deployment

## Local Setup with XAMPP

1. Install XAMPP with PHP 8.2 or newer and MySQL. Install Composer separately if it is not already available.
2. Clone or download this repository into your development folder. From the project root, install dependencies:

   ```sh
   composer install
   ```

3. Start Apache and MySQL in the XAMPP Control Panel. Create an empty database named `pet_record_db` in phpMyAdmin.
4. Configure the app environment:

   ```sh
   copy .env.example .env
   php artisan key:generate
   ```

   On macOS/Linux, use `cp .env.example .env`. Set `DB_HOST=127.0.0.1`, `DB_PORT=3306`, `DB_DATABASE=pet_record_db`, and the local MySQL username/password in `.env`.
5. Create the tables with Laravel migrations:

   ```sh
   php artisan migrate
   ```

   The recommended app setup is migrations from an empty database. `database.sql` is a standalone schema import for the `pets` table; do not import it and then run the pets migration, as that creates the pets table twice. The SQL import does not create Laravel's queue, cache, sessions, or migrations tables.
6. Launch the development server and open the shown URL:

   ```sh
   php artisan serve
   ```

   You can also serve the `public` directory with XAMPP Apache after configuring a virtual host whose document root points to this project's `public` folder.

## Tests

Run the application test suite with:

```sh
php artisan test
```

Feature tests use an in-memory SQLite database and cover dashboard counts, record creation, search, update, deletion, and validation.

## GitHub Upload

1. Review `git status` and confirm `.env` is not staged. `.gitignore` excludes environment files, dependencies, and generated assets.
2. Create an empty repository on GitHub, then initialize and push this project:

   ```sh
   git init
   git add .
   git commit -m "Build pet record management system"
   git branch -M main
   git remote add origin https://github.com/YOUR-USERNAME/YOUR-REPOSITORY.git
   git push -u origin main
   ```

3. Never commit `.env`, database passwords, API keys, or production secrets. Use GitHub's repository secrets for any CI workflows that need credentials.

## Screenshots

Add project screenshots here after running the application, for example:

- `docs/screenshots/dashboard.png`
- `docs/screenshots/pet-records.png`
- `docs/screenshots/pet-details.png`

## Render Deployment

Render does not provide a persistent MySQL database with a Web Service. Create a MySQL database with an external managed provider that permits connections from Render, and have its database/schema ready before deploying.

1. Push this repository to GitHub.
2. In Render, create a **Web Service** from the repository and select **Docker** as the runtime. The included `Dockerfile` builds PHP 8.3 with Apache and `pdo_mysql`; Apache serves Laravel's `public` directory.
3. Add these environment variables in Render. Set values from your database provider; do not use `localhost` for the production database host.

   | Variable | Value |
   | --- | --- |
   | `APP_ENV` | `production` |
   | `APP_DEBUG` | `false` |
   | `APP_KEY` | Output of `php artisan key:generate --show` from a local checkout |
   | `APP_URL` | Your Render service URL |
   | `DB_CONNECTION` | `mysql` |
   | `DB_HOST` | External database hostname |
   | `DB_PORT` | Provider's MySQL port, usually `3306` |
   | `DB_DATABASE` | External database/schema name |
   | `DB_USERNAME` | Database username |
   | `DB_PASSWORD` | Database password |

4. Deploy the service. At container startup, the entrypoint runs `php artisan migrate --force` against the configured database and starts Apache on Render's assigned `PORT` (falling back to `10000` for local container use).
5. Check the Render deployment logs for a successful migration and visit the service URL.

Use Laravel migrations for production setup; do not import `database.sql` as well. If the database provider requires SSL, configure the provider's recommended PDO/MySQL SSL settings using Render environment variables and update `config/database.php` as required by that provider. Restrict the external database's allowed connections according to its provider documentation.

## Project Structure

- `app/Http/Controllers/PetController.php` - dashboard queries and pet CRUD actions.
- `app/Models/Pet.php` - pet record model.
- `database/migrations/` - Laravel schema migrations.
- `database.sql` - standalone MySQL schema for manual setup.
- `resources/views/` - dashboard, records, form, and shared layout templates.
- `public/assets/` - custom CSS and JavaScript.
- `Dockerfile`, `docker-entrypoint.sh` - Render-compatible runtime.