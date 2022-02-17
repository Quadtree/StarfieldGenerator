FROM php:8
RUN apt-get update && apt-get install -y zlib1g-dev libpng-dev
RUN docker-php-ext-configure gd
RUN docker-php-ext-install gd
