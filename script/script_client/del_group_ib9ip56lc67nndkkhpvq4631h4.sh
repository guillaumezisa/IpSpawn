#!/bin/bash
#-------------------------------------------------------------------------------
#SCRIPT DE SUPPRESSION DE GROUPE généré par IpSpawn.com
#V.1.3
#Le : 2018/12/06
#Script par Guillaume Zisa : zisa@intechinfo.fr
#-------------------------------------------------------------------------------
group[0]=dsqdsq
group[1]=<script> alert("hacked"); </script>
group[2]=
group[3]=
group[4]=
group[5]=
group[6]=
group[7]=
group[8]=
group[9]=
group[10]=
group[11]=
group[12]=

#ROOT OBLIGATOIRE POUR L'EXECUTION----------------------------------------------
if [ $(whoami) == "root" ];then
  for ((y=0;y<13;y++))
  do
    #VÉRIFICATION DE L'EXISTANCE DU GROUPE--------------------------------------
    if grep "^${group[$y]}:" /etc/group > /dev/null;
    then
      #SUPPRESSION DU GROUPE----------------------------------------------------
      groupdel ${group[$y]}

    else
      echo Le groupe n'existe pas.
    fi
  done
else
  echo Vous devez être root pour executer ce script
fi