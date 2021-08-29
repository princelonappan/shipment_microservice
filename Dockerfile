FROM php:7.3-fpm-alpine
RUN mkdir -p /var/www/html/shipment-service/
WORKDIR /var/www/html/shipment-service/
COPY . /var/www/html/shipment-service/

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

RUN composer install
#EXPOSE 8006
#RUN php -S localhost:8006 -t public

#CMD ["php", "-S localhost:8006 -t public"]
