# Developer Setup Guide

This guide provides step-by-step instructions for setting up the development environment for the Thinco project.

## Prerequisites

- Git
- Docker
- Docker Compose
- Make (optional, for using Makefile shortcuts)

## Initial Setup

1. Clone the repository:
   ```bash
   git clone https://github.com/YoqubovDev/Thinco.git
   cd Thinco
   ```

2. Copy the environment file:
   ```bash
   cp .env.example .env
   ```

3. Configure environment variables in `.env`:
   ```
   DB_CONNECTION=mysql
   DB_HOST=thinko_db
   DB_PORT=3306
   DB_DATABASE=thinco
   DB_USERNAME=root
   DB_PASSWORD=root
   ```

4. Start the Docker environment:
   ```bash
   docker compose up -d --build
   ```

5. Install PHP dependencies:
   ```bash
   docker exec thinko_app composer install
   ```

6. Generate application key:
   ```bash
   docker exec thinko_app php artisan key:generate
   ```

7. Run migrations:
   ```bash
   docker exec thinko_app php artisan migrate
   # Or use the Makefile shortcut:
   make migrate
   ```

## Optional Shell Alias

Add this to your `~/.bashrc` or `~/.zshrc` for a shorter Artisan command:
```bash
alias art='docker exec thinko_app php artisan'
```

After adding the alias, you can use:
```bash
art migrate
art queue:work
art tinker
```

## Available Make Commands

The project includes a Makefile with common commands:

- `make help` - Show available commands
- `make migrate` - Run database migrations
- `make seed` - Run database seeding
- `make fresh` - Refresh database with seed
- `make queue` - Start queue worker
- `make test` - Run tests
- `make tinker` - Start Laravel Tinker

## Container Structure

The project uses the following containers:

- `thinko_app`: PHP application container
- `thinko_db`: MySQL database
- `thinko_web`: Nginx web server
- `thinko_node`: Node.js for frontend assets

## Common Issues and Solutions

### Database Connection Issues

1. Verify container status:
   ```bash
   docker ps
   ```

2. Check database logs:
   ```bash
   docker logs thinko_db
   ```

3. Ensure correct environment variables in `.env`

### Permission Issues

If you encounter permission issues:
```bash
docker exec thinko_app chown -R www-data:www-data storage bootstrap/cache
```

### Cache Issues

Clear various caches:
```bash
docker exec thinko_app php artisan optimize:clear
```

