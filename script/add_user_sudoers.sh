#!/bin/bash

user=jim

if [ $(whoami) == "root" ];then
	if id "$user" &>/dev/null
	then
		usermod -G $user sudo
	else
		echo votre nom d\'utilisateur n\'est pas valide.
	fi
else
	echo "Vous devez être root"
fi
