#!/bin/sh

echo "🚀 Initializing container..."

# Ensure database directory and file exist
mkdir -p /var/www/html/database
if [ ! -f /var/www/html/database/database.sqlite ]; then
    echo "📄 Creating database.sqlite..."
    touch /var/www/html/database/database.sqlite
fi

# Fix permissions for SQLite
echo "🔒 Fixing permissions..."
chmod -R 777 /var/www/html/database
chmod -R 777 /var/www/html/storage
chmod -R 777 /var/www/html/bootstrap/cache

# Run migrations (allow failure to not crash container)
echo "🔄 Running migrations..."
php artisan migrate:fresh --force --seed || echo "⚠️ Migrations failed, but continuing..."

# Clear and cache config
echo "📦 Optimizing configuration..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start the server
PORT=${PORT:-8080}
echo "🌍 Starting server on 0.0.0.0:$PORT..."
exec php artisan serve --host=0.0.0.0 --port=$PORT
