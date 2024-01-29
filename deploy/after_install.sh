#!/bin/bash
echo "Clearing Cache"
cd /var/www/projects/ichs-be
php artisan migrate
echo "path changed"
exit
sudo su root
sudo bash run cc