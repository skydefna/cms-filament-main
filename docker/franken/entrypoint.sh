#!/bin/sh

set -e

echo "🔁 Running Laravel Entrypoint Script"

# Wait for DB if needed
if [ "$WAIT_FOR_DB" = "true" ]; then
  echo "⏳ Waiting for database..."
  until nc -z -v -w30 "$DB_HOST" "$DB_PORT"; do
    echo "🔄 Waiting for database at $DB_HOST:$DB_PORT..."
    sleep 2
  done
  echo "✅ Database is up!"
fi

composer install --no-interaction
echo "✅ Install Composer done!"

npm i && npm run build
echo "✅Vite build assets done!"

echo "🔍Running package:discover"
php artisan package:discover
echo "⚙️Running Laravel artisan commands..."
php artisan optimize:clear
php artisan optimize
echo "✅ Laravel setup complete!"
php artisan octane:frankenphp --workers=4
