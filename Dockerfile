FROM php:8.0-apache AS base

RUN apt update && \
    apt install -y \
        bash \
        unzip \
        logrotate

ARG REAL_UID=1000
ARG REAL_GID=1000
RUN usermod -u ${REAL_UID} www-data
RUN groupmod -g ${REAL_GID} www-data
RUN mkdir -p /home/www-data/.ssh
RUN chown -R www-data:www-data /home/www-data
RUN usermod -d /home/www-data www-data

WORKDIR /app

RUN docker-php-ext-install \
        opcache

COPY docker/php.ini /usr/local/etc/php/php.ini
RUN a2dissite 000-default
COPY docker/apache.conf /etc/apache2/sites-available/server.conf
RUN a2ensite server
RUN a2enmod rewrite ssl headers

RUN mkdir /certificates
RUN mkdir /logs
RUN chown www-data:www-data /logs /app

FROM base AS composer

RUN curl -sS https://getcomposer.org/installer | \
    php -- --install-dir=/usr/local/bin --filename=composer

FROM composer AS dev

RUN pecl install xdebug
RUN docker-php-ext-enable \
        xdebug

RUN apt install -y \
        inotify-tools

CMD /app/docker/dev.sh

FROM composer AS build

USER www-data
RUN mkdir /app/cache
COPY composer.json /app/composer.json
COPY composer.lock /app/composer.lock
RUN composer install --prefer-dist --no-dev --optimize-autoloader
#COPY --chown=www-data:www-data vendor /app/vendor

COPY src /app/src
COPY bin /app/bin
COPY public /app/public

RUN php bin/compile.php

FROM base AS prod

USER root
RUN mkdir /app/bin
RUN chown www-data /app/bin
COPY --from=build --chown=www-data:www-data /app/cache /app/cache
COPY --from=build --chown=www-data:www-data /app/src /app/src
COPY --from=build --chown=www-data:www-data /app/bin /app/bin
COPY --from=build --chown=www-data:www-data /app/public /app/public
COPY --from=build --chown=www-data:www-data /app/vendor /app/vendor
COPY docker/prod.sh /init.sh

RUN echo "opcache.preload=/app/bin/preload.php" >> /usr/local/etc/php/php.ini
RUN echo "opcache.preload_user=www-data" >> /usr/local/etc/php/php.ini

CMD /init.sh
