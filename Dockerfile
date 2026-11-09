# Usa a imagem oficial do PHP com Apache
FROM php:8.2-apache

# O ponto de entrada da aplicação fica em public/.
ENV APACHE_DOCUMENT_ROOT=/var/www/public

# Instala PDO, o driver PDO para MySQL e a extensão mysqli
RUN docker-php-ext-install pdo pdo_mysql mysqli \
	&& rm -rf /var/lib/apt/lists/* \
	&& sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
		/etc/apache2/sites-available/*.conf \
		/etc/apache2/apache2.conf

# Habilita o mod_rewrite do Apache (opcional, mas muito útil)
RUN a2enmod rewrite