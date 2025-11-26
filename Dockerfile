FROM php:8.2-apache

# 1. Install System Libraries (System-level dependencies)
# Kailangan muna ito bago ang PHP extension
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    unzip \
    git \
    libpng-dev \
    && rm -rf /var/lib/apt/lists/*

# 2. Install at I-enable ang PHP Extensions
# Hinihiwalay ang RUN para tiyak na tama ang environment.
RUN docker-php-ext-install pdo pdo_pgsql zip gd

# 3. Kopyahin ang code sa web root
COPY . /var/www/html/

EXPOSE 80
