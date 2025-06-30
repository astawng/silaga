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

# (Optional) Install Node.js (needed if you use npm)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# Set permissions (optional)
RUN chmod -R 775 storage bootstrap/cache

# Expose port for Railway
EXPOSE 8080

# Run artisan key:generate and migrate during container start
CMD echo "🌱 Menjalankan Artisan Key Generate..." && \
    php artisan key:generate && \
    echo "🌱 Menjalankan Migrasi & Seeder..." && \
    php artisan migrate:fresh --seed && \
    echo "🚀 Menjalankan Laravel Serve..." && \
    php artisan serve --host=0.0.0.0 --port=8080

