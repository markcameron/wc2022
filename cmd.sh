#!/bin/sh

php artisan migrate --force -n

rr serve -c ./.rr.yaml