# Используем официальный образ PHP 8.3 с FPM
FROM php:8.3-fpm
# Устанавливаем рабочую директорию
WORKDIR /var/www
# Устанавливаем зависимости для Laravel
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo_pgsql
# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# Копируем composer.json и composer.lock
COPY composer*.json ./

RUN apt-get update && \
    apt-get install -y git unzip zip && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*
# Устанавливаем зависимости Composer
RUN composer install --no-scripts --no-autoloader
# Копируем код Laravel
COPY . .
# Генерируем автозагрузчик Composer
RUN composer dump-autoload
# Устанавливаем права для Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
# Открываем порт для PHP-FPM
ENV PORT=8080
EXPOSE 8080
# Запускаем PHP-FPM
CMD ["sh", "-c", "if [ -f /secrets/.env ]; then cp /secrets/.env /var/www/.env; fi && php-fpm"]
