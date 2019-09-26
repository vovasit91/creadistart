#!/bin/sh

docker-compose run --rm php composer update --prefer-dist

docker-compose run --rm php composer install

docker-compose up -d --force-recreate
docker-compose run --rm php sh is-db-ready.sh "db" "php yii migrate"
docker-compose run --rm php sh is-db-ready.sh "db_test" "php tests/bin/yii migrate"
