# Use PHP 8.3 CLI as the base image (Laravel 13 requires PHP 8.3+)
FROM php:8.3-cli-alpine

# Set working directory inside the container
WORKDIR /var/www/html

# Install system dependencies, PHP extensions, and Node.js
RUN apk add --no-cache \
    bash \
    curl \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    zip \
    libzip-dev \
    unzip \
    git \
    nodejs \
    npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd zip

# Install Composer globally
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Gemini CLI globally via NPM
RUN npm install -g @google/gemini-cli

# Copy existing application code and set permissions
COPY . .

# Expose port 3000 for the Vite local development server
EXPOSE 3000

# Default command to run Vite (automatically proxies or serves frontend assets)
#CMD ["npm", "run", "dev"]