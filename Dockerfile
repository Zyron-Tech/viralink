# Use official PHP 8.1 image with FPM
FROM php:8.1-fpm

# Set working directory
WORKDIR /var/www

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    npm \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl

# Install Composer globally
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions for Laravel
RUN chmod -R 775 storage bootstrap/cache

# Clear and cache Laravel config and routes (env will be used at runtime)
RUN php artisan config:clear && php artisan route:clear && php artisan view:clear

# Expose the port Laravel will run on
EXPOSE 8000

# Start Laravel built-in server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
