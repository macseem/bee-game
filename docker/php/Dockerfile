FROM php:5.6-fpm
MAINTAINER Max D. <lugamax@gmail.com>

RUN apt-get update && apt-get install -y libicu-dev libcurl4-gnutls-dev libmcrypt-dev zlib1g-dev && \
    docker-php-ext-install \
        mbstring\
        mcrypt\
        mysql\
        mysqli\
        pdo_mysql\
        curl\
        intl\
        json\
        zip

RUN apt-get update && apt-get install -y php5-memcached && \
    cp /usr/lib/php5/20131226/memcached.so /usr/local/lib/php/extensions/no-debug-non-zts-20131226 &&\
    cp /etc/php5/mods-available/memcached.ini /usr/local/etc/php/conf.d/docker-php-ext-memcached.ini

RUN apt-get update && apt-get install -y php5-redis && \
    cp /usr/lib/php5/20131226/redis.so /usr/local/lib/php/extensions/no-debug-non-zts-20131226 &&\
    cp /etc/php5/mods-available/redis.ini /usr/local/etc/php/conf.d/docker-php-ext-redis.ini

RUN apt-get update && apt-get install -y php5-mongo && \
    cp /usr/lib/php5/20131226/mongo.so /usr/local/lib/php/extensions/no-debug-non-zts-20131226 &&\
    cp /etc/php5/mods-available/mongo.ini /usr/local/etc/php/conf.d/docker-php-ext-monbo.ini

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer &&\
    composer global require fxp/composer-asset-plugin

RUN usermod --uid 1000 www-data
