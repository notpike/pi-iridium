#!/bin/bash

echo '' 
echo '== INIT PI-IRIDIUM =='
echo ''

### MYSQL INIT
echo '== INIT MYSQL DB =='
mysql -u root -p < DB_INIT.sql
echo '' 

### LARAVEL INIT
echo '== INIT LARAVEL =='
composer install
npm install
php artisan migrate:fresh
php artisan db:seed
