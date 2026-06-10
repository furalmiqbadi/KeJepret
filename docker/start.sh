#!/usr/bin/env bash
set -e

php artisan config:cache
php artisan view:cache
php artisan migrate --force

apache2-foreground
