FROM php:7.0-cli
WORKDIR /usr/src/myapp
ADD . /usr/src/myapp
RUN apt-get update \
    && apt-get install -y git zlib1g-dev \
    && docker-php-ext-install pdo pdo_mysql zip \
    && curl -sS https://getcomposer.org/installer \
    | php -- --install-dir=/usr/local/bin --filename=composer