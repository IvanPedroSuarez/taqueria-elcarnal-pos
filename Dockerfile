FROM php:8.1-cli

WORKDIR /app

COPY . .

# Install composer dependencies if composer.lock exists
RUN if [ -f composer.lock ]; then \
      curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
      composer install --no-dev --optimize-autoloader; \
    fi

EXPOSE 8080

CMD ["php", "-S", "0.0.0.0:8080", "-t", "."]
