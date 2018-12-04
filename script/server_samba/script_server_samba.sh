#!/bin/bash

function verify() {
	if [ $? -eq 0 ]
	then
		echo "Success"
	else
		echo"Error, script exit"
		exit
	fi
}

function begin() {

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

# Mise à jour système

apt-get -y update
apt-get -y upgrade

fi

}

begin

if [ $statut = root ]
then

# Installation des différents paquets samba

apt-get install -y samba
verify
apt-get install -y samba-common-bin
verify

echo "---------- Fin de l'installation ---------"
sleep 1
