#!/bin/bash



statut=$('whoami')


# Vérification des droits de l'éxécuteur du script

if [ $statut != root ]
then
	echo ""
	echo "Vous n'avez pas les droits n'écéssaires, contactez votre administrateur .."
	echo ""
	exit

elif [ $statut = root ]
then

# Mise à jour

apt-get upgrade
apt-get update

# Lancement de l'installation des différents paquets

debconf-set-selections <<< "postfix postfix/mailname string mail.ipspawn.com"
debconf-set-selections <<< "postfix postfix/main_mailer_type string 'Internet Site'"
apt-get install -y postfix
apt-get install -y dovecot-imapd
apt-get install -y mariadb-server
apt-get install -y postfix-mysql
apt-get install -y telnet
apt-get install -y mailutils
echo ""
echo "FIN"
exit
fi

# Fin du programme
