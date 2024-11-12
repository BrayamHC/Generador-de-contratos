# Usar la imagen base de PHP con Apache
FROM php:8.3-apache

# Instalar las dependencias necesarias y las extensiones de PHP
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libmagickwand-dev \
    zip \
    libzip-dev \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd zip bcmath sockets \
    && pecl install imagick \
    && docker-php-ext-enable imagick

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar el archivo default de Apache para que la ruta apunte a /var/www/html/public
COPY /apache/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY /apache/php.ini /usr/local/etc/php/php.ini

# Habilitar mod_rewrite de Apache (requerido por Laravel)
RUN a2enmod rewrite

# Establecer permisos correctos
RUN chown -R www-data:www-data /var/www

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Exponer el puerto 80
EXPOSE 80

# Ejecutar Apache en modo foreground
CMD ["apache2-foreground"]
