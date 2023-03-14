ARG PHP_VERSION

FROM php:${PHP_VERSION}-fpm

RUN apt-get update \
  && apt-get install -y zip unzip libzip-dev default-mysql-client \
  && docker-php-ext-install zip pdo_mysql
