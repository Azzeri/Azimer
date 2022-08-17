web: vendor/bin/heroku-php-apache2 public/
worker: composer install && php artisan migrate:fresh -seed && npm install

