#!/bin/bash

CONTAINER_NAME=lamp_web
PS_CNT=`docker ps -a --format "{{.Names}}" | grep ${CONTAINER_NAME} | wc -l`

docker-compose up -d
sleep 10

if [ ${PS_CNT} -lt 1 ]; then
    container_name=lamp_web
    docker exec ${container_name} ln -s /docker_initial_files/etc/httpd/conf.d/httpd.conf /etc/httpd/conf.d/httpd.conf
    docker exec ${container_name} mysql_install_db --datadir=/var/lib/mysql --user=mysql
    docker exec ${container_name} ln -s /docker_initial_files/etc/my.cnf.d/mysql.server.ext.cnf /etc/my.cnf.d/mysql.server.ext.cnf
    docker exec ${container_name} ln -s /docker_initial_files/etc/my.cnf.d/mysql.client.ext.cnf /etc/my.cnf.d/mysql.client.ext.cnf
    docker exec ${container_name} ln -s /docker_initial_files/etc/php.d/xdebug.ini /etc/php.d/xdebug.ini
fi
 
docker exec  ${container_name} chmod 777 /usr/local/bin/web/startup.sh
docker exec  ${container_name} /usr/local/bin/web/startup.sh
