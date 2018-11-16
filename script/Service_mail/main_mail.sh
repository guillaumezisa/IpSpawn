#!/bin/bash
source function_verify.sh
source function_begin.sh

function_begin

if [ $statut = root ]
then

# Lancement de l'installation des différents paquets

debconf-set-selections <<< "postfix postfix/mailname string mail.ipspawn.com"
verify
debconf-set-selections <<< "postfix postfix/main_mailer_type string 'Internet Site'"
verify
apt-get install -y postfix
verify
apt-get install -y dovecot-imapd
verify
apt-get install -y mariadb-server
verify
apt-get install -y postfix-mysql
verify
apt-get install -y telnet
verify
apt-get install -y mailutils
verify
echo "---------- FIN ----------"
fi

# Fin du programme
