#!/bin/bash

docker-compose stop

docker rm lamp_web
docker rmi lamp_web
