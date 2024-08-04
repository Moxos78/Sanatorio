# Usa una imagen base oficial de PHP
FROM php:8.1-cli

# Instala extensiones necesarias para Laravel y PostgreSQL
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libicu-dev \
    libzip-dev \
    unzip \
    libpq-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql \
    && docker-php-ext-install intl \
    && docker-php-ext-install zip

# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Establece el directorio de trabajo
WORKDIR /var/www

# Copia los archivos de la aplicación
COPY . .

# Instala las dependencias de la aplicación
RUN composer install --no-dev --optimize-autoloader

RUN php artisan optimize:clear \
    && php artisan filament:optimize-clear \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache \
    && php artisan icons:cache \
    && php artisan filament:cache-components \
    && php artisan event:cache \
    && php artisan optimize \
    && php artisan filament:optimize

# Exponer el puerto 8080 y usa el servidor embebido de PHP para correr la aplicación
CMD php artisan serve --host=0.0.0.0 --port=8080

EXPOSE 8080
