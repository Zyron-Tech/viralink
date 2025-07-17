# Stage 1: Build Vite assets with Node
FROM node:18 AS node-builder

WORKDIR /app

# Copy and install frontend dependencies
COPY package*.json ./
RUN npm install

# Copy frontend assets and build
COPY resources/ ./resources/
COPY vite.config.js ./
RUN npm run build


# Stage 2: PHP with Laravel
FROM php:8.1-fpm

# Set working directory
WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application source code
COPY . .

# Copy built Vite assets from Node stage
COPY --from=node-builder /app/resources ./resources
COPY --from=node-builder /app/public/build ./public/build

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Set proper permissions
RUN chmod -R 775 storage bootstrap/cache

# Clear Laravel cache files and regenerate config
RUN php artisan config:clear \
    && php artisan route:clear \
    && php artisan view:clear \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# Expose port for Render
EXPOSE 8000

# Start Laravel server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
