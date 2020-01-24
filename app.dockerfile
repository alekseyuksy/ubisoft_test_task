FROM php:7.3.1-fpm

ENV PHP_XDEBUG_VERSION 2.7.0RC2

RUN apt-get update && apt-get install -y libmcrypt-dev \
    mysql-client libmagickwand-dev --no-install-recommends \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb \
    && pecl install mcrypt-1.0.2 \
    && docker-php-ext-enable mcrypt \
    && docker-php-ext-install pdo_mysql

ARG WITH_XDEBUG=${APP_XDEBUG}

RUN if [ $WITH_XDEBUG = "true" ] ; then \
        pecl install xdebug-${PHP_XDEBUG_VERSION}; \
        docker-php-ext-enable xdebug; \
    fi

    RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/
    RUN docker-php-ext-install gd
    RUN apt-get install -y \
            libzip-dev \
            zip \
      && docker-php-ext-configure zip --with-libzip \
      && docker-php-ext-install zip

ADD php.ini /usr/local/etc/php/conf.d/40-custom.ini
ADD xdebug.ini /usr/local/etc/php/conf.d/