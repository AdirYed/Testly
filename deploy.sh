git pull
yarn production
composer install --optimize-autoloader
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan opcache:clear
php artisan opcache:compile --force
php artisan migrate --force
systemctl start php7.4-fpm nginx
