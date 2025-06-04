FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    unzip \
    curl \
    libcurl4-openssl-dev \
    pkg-config \
    libssl-dev \
    default-mysql-client \
    && docker-php-ext-install pdo pdo_mysql mbstring zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy seluruh file project ke container
COPY . .

# Install dependency Laravel
RUN composer install

# Berikan izin ke folder storage & bootstrap/cache
RUN chmod -R 755 storage bootstrap/cache

EXPOSE 9000

CMD ["php-fpm"]
