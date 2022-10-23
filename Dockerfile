FROM php:8.1.11-cli

RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip

RUN docker-php-ext-install pdo pdo_mysql

COPY --from=composer:2.4.3 /usr/bin/composer /usr/local/bin/composer