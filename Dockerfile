ARG PHP_VERSION=8.2

FROM php:${PHP_VERSION}-apache

# Install PDO MySQL
RUN docker-php-ext-install pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Allow .htaccess overrides
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Serve the public front controller instead of exposing project internals
COPY docker/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY docker/start-apache.sh /usr/local/bin/start-apache.sh

# Copy app files
COPY . /var/www/html/

# Fix permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod +x /usr/local/bin/start-apache.sh

CMD ["/usr/local/bin/start-apache.sh"]

EXPOSE 10000