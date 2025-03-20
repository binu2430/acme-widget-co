FROM php:8.1-cli

WORKDIR /app

COPY . .

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    && docker-php-ext-install pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install

CMD ["php", "artisan", "serve", "--host=0.0.0.0"]