#!/bin/bash

# Install dependencies
composer install --no-dev --optimize-autoloader

# Generate key if not set
php artisan key:generate --force

# Run migrations
php artisan migrate --force

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create storage link
php artisan storage:link || true

# Build assets
npm ci
npm run build
