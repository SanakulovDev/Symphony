# PHP 8.2 bazaviy tasviridan foydalanish
FROM php:8.3-fpm

# Yordamchi kutubxonalarni o'rnatish
RUN apt-get update && apt-get install -y \
    libpq-dev \
    git \
    unzip \
    libzip-dev \
    zip \
    curl \
    && docker-php-ext-install pdo pdo_pgsql zip

# Symfony CLI o'rnatish
RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony*/bin/symfony /usr/local/bin/symfony

# Composer o'rnatish
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Ishchi direktoriyani o'rnatish
WORKDIR /var/www/html

# Composer fayllarini konteynerga nusxalash
COPY composer.json composer.lock /var/www/html/

# Composer bog'liqliklarni o'rnatish va plaginlarni ruxsat berish
# Barcha loyihani nusxalash
COPY . .

# OPCache konfiguratsiyasi
RUN echo "opcache.memory_consumption=128" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.interned_strings_buffer=8" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.max_accelerated_files=4000" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.revalidate_freq=2" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.fast_shutdown=1" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.enable_cli=1" >> /usr/local/etc/php/conf.d/opcache.ini

    
# FPM socketini ishga tushirish
CMD ["php-fpm"]

# 9000 portini ochish
EXPOSE 9000
