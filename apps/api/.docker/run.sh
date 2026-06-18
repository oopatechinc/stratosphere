#!/bin/sh

cd /var/www

# Run necessary artisan commands
php artisan migrate
php artisan cache:clear
php artisan route:cache
php artisan passport:install
php artisan passport:client --personal

# copy environment to environment
env >> /etc/environment

#Make sure the storage folder has the right permissions
chown -R www:www-data /var/www/storage/*
chmod 755 /var/www/storage/oauth-private.key
chmod 755 /var/www/storage/oauth-public.key

# Activate supervisor for process monitoring
/usr/bin/supervisord -c /etc/supervisor/supervisord.conf
