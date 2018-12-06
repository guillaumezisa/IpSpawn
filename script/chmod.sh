#!/bin/bash

enter=file
right=000

if [ $(whoami) == "root" ];then
	if [ ["-f $enter || -d $enter"] ];
	then
		chmod $right $enter
	else
		echo "blyat";
	fi
else
	echo "Vous devez être root"
fi
