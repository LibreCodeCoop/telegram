#!/usr/bin/env bash

cd ${1}

composer install --no-ansi --no-dev --no-interaction --no-progress --no-scripts --optimize-autoloader
