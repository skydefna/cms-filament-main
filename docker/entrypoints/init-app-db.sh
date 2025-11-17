#!/bin/bash

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

# Only run artisan commands if artisan exists
if [ -f artisan ]; then
  echo "⚙️  Running Laravel artisan commands..."

  echo "🔍 Running package:discover"
  php artisan package:discover

#
#  if [ "$AUTORUN_MIGRATE" = "true" ]; then
#    echo "🧬 Running migrations"
#    php artisan migrate --force || true
#  fi

  echo "✅ Laravel setup complete!"
fi
