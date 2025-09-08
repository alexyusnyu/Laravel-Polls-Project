
FROM php:8.2-apache


RUN docker-php-ext-install pdo pdo_sqlite


RUN a2enmod rewrite


COPY . /var/www/html


WORKDIR /var/www/html


COPY --from=composer:2 /usr/bin/composer /usr/bin/composer


RUN composer install


RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache


EXPOSE 80


CMD ["apache2-foreground"]
