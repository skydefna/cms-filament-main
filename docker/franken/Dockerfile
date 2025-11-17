FROM dunglas/frankenphp:php8.4-bookworm

# Install git and zip utilities
RUN apt-get update && apt-get install -y \
    git \
    neovim \
    unzip \
    libzip-dev \
#    supervisor \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions required for Laravel
RUN install-php-extensions \
    pdo_mysql \
    gd \
    pcntl \
    intl \
    opcache \
    zip \
    redis \
    bcmath \
    opcache

# Configure PHP
COPY docker/franken/franken.ini /usr/local/etc/php/conf.d/franken.ini

COPY --from=node:lts-jod /usr/local /usr/local

# Verify Node.js and npm installation
RUN node --version && npm --version

# Set working directory
WORKDIR /app

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . .

# Set proper permissions
RUN chown -R www-data:www-data /app \
    && chmod -R 755 /app/storage /app/bootstrap/cache \
    && chmod -R 775 /app/storage/logs

# Configure FrankenPHP
ENV FRANKENPHP_CONFIG="worker /app/public/index.php"

COPY ./docker/franken/entrypoint.sh /usr/local/bin/entrypoint.sh

RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
