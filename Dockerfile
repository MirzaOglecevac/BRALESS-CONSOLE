FROM php:7.2.4-apache

COPY apache_default /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

COPY src /var/www/html/src
COPY public /var/www/html/public
COPY config /var/www/html/config
ADD composer.json /var/www/html

# Install software 
RUN apt-get update && apt-get install -y git

# Install dependencies
RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

RUN cd /var/www/html && composer install --no-dev --no-interaction --optimize-autoloader

CMD apachectl -D FOREGROUND