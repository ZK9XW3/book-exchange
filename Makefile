include .env
export

php:
	docker exec -ti --user www-data ${PROJECT_NAME}_www bash
fix:
	docker exec -ti ${PROJECT_NAME}_www bash -c "vendor/bin/php-cs-fixer fix src"
test:
	docker exec -ti ${PROJECT_NAME}_www bash -c "php bin/phpunit"
stop:
	docker-compose stop
start:
	docker-compose up -d
build:
	docker-compose up --build
build-daemon:
	docker-compose up --build -d
start-log:
	docker-compose up
fixtures:
	docker exec -ti ${PROJECT_NAME}_php_apache bash -c "php bin/console doctrine:schema:drop --force && php bin/console doctrine:schema:create && php bin/console doctrine:fixtures:load"