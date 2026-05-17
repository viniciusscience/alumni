FROM php:8.4-apache

# Instala extensões do sistema e dependências do PHP
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libmagickwand-dev \
    imagemagick \
    ghostscript \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libicu-dev \
    libxml2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install zip mysqli pdo pdo_mysql gd bcmath intl opcache \
    && pecl install imagick redis \
    && docker-php-ext-enable imagick redis \
	&& curl -sLO https://github.com/tailwindlabs/tailwindcss/releases/latest/download/tailwindcss-linux-x64 \
    && chmod +x tailwindcss-linux-x64 \
    && mv tailwindcss-linux-x64 /usr/local/bin/tailwindcss \
	&& apt-get clean && rm -rf /var/lib/apt/lists/*

# Habilita o mod_rewrite do Apache (essencial para Laravel/Symfony)
RUN a2enmod rewrite

# Instala o Composer copiando-o da imagem oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define o diretório de trabalho
WORKDIR /var/www/html
