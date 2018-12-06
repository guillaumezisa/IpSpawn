#!/bin/bash

group=banana

if [ $(whoami) == "root" ];then
	if [[ "cat /etc/group |grep $group" != "" ]] &>/dev/null
	then
		echo "$group	ALL=(ALL:ALL) ALL" >> /etc/sudoers
	else
		echo Votre nom de groupe n\'existe pas.
	fi
else
	echo "Vous devez être root";
fi
