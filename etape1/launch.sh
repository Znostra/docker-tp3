#!/bin/bash

# Nettoyage ancien réseau et conteneurs
docker network rm tp3_net >/dev/null 2>&1
docker network create tp3_net

docker stop http script >/dev/null 2>&1
docker rm http script >/dev/null 2>&1

# Démarrage du conteneur PHP-FPM
docker run -d --name script \
  --network tp3_net \
  -v "$(pwd)/app:/app" \
  php:8.2-fpm

# Démarrage du conteneur NGINX relié à PHP-FPM
docker run -d --name http \
  --network tp3_net \
  -p 8080:80 \
  --link script:php \
  -v "$PWD/app:/app:ro" \
  -v "$PWD/config/default.conf:/etc/nginx/conf.d/default.conf:ro" \
  nginx:stable

echo "✅ Serveurs lancés. Teste sur : http://localhost:8080/"
