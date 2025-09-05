# --- Minimal, reliable Laravel API image on PHP 8.3 ---
FROM php:8.3-cli

ENV DEBIAN_FRONTEND=noninteractive \
    COMPOSER_ALLOW_SUPERUSER=1

# System deps + PostgreSQL driver
RUN set -eux; \
    apt-get update; \
    apt-get install -y --no-install-recommends git unzip libpq-dev; \
    docker-php-ext-install pdo_pgsql mbstring; \
    rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Install PHP deps first for better layer caching
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-interaction --no-progress

# Copy the app
COPY . .

# Ensure writable dirs
RUN mkdir -p storage/framework/{cache,sessions,views} \
 && chmod -R 775 storage bootstrap/cache

# Start PHP’s built-in server; Render injects $PORT
CMD ["sh", "-lc", "php -S 0.0.0.0:$PORT -t public"]
