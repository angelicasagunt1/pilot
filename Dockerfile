FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libicu-dev \
    libpq-dev \
    libzip-dev \
    libonig-dev \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    && docker-php-ext-install intl pdo pdo_pgsql pdo_mysql zip gd

COPY .. /var/www

RUN chown -R www-data:www-data /var/www

RUN mkdir -p /var/www/var/log && chown -R www-data:www-data /var/www/var/log

WORKDIR /var/www

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

EXPOSE 9000

CMD ["php-fpm"]
