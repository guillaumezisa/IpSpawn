#!/bin/bash

useradd -m -d "/home/$1" -s /bin/bash $1
echo "$1:$2"| chpasswd
groupdel -f  $1
exit
