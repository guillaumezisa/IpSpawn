#!/bin/bash


function begin () {

statut=$('whoami')


# Vérification des droits de l'éxécuteur du script

if [ $statut != root ]
then
	echo ""
	echo "Vous n'avez pas les droits n'écéssaires, contactez votre administrateur .."
	echo ""
	sleep 1
	exit

elif [ $statut = root ]
then

# Mise à jour

apt-get -y update
apt-get -y upgrade

fi

}

