# ===============================
# Stage 1: Node - Build frontend
# ===============================
FROM node:18 as node-builder

WORKDIR /app

# Install Node dependencies
COPY package*.json ./
COPY vite.config.js ./
COPY tailwind.config.js ./
COPY postcss.config.js ./

RUN npm install

# Copy app resources
COPY resources ./resources
COPY public ./public

# Build frontend assets (with manifest)
RUN npm run build


# ===============================
# Stage 2: PHP - Laravel App
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

# Copy built assets from Node stage
COPY --from=node-builder /app/public/build public/build

# ✅ Fix for Vite 5 manifest location
COPY --from=node-builder /app/public/build/.vite/manifest.json public/manifest.json

# Set correct permissions
RUN chmod -R 775 storage bootstrap/cache

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Cache Laravel config and routes
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# Expose Laravel server port
EXPOSE 8000

# Start Laravel server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
