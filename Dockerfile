# Stage 1: Build assets with Node
FROM node:18 as node-builder

WORKDIR /app

COPY package*.json ./
RUN npm install

COPY resources ./resources
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

# Create a non-root user
RUN useradd -m laraveluser

# Copy source code
COPY . .

# Copy built frontend assets
COPY --from=node-builder /app/public/build public/build

# Set proper permissions
RUN chown -R laraveluser:laraveluser /var/www
RUN chmod -R 775 storage bootstrap/cache

# Switch to non-root user
USER laraveluser

# Install PHP dependencies as non-root
RUN composer install --no-dev --optimize-autoloader

# Laravel setup
RUN php artisan config:clear && php artisan route:clear && php artisan view:clear

# Expose port
EXPOSE 8000

# Start Laravel server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
