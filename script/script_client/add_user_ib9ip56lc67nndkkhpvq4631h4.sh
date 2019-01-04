#!/bin/bash
#-------------------------------------------------------------------------------
#SCRIPT D'AJOUT D'UTILISATEUR généré par IpSpawn.com
#V.1.1
#Le : 2018/12/06
#Script par Guillaume Zisa : zisa@intechinfo.fr
#-------------------------------------------------------------------------------
user[0]=
user[1]=
user[2]=
user[3]=
user[4]=
user[5]=
user[6]=
user[7]=
user[8]=
user[9]=
user[10]=
pass[0]=
pass[1]=
pass[2]=
pass[3]=
pass[4]=
pass[5]=
pass[6]=
pass[7]=
pass[8]=
pass[9]=
pass[10]=

#ROOT OBLIGATOIRE POUR L'EXECUTION----------------------------------------------
if [ $(whoami) == "root" ];then
  for ((y=0;y<11;y++))
  do
    #VERIFICATION DE L'EXISTENCE DE L'UTILISATEUR-------------------------------
    id -u ${user[$y]}> /dev/null 2>&1
    if [ $? == 0 ];
    then
      echo Nom d\'utilisateur déjà utilisé.
    else
      #CRÉATION D'UN UTILISATEUR------------------------------------------------
      useradd -m -d /home/${user[$y]} -s /bin/bash ${user[$y]}
      echo ${user[$y]}:${pass[$y]}| chpasswd
      groupdel -f  ${user[$y]}
    fi
  done
else
  echo Vous devez être root pour executer ce script
fi