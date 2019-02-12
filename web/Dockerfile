FROM php:7.2-apache

RUN apt-get update -y
RUN apt-get install -y \
    git \
    unzip \
    zlib1g-dev \
    zip

RUN docker-php-ext-install pdo pdo_mysql zip

COPY ./conf/test.conf /etc/apache2/sites-enabled/test.conf

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === '48e3236262b34d30969dca3c37281b3b4bbe3221bda826ac6a9a62d6444cdb0dcd0615698a5cbe587c3f0fe57a54d8f5') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/sbin/composer

RUN a2enmod rewrite
