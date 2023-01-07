#!/bin/bash
cd /opt/app/ && php bin/composer install
php -S 0.0.0.0:8080 router.php