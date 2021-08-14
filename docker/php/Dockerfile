FROM php:8.0-fpm-alpine3.12

COPY ./php.ini /usr/local/etc/php/php.ini
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apk --update --no-cache add \
  curl \
  libzip-dev \
  libpng-dev \
  autoconf \
  gcc \
  g++ \
  make \
  git \
  bash \
  icu-dev \
  oniguruma-dev \
  nodejs \
  nodejs-npm \
  patch && \
  rm -rf /var/cache/apk/* && \
  git clone https://github.com/phpredis/phpredis.git /usr/src/php/ext/redis && \
  # Install XDebug
  pecl install xdebug && \
  docker-php-ext-enable xdebug && \
  # Install PHP Extension
  docker-php-ext-install \
  pdo_mysql \
  bcmath \
  mbstring \
  zip \
  opcache \
  gd \
  intl \
  redis


COPY ./www.conf.patch /usr/local/etc/php-fpm.d/www.conf.patch
RUN patch /usr/local/etc/php-fpm.d/www.conf /usr/local/etc/php-fpm.d/www.conf.patch

WORKDIR /app
