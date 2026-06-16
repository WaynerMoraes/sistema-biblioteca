FROM php:8.2-apache

# Habilita o módulo de reescrita de URL do Apache (muito útil para rotas de API)
RUN a2enmod rewrite

# Instala as extensões do PHP necessárias para o MySQL
RUN docker-php-ext-install pdo pdo_mysql