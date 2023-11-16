#!/bin/bash

# Nombre del archivo de respaldo de MySQL
fecha_mysql=$(date)
respaldo_mysql="ezmatech_$fecha_mysql.sql"

# Nombre del directorio de respaldo de /etc
fecha_etc=$(date)
respaldo_etc="etc_$fecha"

#Crear el archivo de respaldo de MySQL utilizando mysqldump
mysqldump -u bruno -p ezmatech > /root/respaldo/ezmatech.sql
#Crear el respaldo de /etc /root/respaldo
