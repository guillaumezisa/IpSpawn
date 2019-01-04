#!/bin/bash
#-------------------------------------------------------------------------------
#SCRIPT D'INSTALLATION D'NGINX généré par IpSpawn.com
#V.1.4
#Le : 2018/12/06
#Script par Guillaume Zisa : zisa@intechinfo.fr
#-------------------------------------------------------------------------------

#ROOT OBLIGATOIRE POUR L'EXECUTION----------------------------------------------
if [ $(whoami) == "root" ];then

  #INSTALLATION DES PAQUETS IMPORTANT-------------------------------------------
  apt install nginx -y
  apt install php-fpm -y
  apt install php -y
  apt install mariadb-server -y

  #MODIFICATION DU FICHIER DEFAULT POUR AUTORISER LE PHP------------------------
  sed -i -r '44s/index.html/index.html index.php/g' /etc/nginx/sites-available/default
  sed -i -r '56s/#//g' /etc/nginx/sites-available/default
  sed -i -r '57s/#//g' /etc/nginx/sites-available/default
  sed -i -r '60s/#//g' /etc/nginx/sites-available/default
  sed -i -r '63s/#//g' /etc/nginx/sites-available/default

  service nginx restart
  echo Installation réussie
else
  echo Vous devez être root pour executer ce script;
fi
