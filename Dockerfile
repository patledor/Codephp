FROM php:8.2-apache

# 1. I-install ang mga System Libraries (Kailangan para sa PostgreSQL)
RUN apt-get update && apt-get install -y \
        libpq-dev \
        libzip-dev \
        unzip \
        git \
        libpng-dev \
    # Linisin ang apt cache pagkatapos
    && rm -rf /var/lib/apt/lists/*

# 2. I-install at I-enable ang mga PHP Extensions
# Hinihiwalay ito para masigurado na mahanap ang libpq-dev
RUN docker-php-ext-install pdo pdo_pgsql zip gd

# Kopyahin ang code sa web root
COPY . /var/www/html/

EXPOSE 80
