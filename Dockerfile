# ===============================
# Stage 1: Node - Build frontend
# ===============================
FROM node:18 as node-builder

WORKDIR /app

# Copy package manager files
COPY package*.json ./

# Install Node dependencies
RUN npm install

# Copy everything needed to build assets
COPY vite.config.js ./
COPY tailwind.config.js ./
COPY postcss.config.js ./
COPY .env .env
COPY resources ./resources
COPY public ./public

# Build frontend assets with Vite
RUN npm run build


# ===============================
# Stage 2: PHP - Main Laravel App
# ===============================
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

# Copy built assets from Node build stage
COPY --from=node-builder /app/public/build public/build
COPY --from=node-builder /app/public/manifest.json public/manifest.json

# Set correct permissions
RUN chmod -R 775 storage bootstrap/cache

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Cache Laravel config and routes
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# Expose Laravel dev server port
EXPOSE 8000

# Start Laravel dev server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
