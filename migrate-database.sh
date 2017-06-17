#!/bin/bash
set -e 

echo "Migrating database 'php artisan migrate '..."
php artisan migrate
php artisan serve --port=8080