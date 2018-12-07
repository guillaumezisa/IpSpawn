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

# Installation des différents paquets quota pour samba

apt-get install -y quota
verify
echo "---------- Fin de l'installation ---------"
sleep 1

# Configuration système (édition du fichier /etc/fstab.cf)
echo -e "
# <file system> <mount point>   <type>  <options>       <dump>  <pass>
proc            /proc           proc    defaults        0       0
# /dev/sda1 -- converted during upgrade to edgy
UUID=8840ac3b-7209-4e00-a79e-d393de74e0ca / ext3 defaults,errors=remount-ro 0 1
# /dev/sdb1 -- converted during upgrade to edgy
UUID=af16a96e-6ecf-4083-9a77-b21fedf09e5d /home ext3 defaults,usrquota,grpquota 0 2
# /dev/sda2 -- converted during upgrade to edgy
UUID=6263979f-794c-43c8-a95b-b33627978928 none swap sw 0 0" >> /etc/fstab.cf

echo "---------- Fin de l'installation ---------"
sleep 1
