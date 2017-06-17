#!/bin/bash
set -e 

echo "Migrating database 'php artisan migrate '..."
php artisan migrate
