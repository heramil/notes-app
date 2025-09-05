# ---- PHP 8.3 with Composer and needed PHP extensions ----
FROM php:8.3-cli

# System deps + PHP extensions
RUN apt-get update \
 && apt-get install -y git unzip libpq-dev libzip-dev \
 && docker-php-ext-install pdo_pgsql mbstring zip

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Install PHP deps first (better layer caching)
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-interaction --no-progress

# Now copy the rest of the app
COPY . /app

# Ensure Laravel can write caches/logs
RUN mkdir -p storage/framework/{cache,sessions,views} \
 && chmod -R 775 storage bootstrap/cache

# Start PHP’s built-in server; Render injects $PORT
CMD ["sh", "-lc", "php -S 0.0.0.0:$PORT -t public"]
