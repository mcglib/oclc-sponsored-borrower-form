FROM ubuntu:latest
#FROM php:7.2-apache

MAINTAINER Masashi Shinbara <shin1x1@gmail.com>


# Install PHP extensions
RUN apt-get update && apt-get install -y \
      libicu-dev \
      libpq-dev \
      libmcrypt-dev

RUN export LANG=en_US.UTF-8 \
  && apt-get update \
  && apt-get -y install apache2

ENV TZ=America/NewYork
ENV DEBIAN_FRONTEND=noninteractive 
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
RUN apt-get -y install libapache2-mod-php7.2 php7.2 php7.2-cli php-xdebug php7.2-mbstring sqlite3 php7.2-mysql 

RUN apt-get -y install php-imagick php-memcached php-pear curl imagemagick php7.2-phpdbg php7.2-gd nodejs php7.2-json php7.2-curl php7.2-sqlite3 php7.2-intl vim git-core wget libsasl2-dev libssl-dev libcurl4-openssl-dev autoconf g++ make openssl libssl-dev libcurl4-openssl-dev pkg-config libsasl2-dev libpcre3-dev zip unzip


# Install Xdebug

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

# Put apache config for Laravel
COPY apache.conf /etc/apache2/sites-available/laravel.conf
RUN a2dissite 000-default.conf && a2ensite laravel.conf && a2enmod rewrite

# Change uid and gid of apache to docker user uid/gid
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

WORKDIR /var/www/html

#CMD service apache2 start
#ENTRYPOINT [ "service apache2 start" ]
ENTRYPOINT ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
#CMD ["apache2", "-D", "FOREGROUND"]
