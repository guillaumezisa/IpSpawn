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

# Création du fichier pour le groupe
sudo touch /home/aquota.group

# Création du fichier pour l'utilisateur
sudo touch /home/aquota.user

# Application des droits
sudo chmod 600 /home/aquota.*

# Montage de la partition créée
sudo mount -o remount /home

# Initialisation du système de quota
sudo quotacheck -vagum /home

# Fixation des quotas des utilisaturs
sudo update-alternatives --config editor

# Fixation des droits pour un utilisateur
sudo edquota -u $user

# Fixation des droits pour un groupe
sudo edquota -g $group

# Vérification des droits fixés sur les utilisateurs
sudo repquota -a

# Activation des quotas
sudo quotaon -avug
