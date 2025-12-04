FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libsqlite3-dev \
    zip \
    unzip \
    nodejs \
    npm

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_sqlite pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy application
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Install Node dependencies and build
RUN npm install && npm run build

# Create SQLite database
RUN mkdir -p database && touch database/database.sqlite

# Set permissions
RUN chmod -R 775 storage bootstrap/cache database

# Force SQLite configuration via environment
ENV DB_CONNECTION=sqlite
ENV DB_DATABASE=/var/www/html/database/database.sqlite
ENV SESSION_DRIVER=file
ENV CACHE_STORE=file
ENV QUEUE_CONNECTION=sync

# Expose port
EXPOSE 8080

# Start server with migrations
CMD php artisan key:generate --force && \
    php artisan migrate --force && \
    php artisan db:seed --force || true && \
    php artisan serve --host=0.0.0.0 --port=8080
