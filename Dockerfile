FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
    libicu-dev \
    libmariadb-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libzip-dev \
    zip unzip git curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        intl \
        pdo \
        pdo_mysql \
        mysqli \
        mbstring \
        zip \
        gd \
        fileinfo \
    && a2enmod rewrite \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && chmod +x /usr/local/bin/composer \
    && composer --version \
    && php -m | grep intl

COPY ./php.ini /usr/local/etc/php/conf.d/uploads.ini
RUN mkdir -p /tmp && chmod 1777 /tmp
COPY apache.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 80
