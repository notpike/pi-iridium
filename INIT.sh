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
cp .env.example .env      #Copys example .env to live .env
composer install          #Loads all Required PHP Scripts
npm install --save laravel-echo pusher-js
php artisan key:generate  #App Key Generation
php artisan migrate:fresh #Push DB Tables into DB
php artisan db:seed       #Seed DB with defult values
php artisan storage:link

echo 'Update the .env file with the system path for gr-iridium and iridium-tools'
