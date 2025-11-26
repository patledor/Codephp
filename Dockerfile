# 1. Base Image: Magsisimula tayo sa isang official PHP image na may Apache
FROM php:8.2-apache

# 2. Update at I-install ang mga PHP Extensions na kailangan mo
# Ito ay isang halimbawa lang. Palitan o dagdagan batay sa iyong project.
RUN apt-get update && apt-get install -y \
        libzip-dev \
        unzip \
        git \
        libpng-dev \
    && rm -rf /var/lib/apt/lists/*

# 3. I-enable ang mga PHP Extensions
RUN docker-php-ext-install pdo pdo_mysql zip gd

# 4. I-copy ang iyong application code sa Apache web root
# Ipagpapalagay nito na ang lahat ng PHP files mo ay nasa root ng iyong repo.
COPY . /var/www/html/

# 5. I-configure ang Apache (Opsyonal, ngunit karaniwang ginagamit)
# Ito ay para siguruhin na tama ang configuration ng Apache para sa PHP.
# Kung ang iyong entry point ay 'index.php', hindi na kailangan.

# 6. Expose Port 80
# Ito ang port na ginagamit ng Apache. Ito ang default na aalamin ni Render.
EXPOSE 80

# 7. Start Command: Ang base image na 'php:8.2-apache' ay may sariling command
# para simulan ang Apache, kaya wala na tayong kailangang ilagay dito.
