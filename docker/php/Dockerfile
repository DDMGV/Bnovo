# Используем базовый образ PHP 8.2.1 FPM
FROM php:8.2.1-fpm

# Обновление списка пакетов и установка необходимых расширений
RUN apt-get update && \
    apt-get install -y --no-install-recommends libpq-dev git unzip && \
    docker-php-ext-install pdo pdo_mysql && \
    pecl install xdebug-3.2.0 && \
    docker-php-ext-enable xdebug && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Копируем конфигурационные файлы PHP из локальной директории в контейнер
COPY docker/php/conf.d/ $PHP_INI_DIR/conf.d/

# Запуск PHP-FPM
CMD ["php-fpm"]
