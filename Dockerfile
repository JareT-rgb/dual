# Use an official PHP image with Apache
FROM php:8.2-apache

# Install mysqli extension for database connections
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Copy application source code to the web server's document root
COPY . /var/www/html/

# Expose port 80 to the outside world
EXPOSE 80
