FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd mbstring pdo pdo_mysql zip

# Install Composer
COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

# Install Node.js (optional, if using npm)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install PHP and Node dependencies
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# Set permissions
RUN chmod -R 775 storage bootstrap/cache

# Expose port for Railway
EXPOSE 8080

# Run Laravel setup commands
CMD php artisan config:clear && \
    php artisan config:cache && \
    php artisan migrate:fresh --seed && \
    php artisan serve --host=0.0.0.0 --port=8080
