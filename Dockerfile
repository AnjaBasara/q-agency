FROM php:8.0-apache

RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY src .

CMD bash -c "composer install --no-interaction && cp .env.example .env && php artisan key:generate && php artisan serve --host=0.0.0.0"
