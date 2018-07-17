FROM php:7.0-apache
COPY php.ini /usr/local/etc/php/
RUN apt-get update && apt-get install -y nano zlib1g-dev libicu-dev g++ curl libpng-dev zsh git unzip  libjpeg62-turbo-dev libvpx-dev libxpm-dev libfreetype6-dev libgd-dev
RUN docker-php-ext-configure gd \
        --enable-gd-native-ttf \
        --with-jpeg-dir=/usr/lib \
        --with-freetype-dir=/usr/include/freetype2 && \
    docker-php-ext-install gd
RUN docker-php-ext-install mysqli
RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install pdo
RUN docker-php-ext-install gettext
RUN docker-php-ext-install mbstring
RUN a2enmod rewrite && service apache2 restart