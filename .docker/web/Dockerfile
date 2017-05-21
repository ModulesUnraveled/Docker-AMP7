FROM php:7-apache
MAINTAINER brian@fourkitchens.com

RUN apt-get update && apt-get install -yq \
    vim \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libpng12-dev \
    libicu-dev \
    mysql-client

RUN docker-php-ext-install \
    gd \
    json \
    intl \
    pdo \
    pdo_mysql \
    mbstring \
    opcache

# Add custom PHP configuration changes from php.ini
COPY php.ini /usr/local/etc/php/

# Copy and enable our own site configuration -- needed for .htaccess enable.
COPY web.conf /etc/apache2/sites-available/web.conf
RUN a2dissite 000-default && \
    a2ensite web

# Enable mod_rewrite, otherwise Drupal form submission doesn't work.
RUN a2enmod rewrite

RUN rm -rf /var/www/html && \
    ln -s /var/www/drupal/web /var/www/html

# Copy drush alias file into container
COPY aliases.drushrc.php /root/.drush/aliases.drushrc.php

# Install Drush 8 with the phar file.
RUN curl -fsSL -o /usr/local/bin/drush "https://github.com/drush-ops/drush/releases/download/8.1.7/drush.phar" && chmod +x /usr/local/bin/drush
