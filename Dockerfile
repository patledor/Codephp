# 1. Base Image: Magsisimula tayo sa isang official PHP image na may Apache
FROM php:8.2-apache

# 2. Update at I-install ang mga System Dependencies at PHP Extensions
# Pinagsama ang lahat ng commands sa isang RUN instruction (mas mabilis)
RUN apt-get update && apt-get install -y \
        # System libraries para sa PostgreSQL, Zip, at GD
        libpq-dev \
        libzip-dev \
        unzip \
        git \
        libpng-dev \
    # I-install ang mga PHP Extensions
    && docker-php-ext-install pdo pdo_pgsql zip gd \
    # Linisin ang cache para lumiit ang image size
    && rm -rf /var/lib/apt/lists/*

# 3. I-copy ang iyong application code sa Apache web root
# Ipagpapalagay nito na ang lahat ng PHP files mo ay nasa root ng iyong repo.
COPY . /var/www/html/

# 4. Expose Port 80
# Ito ang port na ginagamit ng Apache. Ito ang default na aalamin ni Render.
EXPOSE 80

# (Hindi na kailangan ang comments 5 at 7, pero nilagay ko na sa final na ito.)
