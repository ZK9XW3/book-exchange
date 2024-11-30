FROM php:8.3-apache

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Add php lib, git etc...
RUN apt-get update \
    && apt-get install -qq -y --no-install-recommends \
    cron \
     vim \
     git \
     zip \
     locales coreutils apt-utils git libicu-dev g++ libpng-dev libxml2-dev libzip-dev libonig-dev libxslt-dev;

RUN echo "en_US.UTF-8 UTF-8" > /etc/locale.gen && \
    echo "fr_FR.UTF-8 UTF-8" >> /etc/locale.gen && \
    locale-gen

# Add mod_headers
RUN cp /etc/apache2/mods-available/headers.load /etc/apache2/mods-enabled/

# Add composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=2.5.8

# Add to containers
RUN docker-php-ext-configure intl
RUN docker-php-ext-install pdo pdo_mysql mysqli gd opcache intl zip calendar dom mbstring zip gd xsl && a2enmod rewrite
RUN pecl install apcu && docker-php-ext-enable apcu

# Add php extensions    
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# Give permissions
RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions amqp

COPY backend/ /var/www

# Créer un nouvel utilisateur avec votre UID
RUN useradd -u 1000 -g www-data -m devuser

# Puis faire le chown avec www-data comme groupe
RUN chown -R 1000:www-data /var/www/html

WORKDIR /var/www