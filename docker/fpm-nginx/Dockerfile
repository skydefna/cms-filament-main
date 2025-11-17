FROM serversideup/php:8.3-fpm-nginx

USER root

RUN install-php-extensions imagick bcmath gd intl

USER www-data

WORKDIR /var/www/html

COPY . .

USER root

COPY --chmod=755 ./docker/entrypoints/ /etc/entrypoint.d/

# Add NodeSource repository for Node.js 20 LTS and install Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get update \
    && apt-get install -y nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Verify Node.js and npm installation
RUN node --version && npm --version

RUN composer install --prefer-dist --no-interaction --no-dev --optimize-autoloader --no-scripts \
    && npm i \
    && npm run build

RUN mkdir -p /var/www/html/storage/logs \
    && mkdir -p /var/www/html/bootstrap/cache \
    && chown -R www-data:www-data /var/www/html/ \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache \
    && chmod -R 777 /var/www/html/storage/logs

USER www-data
