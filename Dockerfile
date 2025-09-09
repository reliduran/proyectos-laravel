# Etapa 1: Composer - instalar dependencias
FROM composer:2 as vendor

WORKDIR /app

# Copiamos TODO el proyecto
COPY . .

# Instalamos dependencias de producción
RUN composer install --no-dev --no-interaction --optimize-autoloader

# Etapa 2: PHP + extensiones
FROM php:8.2-cli

WORKDIR /app

# Instalamos extensiones necesarias para Laravel
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git curl libpng-dev libonig-dev libxml2-dev zip \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl

# Copiamos vendor desde la primera etapa
COPY --from=vendor /app/vendor /app/vendor

# Copiamos todo el código del proyecto
COPY . .

# Railway usa el puerto 8080
ENV PORT=8080

# Comando para arrancar Laravel
CMD php artisan serve --host=0.0.0.0 --port=${PORT}
