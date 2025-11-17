FROM serversideup/php:8.3-cli

USER root

RUN install-php-extensions imagick bcmath gd intl

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    neovim \
    libzip-dev \
    default-mysql-client \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

COPY --from=node:lts-jod /usr/local /usr/local

# Verify Node.js and npm installation
RUN node --version && npm --version

USER www-data

WORKDIR /var/www/html

COPY . .


USER root

COPY --chmod=755 ./docker/entrypoints/ /etc/entrypoint.d/

RUN composer install --no-interaction --optimize-autoloader --no-scripts \
    && npm i \
    && npm run build

RUN mkdir -p /var/www/html/storage/logs \
    && mkdir -p /var/www/html/bootstrap/cache \
    && chown -R www-data:www-data /var/www/html/ \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache \
    && chmod -R 777 /var/www/html/storage/logs

USER www-data
