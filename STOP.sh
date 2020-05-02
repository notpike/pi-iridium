#!/bin/bash

echo ''
echo '== STOPING PI-IRIDIUM SERVICES =='
echo ''

### STOP SERVICE
php artisan queue:flush
# php artisan migrate --path=/database/migrations/2020_03_09_054754_create_jobs_table.php
killall screen