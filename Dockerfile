FROM php:apache

COPY ./ /var/www/html
#COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# RUN sudo composer require mongodb/mongodb
RUN apk add php8-pecl-mongodb
RUN apk add mongo-php-library

EXPOSE 80