#!/bin/sh

source ../.env

env=$APP_ENV
host=$DB_HOST
port=$DB_PORT
user=$DB_USERNAME
pw=$DB_PASSWORD
dbname=$DB_DATABASE

mysqldump -u ${DB_USERNAME} --password=${DB_PASSWORD} --databases ${DB_DATABASE} > ../database/snapshots/snapshot-`date +"%Y-%m-%d-%T"`.sql
