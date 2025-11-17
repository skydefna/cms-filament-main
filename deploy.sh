git reset --hard HEAD && git clean -fd
git fetch && git merge
chmod -R 775 ./storage/logs
composer install --no-dev --no-interaction --optimize-autoloader
php artisan queue:flush
php artisan optimize:clear
php artisan setting:clear-cache
php artisan migrate --force
npm i && npm run build
php artisan optimize
