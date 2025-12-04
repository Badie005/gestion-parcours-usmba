#!/bin/sh

# Exit on error
set -e

# Run migrations and seeds
echo "🔄 Running migrations..."
php artisan migrate:fresh --force --seed

# Cache configuration
echo "📦 Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start the server
echo "🚀 Starting server on port ${PORT:-8080}..."
php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
