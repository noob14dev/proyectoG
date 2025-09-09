FROM php:7.4-apache

# Instala las extensiones necesarias
RUN docker-php-ext-install mysqli

# Copia el código del backend
COPY . /var/www/html

# Configura el directorio de trabajo
WORKDIR /var/www/html
