FROM php:8.1-fpm-alpine3.14

RUN curl -sS https://getcomposer.org/installer | php -- \
        --install-dir=/usr/local/bin \
        --filename=composer \
    && chmod +x /usr/local/bin/composer