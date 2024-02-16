FROM php:8.2-fpm

RUN apt-get update -y && \
    DEBIAN_FRONTEND=noninteractive apt-get install -y git unzip libzip-dev nano iproute2 syslog-ng

RUN docker-php-ext-configure zip
RUN docker-php-ext-install pdo_mysql zip opcache

RUN sed -i 's/system()/system(exclude-kmsg(yes))/g' \
    /etc/syslog-ng/syslog-ng.conf

COPY --from=composer /usr/bin/composer /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER=1
WORKDIR /var/www/html

COPY . .

RUN composer install
CMD ["php-fpm"]

RUN chmod +x .docker/startup.sh
