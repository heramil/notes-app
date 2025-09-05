# ---- PHP runtime with Composer and PostgreSQL driver ----
FROM php:8.3-cli

# System deps + pdo_pgsql
RUN apt-get update \
 && apt-get install -y git unzip libpq-dev \
 && docker-php-ext-install pdo_pgsql

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . /app

# Install PHP deps and cache configs
RUN composer install --no-dev --optimize-autoloader \
 && php artisan config:cache && php artisan route:cache && php artisan view:cache

# Expose port (Render injects $PORT, php -S will bind to it in CMD)
EXPOSE 10000

# Start the PHP built-in server
CMD ["sh", "-lc", "php -S 0.0.0.0:$PORT -t public"]
