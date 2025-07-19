# Stage 1: Build frontend assets with Node.js
FROM node:18 AS node-builder

WORKDIR /app

# Install frontend dependencies
COPY package*.json ./
RUN npm install

# Copy frontend source files
COPY resources ./resources
COPY vite.config.js tailwind.config.js postcss.config.js ./

# Build assets using Vite
RUN npm run build


# Stage 2: Set up Laravel with PHP-FPM
FROM php:8.1-fpm

# Set working directory
WORKDIR /var/www

# Install PHP extensions & system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql zip gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application source code
COPY . .

# Copy Vite build output
COPY --from=node-builder /app/public/build ./public/build
COPY --from=node-builder /app/public/build/.vite/manifest.json ./public/build/manifest.json

# Install Laravel PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Set correct permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 storage bootstrap/cache

# Laravel cache optimization
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

EXPOSE 9000
CMD ["php-fpm"]
