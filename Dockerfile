# Etapa 1: Dependencias con Composer
FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --optimize-autoloader

# Etapa 2: Imagen PHP con extensiones necesarias
FROM php:8.2-cli
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git curl libpng-dev libonig-dev libxml2-dev zip \
 && docker-php-ext-install pdo_mysql mbstring zip exif pcntl

# Copiar dependencias de la etapa vendor
COPY --from=vendor /app /app

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . /app

# Instalar dependencias (si cambió algo desde la etapa vendor)
RUN composer install --no-dev --no-interaction --optimize-autoloader || true

# Permisos correctos
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache || true

# Exponer puerto
EXPOSE 8000

# Comando por defecto: arrancar Laravel
CMD php artisan serve --host=0.0.0.0 --port=$PORT
