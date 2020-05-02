#!/bin/bash
echo ''
echo '== STARTING PI-IRIDIUM SERVICES =='
echo ''

### START PI-IRIDIUM SERVICES
screen -d -m php artisan websockets:serve
screen -d -m php artisan serve --host $(hostname -I)
screen -d -m php artisan queue:work --timeout

#LIST SCREEN SESSIONS
screen -ls