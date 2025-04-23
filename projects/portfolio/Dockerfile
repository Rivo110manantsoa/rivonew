FROM php:8.0-apache

RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    pkg-config \
    && docker-php-ext-install pdo_sqlite

RUN a2enmod rewrite

COPY projects/portfolio /var/www/html

COPY projects/portfolio/public/portfolio.db /var/www/html/portfolio.db

RUN chmod 644 /var/www/html/portfolio.db && \
    chown www-data:www-data /var/www/html/portfolio.db

RUN echo "DirectoryIndex index.php\nRewriteEngine On\nRewriteCond %{REQUEST_FILENAME} !-f\nRewriteCond %{REQUEST_FILENAME} !-d\nRewriteRule ^(.*)$ index.php [L]" > /var/www/html/public/.htaccess

WORKDIR /var/www/html/public

RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

RUN chmod -R 755 /var/www/html && \
    chown -R www-data:www-data /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]