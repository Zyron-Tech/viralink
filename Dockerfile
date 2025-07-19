# Stage 1: Build frontend assets with Node
FROM node:18 as node-builder

WORKDIR /app

# Install dependencies
COPY package*.json ./
RUN npm install

# Copy source files for Vite build
COPY resources ./resources
COPY vite.config.js ./
COPY tailwind.config.js ./
COPY postcss.config.js ./

# Build assets
RUN npm run build

# Stage 2: Set up Laravel with PHP
FROM php:8.1-fpm

# Set working directory
WORKDIR /var/www

# Install PHP dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy Laravel source code
COPY . .

# Copy Vite build output from previous stage
COPY --from=node-builder /app/public/build ./public/build

# Optionally, if Laravel Mix or Vite expects manifest.json
COPY --from=node-builder /app/public/build/.vite/manifest.json ./public/build/manifest.json

# Install Laravel PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Set file permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

# Laravel specific: cache configs/routes/views
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

EXPOSE 9000
CMD ["php-fpm"]
