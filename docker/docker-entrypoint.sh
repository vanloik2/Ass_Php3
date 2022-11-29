#!/bin/bash
set -e

composer install

php artisan migrate

php artisan serve

exec "$@"