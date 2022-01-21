FROM php:fpm

RUN apt update
RUN apt install -y --no-install-recommends ssmtp mailutils curl debconf apt-transport-https apt-utils build-essential acl mailutils wget git

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www

RUN composer require phpmailer/phpmailer

COPY ./mail.php /var/www

EXPOSE 9000
CMD ["php-fpm"]