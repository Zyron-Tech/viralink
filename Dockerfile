# Stage 1: Build assets with Node
FROM node:18 as node-builder

WORKDIR /app

# Copy package.json and lock file, install deps and build
COPY package*.json ./
RUN npm install

COPY resources ./resources
COPY vite.config.js ./
RUN npm run build


# Stage 2: Main PHP Application
FROM php:8.1-fpm

# Set working directory
WORKDIR /var/www

# Install dependencies
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

# Copy app source
COPY . .

# Copy the built Vite assets from the Node builder
COPY --from=node-builder /app/public/build public/build

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Set correct permissions
RUN chmod -R 775 storage bootstrap/cache

# Clear and cache Laravel configs
RUN php artisan config:clear && php artisan route:clear && php artisan view:clear

# Expose port
EXPOSE 8000

# Start Laravel development server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
