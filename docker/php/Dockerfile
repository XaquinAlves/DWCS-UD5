ARG php_version
FROM php:${php_version}

# prepare install
RUN apt-get update --fix-missing
RUN apt-get install -y build-essential libssl-dev zlib1g-dev libpng-dev libjpeg-dev libfreetype6-dev

# install zip extension
RUN apt-get install -y libzip-dev && docker-php-ext-install zip

# install mysql extension
RUN docker-php-ext-install mysqli pdo pdo_mysql
#RUN docker-php-ext-install mysql
RUN docker-php-ext-install zip
#RUN docker-php-ext-install pear
RUN docker-php-ext-install bcmath
#RUN docker-php-ext-install intl
RUN apt-get -y update \
&& apt-get install -y libicu-dev \ 
&& docker-php-ext-configure intl \
&& docker-php-ext-install intl

#Install mysqli
RUN docker-php-ext-install mysqli

# install other extensions
#RUN apt-get install -y php-cli php-fpm php-json php-common php-mysql php-zip php-gd php-mbstring php-curl php-xml php-pear php-bcmath php-intl php-curl

# install gd extension
#RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/
RUN docker-php-ext-install gd

#Instalación de xdebug
RUN curl -sSLf \
        -o /usr/local/bin/install-php-extensions \
        https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions && \
    chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions xdebug

#Instalamos composer
RUN install-php-extensions @composer

RUN install-php-extensions decimal

#Instalamos phpcs y phpcbf
#Install PHP_CodeSniffer
RUN apt-get update && apt-get install -y wget && apt-get install -y vim && \
    wget https://squizlabs.github.io/PHP_CodeSniffer/phpcs.phar && \
    wget https://squizlabs.github.io/PHP_CodeSniffer/phpcbf.phar

RUN chmod u+x *.phar

RUN mv phpcbf.phar /usr/local/bin/phpcbf
RUN mv phpcs.phar /usr/local/bin/phpcs

#Para poder usar ping
#RUN apt-get update && apt-get install -y iputils-ping

#Cambiamos document root para apuntar al directorio del index
ARG document_root
ENV APACHE_DOCUMENT_ROOT=${document_root}
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN sed -i 's/-Indexes/+Indexes/' /etc/apache2/conf-available/docker-php.conf

COPY xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

#Modificar variables php.ini
ADD ./custom-php.ini /usr/local/etc/php/conf.d/custom-php.ini


RUN a2enmod rewrite
RUN a2enmod headers

