# Use the latest microsoft PHP image
FROM mcr.microsoft.com/devcontainers/php:latest

# Install MariaDB client
RUN apt-get update && export DEBIAN_FRONTEND=noninteractive \
    && apt-get install -y mariadb-client \ 
    && apt-get clean -y && rm -rf /var/lib/apt/lists/*

# Install php-mysql drivers
RUN docker-php-ext-install mysqli pdo pdo_mysql