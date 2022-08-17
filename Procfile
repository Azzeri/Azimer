web: vendor/bin/heroku-php-apache2 public/
worker: composer install
worker: php artisan migrate:fresh -seed
worker: npm install

