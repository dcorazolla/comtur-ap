FROM php:7-apache
MAINTAINER Diogo Corazolla <diogocorazolla@gmail.com>

RUN apt-get update
RUN apt-get install --no-install-recommends -y libxml2-dev \
    libldb-dev libcurl3-dev libpng-dev libjpeg-dev libfreetype6-dev \
    libzip-dev git zip unzip libpng-tools
RUN docker-php-ext-install intl 
RUN docker-php-ext-install zip 
RUN docker-php-ext-install pdo_mysql 
RUN docker-php-ext-install gd 
RUN docker-php-ext-install mysqli 
RUN a2enmod rewrite
RUN sed -i 's!/var/www/html!/var/www/html/public_html\nSetEnv APPLICATION_ENV development!g' /etc/apache2/sites-available/000-default.conf
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html/