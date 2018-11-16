#!/bin/bash

source begin.sh

begin

if [ $statut = root ]
then

# Lancement de l'installation des différents paquets

debconf-set-selections <<< "postfix postfix/mailname string mail.ipspawn.com"
debconf-set-selections <<< "postfix postfix/main_mailer_type string 'Internet Site'"
apt-get install -y postfix
apt-get install -y dovecot-imapd
apt-get install -y mariadb-server
apt-get install -y postfix-mysql
apt-get install -y telnet
apt-get install -y mailutils
echo""
echo "FIN"
echo ""
fi

# Fin du programme
