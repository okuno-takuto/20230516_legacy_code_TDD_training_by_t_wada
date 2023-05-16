FROM php:8.2-cli

ENV APP_HOME /usr/src/myapp
WORKDIR $APP_HOME
ENV COMPOSER_ALLOW_SUPERUSER 1

# RUN apt-get update \
#     && apt-get -y install zlib1g-dev libzip-dev libpq-dev wait-for-it \
#     && docker-php-ext-install zip pdo_pgsql
RUN apt-get update \
    && apt-get -y install zlib1g-dev libzip-dev \
    && docker-php-ext-install zip
# RUN docker-php-ext-configure pcntl --enable-pcntl \
#   && docker-php-ext-install pcntl

COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

COPY composer.json composer.lock ./
RUN composer install

COPY . ./
