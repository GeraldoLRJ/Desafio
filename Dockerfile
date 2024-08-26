# Use a imagem oficial do PHP com a versão 8.2
FROM php:8.2.7-cli

# Instala as extensões necessárias do PHP
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    bzip2 \
    libzip-dev \
    nodejs \
    npm \
    && docker-php-ext-install pdo_mysql zip

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instala Bower globalmente
RUN npm install -g bower

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia o projeto para o contêiner
COPY . /var/www/html

# Instala as dependências do Composer
RUN composer install

# Instala as dependências do npm
RUN npm install

# Instala jQuery usando Bower
RUN bower install jquery --allow-root

# Configura permissões
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expor a porta 8080 para o servidor embutido do Yii
EXPOSE 8080

# Comando padrão para rodar o servidor embutido do Yii
#CMD ["php", "yii", "serve", "--port=8080", "--docroot=/var/www/html/web", "--host=0.0.0.0"]
CMD ["php", "-S", "0.0.0.0:8080", "-t", "/var/www/html/web"]
