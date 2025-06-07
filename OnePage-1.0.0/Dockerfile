# Gunakan template resmi PHP 8.2 dengan server Apache
FROM php:8.2-apache

# Install ekstensi PHP yang umum untuk koneksi database MySQL/TiDB
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Salin semua file dari proyek Anda ke dalam folder web server di dalam "kotak" Docker
COPY . /var/www/html/