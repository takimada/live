#!/bin/bash

path="development/db"

echo -n 'MySQL User:'
read    user
echo -n 'MySQL Password:'
read -s password
echo -en "\n"
echo -n 'Database:'
read    db_name
echo -n 'Sql full path and file name(10.04.2012): '
read    file

gunzip -c $path/$file.sql.gz > $path/$file.sql | mysql -u$user -p$password $db_name < $path/$file.sql | rm $path/$file.sql

