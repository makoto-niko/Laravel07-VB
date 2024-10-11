FROM php:8.1-apache-bullseye

# apt install iputils-ping net-tools で ping を導入
RUN apt-get update \
    && apt-get install -y zlib1g-dev libzip-dev unzip vim iputils-ping net-tools sudo\
    && docker-php-ext-install zip

# node と npm をインストール
RUN apt-get install -y gnupg
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash -\
    && apt-get install -y nodejs\
    && npm install npm@8.12.1 --global

# a2emod rewrite をして apache に rewrite モジュールを追加
# これをしないと Laravel でルート以外にアクセスできない
RUN a2enmod rewrite

# docker php には mysql 用のドライバが未インストールのため追加する
RUN docker-php-ext-install pdo_mysql

COPY --from=composer:2.4.1 /usr/bin/composer /usr/bin/composer

ADD docker/apache/php.ini /usr/local/etc/php/

# Apache の conf は seites-available に作成し
# a2ensite コマンドでシンボリックリンクを sites-enabled に作成する
ADD docker/apache/config/000-default.conf /etc/apache2/sites-available/
RUN a2ensite 000-default

WORKDIR /var/www/html

COPY ./webapp /var/www/html

RUN chown www-data storage/ -R \
    && composer install\
    && npm install
