#!/bin/bash

docker network rm tp3_net >/dev/null 2>&1
docker network create tp3_net

docker stop http script data >/dev/null 2>&1
docker rm   http script data >/dev/null 2>&1

# MariaDB + init SQL
docker run -d --name data --network tp3_net \
  -e MARIADB_ROOT_PASSWORD=rootpwd \
  -e MARIADB_DATABASE=tp3 \
  -e MARIADB_USER=tp3 \
  -e MARIADB_PASSWORD=tp3pwd \
  -v "$(pwd)/db-init:/docker-entrypoint-initdb.d:ro" \
  mariadb:10.11

# PHP-FPM avec mysqli (build local)
docker build -t php-script:tp3 -f Dockerfile .
docker run -d --name script --network tp3_net \
  -v "$(pwd)/app:/app:ro" \
  php-script:tp3

# NGINX
docker run -d --name http --network tp3_net -p 8080:80 \
  -v "$PWD/app:/app:ro" \
  -v "$PWD/config/default.conf:/etc/nginx/conf.d/default.conf:ro" \
  nginx:stable
