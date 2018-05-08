#!/usr/bin/env bash

if [ "${1}" != "dev" ]; then
  cd /root/app/bot.lyseon.tech
fi

APP="/var/www/app"
SCRIPTS="/var/www/app/scripts"

docker exec bot.lyseon.tech-app ${SCRIPTS}/composer-install.sh ${APP}

if [ ! -f ".env" ]; then
  cp .env.example .env
fi
