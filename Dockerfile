FROM php:7.4

RUN apt update && apt install -y --no-install-recommends libffi-dev \
&& rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install ffi

RUN apt-get update && apt-get install -y apt-utils unzip git

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

COPY . /app