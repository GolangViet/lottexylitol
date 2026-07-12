FROM php:8.4-fpm

WORKDIR /var/www

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        acl \
        git \
        g++ \
        libcurl4-openssl-dev \
        libfreetype6-dev \
        libicu-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libssl-dev \
        libwebp-dev \
        libxml2-dev \
        libzip-dev \
        pkg-config \
        procps \
        unzip \
        zip \
        zlib1g-dev \
    && docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
        --with-webp \
    && docker-php-ext-install -j"$(nproc)" \
        mysqli \
        pdo_mysql \
        gd \
        intl \
        opcache \
        pdo_mysql \
        xml \
        zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/pear

CMD ["php-fpm"]
