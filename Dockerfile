# Development Dockerfile for Laravel 11
FROM php:fpm-alpine3.18

# Install system dependencies
RUN apk add --no-cache \
    git \
    curl \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libxml2-dev \
    libzip-dev \
    oniguruma-dev \
    supervisor \
    postgresql-dev \
    autoconf \
    g++ \
    make \
    linux-headers

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install \
        pdo_pgsql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY "docker/php/php.ini-development" "/usr/local/etc/php/php.ini"

# Set working directory
WORKDIR /var/www/html

# Install Laravel development dependencies
RUN apk add --no-cache \
    $PHPIZE_DEPS

# Expose port for development server
EXPOSE 9000

# Command to run PHP-FPM
CMD ["php-fpm"]