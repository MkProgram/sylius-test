FROM php:7.4.8-fpm as base

COPY ./app /var/www/app

RUN apt-get update && apt-get install -y \
         libfreetype6-dev \
         libjpeg62-turbo-dev \
         libpng-dev \
         zlib1g-dev \
         libicu-dev \
     && docker-php-ext-configure gd --with-freetype --with-jpeg \
     && docker-php-ext-install -j$(nproc) gd \
     && docker-php-ext-install intl exif pdo_mysql \
     && echo "memory_limit=256M">>/usr/local/etc/php/conf.d/docker-php-memory-limit.ini \
     && echo "date.timezone=\"Europe/Berlin\"">>/usr/local/etc/php/conf.d/docker-php-timezone.ini

FROM base as composer

RUN apt-get update && \
    apt-get install  -y --no-install-recommends git zip libzip-dev unzip && \
    docker-php-ext-install zip && docker-php-ext-enable zip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

FROM composer as development

RUN pecl install xdebug && docker-php-ext-enable xdebug

# Add Production configuration. Build from base because there should be no development config in production.
FROM base as production

RUN pecl install apcu && docker-php-ext-enable apcu && docker-php-ext-install opcache \
&& echo "opcache.preload_user=www-data">>/usr/local/etc/php/conf.d/docker-php-opcache-preload-user.ini \
&& echo "opcache.preload=/var/www/app/var/cache/prod/App_KernelProdContainer.preload.php">>/usr/local/etc/php/conf.d/docker-php-opcache-class-preloading.ini \
&& echo "opcache.memory_consumption=256">>/usr/local/etc/php/conf.d/docker-php-opcache-memory-consumption.ini \
&& echo "opcache.max_accelerated_files=20000">>/usr/local/etc/php/conf.d/docker-php-opcache-max-accelerated-files.ini \
&& echo "opcache.validate_timestamps=0">>/usr/local/etc/php/conf.d/docker-php-opcache-validate-timestamps.ini



