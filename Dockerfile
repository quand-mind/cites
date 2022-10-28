FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libzip-dev \
        zip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd zip

RUN docker-php-ext-install pdo pdo_mysql sockets
RUN curl -sS https://getcomposer.org/installer​ | php -- \
     --install-dir=/usr/local/bin --filename=composer

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .
RUN composer install
RUN composer dump-autoload

COPY [".", "./"]
RUN cp .env.example .env

RUN php artisan key:generate
RUN php artisan jwt:secret
RUN php artisan migrate:fresh --seed
RUN chmod 777 -R storage

CMD php artisan serve --host=0.0.0.0 --port=8000
EXPOSE 8000