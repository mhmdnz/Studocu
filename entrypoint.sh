#!/bin/bash

cd /var/www/html
sh -c "php artisan migrate"
sh -c "php artisan db:seed"
sh -c "php artisan serve"

