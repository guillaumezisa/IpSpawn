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
