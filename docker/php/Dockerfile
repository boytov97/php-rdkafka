FROM php:7.2-fpm

# - Use the “fix-missing” option with “apt-get update” to run the updates and ensure the packages
# are up to date and there is no new version available for the packages.
#
# - Install some packages/programs that we will need on installing library/extension/another program
#
# - /var/lib/apt/lists/: Storage area for state information for each package resource
# specified in sources.list(5)
# So it's something that apt-get update can recreate
RUN apt-get update --fix-missing \
    && apt-get install -y curl wget zip unzip git \
    && rm -rf /var/lib/apt/lists/*

# DEPENDENCIES
RUN apt-get update --fix-missing \
    && apt-get install -y  python \
    && rm -rf /var/lib/apt/lists/*

# KAFKA
# - Install librdkafka C library
# - Install extension rdkafka and enable it by adding 'extension=rdkafka.so'
RUN git clone --depth 1 https://github.com/edenhill/librdkafka.git \
    && ( \
        cd librdkafka \
        && ./configure \
        && make \
        && make install \
    ) \
    && pecl install rdkafka \
    && echo "extension=rdkafka.so" > /usr/local/etc/php/conf.d/rdkafka.ini
