FROM php:8.2-apache

# Sakinisha driver za PostgreSQL
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Nakili kodi zako zote
COPY . /var/www/html/

EXPOSE 80
