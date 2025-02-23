init:
	docker compose up -d
	docker compose exec app composer install

app:
	docker compose exec app bash

app-analyse:
	docker compose exec app composer analyse
app-format:
	docker compose exec app composer format
app-test:
	docker compose exec app composer test