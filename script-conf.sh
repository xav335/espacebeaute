#!/bin/bash

SERVERNAME=/home/web/espacebeaute

chown -R www-data.www-data $SERVERNAME
chmod -R 755 $SERVERNAME
chmod -R 777 $SERVERNAME/log/spy.log
chmod -R 777 $SERVERNAME/admin/FileUpload/server/php/files
