FROM php:8.2.7-cli

RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    bzip2 \
    libzip-dev \
    nodejs \
    npm \
    && docker-php-ext-install pdo_mysql zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN npm install -g bower

WORKDIR /var/www/html

COPY . /var/www/html

RUN composer install

RUN npm install

RUN bower install jquery --allow-root

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 8080

CMD ["php", "-S", "0.0.0.0:8080", "-t", "/var/www/html/web"]
