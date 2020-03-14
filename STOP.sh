#!/bin/bash

echo ''
echo '== STOPING PI-IRIDIUM SERVICES =='
echo ''

### STOP SERVICE
php artisan queue:flush
killall screen