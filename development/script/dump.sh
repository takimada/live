#!/bin/bash

b_date=`date '+%d-%m-%y-%H-%M-%S'`

echo -n 'MySQL User:'
read    user
echo -n 'MySQL Password:'
read -s password
echo -en "\n"
echo -n 'Database:'
read    db_name


mysqldump -u$user -p$password $db_name | gzip -c > development/db/$b_date.sql.gz


