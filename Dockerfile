FROM php:8.4-cli

# 必要なツール + MySQLドライバ（pdo_mysql）を入れる
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev \
  && docker-php-ext-install pdo_mysql \
  && rm -rf /var/lib/apt/lists/*

# Composer を入れる（公式Composerイメージからコピー）
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
