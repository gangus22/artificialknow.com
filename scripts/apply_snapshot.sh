#!/bin/sh

. ../.env

env=$APP_ENV
host=$DB_HOST
port=$DB_PORT
user=$DB_USERNAME
pw=$DB_PASSWORD
dbname=$DB_DATABASE

mysql --user=$user --password=${DB_PASSWORD} -e "DROP DATABASE IF EXISTS ``$dbname``" &&
mysql --user=$user --password=${DB_PASSWORD} -e "CREATE DATABASE ``$dbname``" &&
mysql --user=$user --password=${DB_PASSWORD} $dbname < $1
