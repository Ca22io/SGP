FROM php:8.2-apache

# Define o ponto de entrada sem espaços ao redor do "="
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

<<<<<<< HEAD
# Atualiza os pacotes, instala extensões do PostgreSQL e aponta o Apache para /public
RUN apt-get update \
    && apt-get install -y --no-install-recommends libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql \
    && rm -rf /var/lib/apt/lists/* \
    && sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Habilita o mod_rewrite do Apache
RUN a2enmod rewrite
=======
# Instala PDO, o driver PDO para MySQL e a extensão mysqli
RUN docker-php-ext-install pdo pdo_mysql mysqli \
	&& rm -rf /var/lib/apt/lists/* \
	&& sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
		/etc/apache2/sites-available/*.conf \
		/etc/apache2/apache2.conf

# Habilita o mod_rewrite e permite o uso do .htaccess em public/
RUN a2enmod rewrite \
	&& printf '%s\n' '<Directory /var/www/public>' '    AllowOverride All' '    Require all granted' '</Directory>' \
		> /etc/apache2/conf-available/app.conf \
	&& a2enconf app
>>>>>>> 2d54c2fb24edfac700422f7d3bbd069e5677bb02
