#!/bin/bash

php artisan migrate --force
php artisan config:clear
php artisan cache:clear

apache2-foreground
