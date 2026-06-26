FROM php:8.4-fpm AS php_base

ARG PHP_UID=1000
ARG PHP_GID=1000


RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libicu-dev \
    libonig-dev \
    libzip-dev \
    zip \
    curl

RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    intl \
    zip \
    opcache

# Installation de Composer
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

COPY ./docker/dev/php/conf/php-modif.ini /usr/local/etc/php/conf.d/
COPY ./docker/dev/php/conf/pool-dev.conf /usr/local/etc/php-fpm.d/www.conf

WORKDIR /usr/share/code

# Override default image entrypoint to allow executing command with `docker compose run --rm`
ENTRYPOINT []

USER ${PHP_UID}:${PHP_GID}

CMD ["php-fpm", "-R", "-F"]
