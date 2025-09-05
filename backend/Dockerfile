FROM php:7.4-apache

# Instala las extensiones necesarias
RUN docker-php-ext-install mysqli

# Copia el código del backend
COPY . /var/www/html

# Configura el directorio de trabajo
WORKDIR /var/www/html

# backend/Dockerfile
ENV MYSQL_DATABASE=nombre
ENV MYSQL_USER=usuario
ENV MYSQL_PASSWORD=clave
