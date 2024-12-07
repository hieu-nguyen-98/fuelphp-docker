FROM php:8.1-fpm

# Cài đặt các phụ thuộc cần thiết cho PHP và Git
RUN apt-get update && apt-get install -y \
    locales \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql

# Cài đặt và cấu hình locale en_US.UTF-8
RUN locale-gen en_US.UTF-8
ENV LANG en_US.UTF-8
ENV LC_ALL en_US.UTF-8
ENV LANGUAGE en_US.UTF-8

# Cài đặt Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Tạo thư mục ứng dụng
WORKDIR /var/www/html

# Chạy PHP-FPM
CMD ["php-fpm"]
