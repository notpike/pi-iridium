#!/bin/bash
echo ''
echo '== STARTING PI-IRIDIUM SERVICES =='
echo ''

### START PI-IRIDIUM SERVICES
screen -d -m php artisan websockets:serve
screen -d -m sudo php artisan serve
screen -d -m php artisan queue:work --timeout

#LIST SCREEN SESSIONS
screen -ls