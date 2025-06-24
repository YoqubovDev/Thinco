# Define the artisan command prefix
artisan = docker exec thinko_app php artisan

# Helper target to display available commands
.PHONY: help
help:
	@echo "Available commands:"
	@echo "  make migrate      Run database migrations"
	@echo "  make seed        Run database seeding"
	@echo "  make fresh       Refresh database with seed"
	@echo "  make queue       Start queue worker"
	@echo "  make test        Run tests"
	@echo "  make tinker      Start Laravel Tinker"

# Database related commands
.PHONY: migrate seed fresh
migrate:
	$(artisan) migrate

seed:
	$(artisan) db:seed

fresh:
	$(artisan) migrate:fresh --seed

# Queue commands
.PHONY: queue
queue:
	$(artisan) queue:work

# Testing
.PHONY: test
test:
	$(artisan) test

# Interactive REPL
.PHONY: tinker
tinker:
	$(artisan) tinker

