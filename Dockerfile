FROM php:7.4-apache

COPY index.php /var/www/html/

RUN a2enmod rewrite

RUN chown -R www-data:www-data /var/www/html
