#!/usr/bin/env bash

sleep 5
php sf4/bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration

php-fpm