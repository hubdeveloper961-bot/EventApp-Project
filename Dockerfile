FROM php:8.2-apache

# 1. Sakinisha maktaba za PostgreSQL
RUN apt-get update && apt-get install -y libpq-dev

# 2. Washa driver za PDO PostgreSQL
RUN docker-php-ext-install pdo pdo_pgsql

# 3. Nakili kodi zako
COPY . /var/www/html/

# 4. Fungua port
EXPOSE 80
