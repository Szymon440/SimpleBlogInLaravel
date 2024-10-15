FROM php:8.2-fpm

# Instalacja wymaganych zależności
RUN apt update && apt install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    sqlite3 \
    libsqlite3-dev \
    zip \
    unzip \
    # Instalacja Node.js i NPM
    nodejs \
    npm

# Oczyszczenie po instalacji
RUN apt clean && rm -rf /var/lib/apt/lists/*

# Instalacja rozszerzeń PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd pdo_sqlite

# Kopiowanie Composer do kontenera
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Ustawienie katalogu roboczego
WORKDIR /var/www

# Skopiuj pliki aplikacji do kontenera
COPY . .

# Upewnij się, że plik bazy danych SQLite istnieje
RUN #touch database/database.sqlite && chmod 777 database/database.sqlite

# Komenda startowa
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
#CMD ["npm", "run", "dev"]