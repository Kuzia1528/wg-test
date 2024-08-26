# Образ php + fpm + alpine из внешнего репозитория
FROM php:8.3.10-fpm-alpine3.20 AS base
 
# Задаем расположение рабочей директории
ENV WORK_DIR=/var/www/application

RUN set -xe \
    && apk --no-cache add postgresql-dev \
    && docker-php-ext-install -j$(nproc) pdo \
    && docker-php-ext-install -j$(nproc) pdo_pgsql

FROM base
 
# Указываем, что текущая папка проекта копируется в рабочую директорию контейнера
COPY . ${WORK_DIR}
 
# Устанавливаем права на папку приложения
RUN chmod -R 775 /var/www/application
 
# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
