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
    nodejs \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl

# Install Composer globally
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application source
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Install Node dependencies and build Vite assets
RUN npm install && npm run build

# Set correct permissions
RUN chmod -R 775 storage bootstrap/cache

# Clear and cache config (skip APP_KEY since it's passed in env)
RUN php artisan config:clear && php artisan route:clear && php artisan view:clear

# Expose port for Laravel
EXPOSE 8000

# Start Laravel server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
