# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a fresh [Laravel 13](https://laravel.com) application — a standard boilerplate with no custom business logic yet. It uses:

- **PHP 8.3+**
- **Laravel 13** (framework ^13.8)
- **Tailwind CSS v4** + **Vite 8** for frontend asset building
- **SQLite** (in-memory for testing, file-based for dev) as default database
- **PHPUnit 12** for testing

The app is currently minimal: a single web route returning a welcome view, the default Laravel `User` model, and three baseline migrations (users, cache, jobs).

## Key Files & Directories

- `bootstrap/app.php` — Application bootstrap; defines routing, middleware pipeline, and exception handler (JSON for `api/*` paths)
- `routes/web.php` — Single root route (`GET /` → `welcome` view). Add new web routes here.
- `app/Models/User.php` — Default user model
- `app/Http/Controllers/Controller.php` — Base controller class
- `config/` — All Laravel configuration files (database, caching, sessions, queue, mail, etc.)
- `database/migrations/` — Three default migrations (users, cache, jobs)
- `phpunit.xml` — Test suites: `Unit` and `Feature`; test env uses SQLite in-memory, array mail/cache/session drivers

## Commands

### Development Server

```bash
npm run dev          # Start Vite dev server with HMR
php artisan serve    # Start Laravel development server
```

For full stack development (server + queue + logs + Vite concurrently):

```bash
npm run dev          # Runs: php artisan serve, queue:listen, pail, vite
```

### Building

```bash
npm run build        # Build production assets via Vite
```

### Testing

```bash
npm run test         # Clears config cache, then runs PHPUnit
# Or directly:
php artisan test     # Run all tests
php artisan test --filter=TestName   # Run a specific test
php artisan test tests/Feature/ExampleTest.php  # Run a single test file
```

Tests use SQLite in-memory by default (see `phpunit.xml`). Configure `.env.testing` for different test settings.

### Database

Default connection is SQLite. To switch to MySQL/PostgreSQL, update `.env`:

```bash
php artisan migrate          # Run pending migrations
php artisan migrate:fresh --seed  # Drop tables and re-run with seeders
php artisan db:seed          # Run seeders
```

### Setup (first-time)

```bash
npm run setup   # Runs: composer install, copy .env, key:generate, migrate, npm install, npm run build
```

## Coding Conventions

- Follow PSR-12 coding standards and Laravel conventions
- Use `php artisan pint` to format code (Laravel Pint is configured in `composer.json`)
- Auth scaffolding: the project includes `laravel/pao` package (Preserved Access OAuth) for API/auth — check its documentation for usage
- New models, controllers, and migrations should follow Laravel's standard naming and directory structure under `app/`, `app/Http/Controllers/`, and `database/migrations/`
