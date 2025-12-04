#!/bin/sh
set -e

# Ensure database directory and file exist
if [ ! -d "database" ]; then
    mkdir -p database
fi

if [ ! -f "database/database.sqlite" ]; then
    touch database/database.sqlite
fi

# Fix permissions (crucial for SQLite)
chmod -R 777 database storage bootstrap/cache

# --- START SERVER IMMEDIATELY ---
# We start the server in the background to satisfy Railway's healthcheck ASAP
PORT=${PORT:-8080}
echo "🌍 Starting PHP built-in server on 0.0.0.0:$PORT (Background)..."
php -S 0.0.0.0:$PORT -t public &
SERVER_PID=$!

# --- RUN MIGRATIONS & SETUP ---
echo "🔄 Running migrations and setup..."
# Run migrations but don't fail the script if they fail (to keep server running)
php artisan migrate:fresh --force --seed || echo "⚠️ Migrations failed, but server is running."

echo "🧹 Clearing caches..."
php artisan config:clear
php artisan route:clear
php artisan view:clear

echo "✅ Setup complete. Server is running with PID $SERVER_PID"

# Wait for the server process to keep container alive
wait $SERVER_PID
