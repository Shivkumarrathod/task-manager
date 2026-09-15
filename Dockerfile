FROM php:8.2-apache

RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN a2enmod rewrite

# Point Apache's document root at public/, not the project root —
# this is what keeps app/, core/, config/ out of reach of a browser.
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# Allow .htaccess overrides so RewriteRule works
RUN sed -ri -e 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

COPY . /var/www/html/

# CA bundle for verifying Azure Database for MySQL Flexible Server TLS certs
ENV DB_SSL_CA=/var/www/html/certs/mysql-ca-bundle.pem

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
