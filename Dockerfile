FROM php:8.2-cli

WORKDIR /app

RUN apt-get update && apt-get install -y \
    unzip git curl libzip-dev libpq-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql pgsql zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . .

RUN npm install && npm run build

RUN composer install --no-dev --optimize-autoloader
RUN php artisan config:clear || true
RUN php artisan route:clear || true
RUN php artisan view:clear || true

CMD php artisan serve --host=0.0.0.0 --port=10000