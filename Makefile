.PHONY: all deps test fixer phpstan

all: deps test

deps:
	docker-compose run --rm php composer install

test:
	docker-compose run --rm php php ./vendor/bin/phpunit

fixer:
	docker-compose run --rm php php ./vendor/bin/php-cs-fixer fix

phpstan:
	docker-compose run --rm php php ./vendor/bin/phpstan analyse -c .phpstan.neon --debug --level 8 --memory-limit=1G src tests
