build: ## build application images
	docker-compose build
up:
	docker-compose up -d
down:
	docker-compose down
sh:
	docker exec -it php8-paysera /bin/bash
test:
	docker exec -it php8-paysera php /app/vendor/bin/phpunit
checkCodeStyle:
	docker exec -it php8-paysera php /app/vendor/bin/phpcs
fixCodeStyle:
	docker exec -it php8-paysera php /app/vendor/bin/phpcbf