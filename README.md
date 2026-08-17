<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# MOTE AI - Docker & Laravel Environment

This project is configured with a fully containerized Docker environment (powered by Laravel Sail) including PHP 8.4, MySQL 8.4, Redis, Mailpit, and phpMyAdmin.

## 🚀 Quick Start with Docker

### 1. Start all containers
```bash
./vendor/bin/sail up -d
# or via composer shortcut:
composer sail:up
# or via standard docker compose:
docker compose up -d
```

### 2. Run Database Migrations
```bash
./vendor/bin/sail artisan migrate
# or:
composer sail:migrate
```

### 3. Stop containers
```bash
./vendor/bin/sail down
# or:
composer sail:down
```

---

## 🌐 Services & Port Mappings

| Service | Local URL / Port | Description |
| :--- | :--- | :--- |
| **Laravel App** | [http://localhost:8000](http://localhost:8000) | Main web application |
| **Vite HMR** | [http://localhost:5173](http://localhost:5173) | Frontend asset hot-reload |
| **MySQL 8.4** | `127.0.0.1:3307` (or `mysql:3306` in Docker) | Database (`mote_ai`, user `sail`, pwd `password`) |
| **phpMyAdmin** | [http://localhost:8080](http://localhost:8080) | Visual Database Web GUI |
| **Mailpit** | [http://localhost:8025](http://localhost:8025) | Email testing inbox (SMTP: port `1025`) |
| **Redis** | `127.0.0.1:6379` | Cache, queues & session storage |

---

## 🛠️ Common Sail Commands

- **Run Artisan commands**: `./vendor/bin/sail artisan <command>`
- **Run Composer commands**: `./vendor/bin/sail composer <command>`
- **Run NPM / Vite**: `./vendor/bin/sail npm run dev`
- **Interactive Shell**: `./vendor/bin/sail shell` or `composer sail:tinker`
- **View Container Logs**: `./vendor/bin/sail logs -f`

---

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
