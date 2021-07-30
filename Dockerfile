FROM php:8-alpine

# Install composer
RUN wget https://raw.githubusercontent.com/composer/getcomposer.org/76a7060ccb93902cd7576b67264ad91c8a2700e2/web/installer -O - -q | php -- --install-dir=/usr/bin --filename=composer

# add packages to build php extensions
RUN apk add autoconf g++ make

# Install the php mongo extension
RUN pecl install mongodb
RUN docker-php-ext-enable mongodb

# Setup the app
WORKDIR /app
COPY . /app
RUN composer install

# Install xdebug to help debugging
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
COPY xdebug-overrides.ini /usr/local/etc/php/conf.d/99-xdebug.ini
EXPOSE 9003

# remove packages to build php extensions
RUN apk del autoconf g++ make

# Clear caches
RUN rm -rf /var/cache/apk/* && \
        rm -rf /tmp/*

ENTRYPOINT ["tail", "-f", "/dev/null"]

