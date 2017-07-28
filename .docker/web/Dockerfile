FROM php:7-apache
MAINTAINER brian@fourkitchens.com

##############################
# Install server-level tools #
##############################

# Install server packages.
RUN apt-get update && apt-get install -yq \
    vim \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libpng12-dev \
    libicu-dev \
    mysql-client \
    openssh-client \
    keychain \
    git

RUN docker-php-ext-install \
    gd \
    json \
    intl \
    pdo \
    pdo_mysql \
    mbstring \
    mcrypt \
    opcache \
    zip

# Install Composer.
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Drush 8 with the phar file.
RUN curl -fsSL -o /usr/local/bin/drush "https://github.com/drush-ops/drush/releases/download/8.1.7/drush.phar" && chmod +x /usr/local/bin/drush

# Enable mod_rewrite so that Drupal form submission work.
RUN a2enmod rewrite

####################################
# Copy custom files into container #
####################################

# Add custom PHP configuration changes from php.ini.
COPY php.ini /usr/local/etc/php/

# Copy and enable our own site configuration -- needed for .htaccess enable.
COPY web.conf /etc/apache2/sites-available/web.conf
RUN a2dissite 000-default && \
    a2ensite web

# Copy the provided .bash_profile and .bashrc into the container.
COPY .bash_profile /root/.bash_profile
COPY .bashrc /root/.bashrc

# Copy drush alias file into container.
COPY aliases.drushrc.php /root/.drush/aliases.drushrc.php

#################
# Setup Project #
#################
# Delete the default html directory, and symlink our web directory in its place.
RUN rm -rf /var/www/html && \
    ln -s /var/www/drupal/web /var/www/html
