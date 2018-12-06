#!/bin/bash

enter=lol
user=guillaume
group=guillaume
if [ $(whoami) == "root" ];then
	if [ ["-f $enter || -d $enter"] ];
	then
		chown $user":"$group $enter
	else
		echo "blyat";
	fi
else
	echo "Vous devez être root"
fi
