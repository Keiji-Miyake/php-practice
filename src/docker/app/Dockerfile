FROM php:7.4-apache

WORKDIR /var/www/html

ENV DEBIAN_FRONTEND noninteractive
ENV PHPREDIS_VERSION php7
ENV COMPOSER_ALLOW_SUPERUSER 1

RUN apt-get update \
    && apt-get install -y \
        git vim curl \
        mariadb-client \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        libonig-dev \
        libzip-dev \
    && docker-php-ext-install \
        mbstring \
        mysqli \
        pdo_mysql \
        zip \
        bcmath \
        -j$(nproc) iconv gd \
    && docker-php-source extract \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
COPY ./src /var/www/html
COPY ./docker/app/php.ini /usr/local/etc/php/php.ini