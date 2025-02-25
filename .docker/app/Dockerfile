FROM composer:2 as composer

FROM php:8.3
SHELL ["/bin/bash", "-oeux", "pipefail", "-c"]

ARG UID=1000
ARG GID=1000
ENV COMPOSER_HOME=/composer
RUN groupmod -o -g ${GID} www-data && \
    usermod -o -u ${UID} -g www-data www-data

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /app

RUN apt-get update && \
    apt-get -y --no-install-recommends install \
    git \
    unzip && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* && \
    mkdir ${COMPOSER_HOME} && \
    chown -R www-data: ${COMPOSER_HOME} && \
    chown -R www-data: /var/www

USER www-data