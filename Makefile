docker := docker-compose
docker-php := @${docker} exec php-fpm
docker-node := @${docker} exec node

setup: env start composer-install db-create npm-install npm-build set-permissions

env:
	cp .env.example .env

start:
	@${docker} up -d

stop:
	@${docker} stop

restart: stop start

composer-install:
	@${docker-php} php composer.phar install

npm-install:
	@${docker-node} npm install

db-create:
	@${docker-php} php database.php

npm-build:
	@${docker-node} npm run build

set-permissions:
	@${docker-php} /bin/sh -c 'if [ ! -d api/uploads ]; then mkdir -p api/uploads; fi' \
	&& chown -R www-data:www-data api/uploads
