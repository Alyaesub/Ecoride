FROM php:8.4-apache

RUN pecl install mongodb 

RUN apt-get update && apt-get install libzip-dev -y

RUN docker-php-ext-install pdo pdo_mysql zip

RUN docker-php-ext-enable mongodb

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN a2enmod rewrite

EXPOSE 80