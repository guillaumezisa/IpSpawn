#!/bin/bash

#DÉCLARATION DES VARIABLES

group="sudo";
command[0]="ls";
execution[0]="yes";
password[0]="yes";
command[1]="vim";
execution[1]="yes";
password[1]="no";
command[2]="vim";
execution[2]="no";
password[2]="no";
command[3]="vim";
execution[3]="yes";
password[3]="yes";

for((i=0;i<4;i++));do
  #VARIABLES DE VERIFICATION
  group_exist=$(cat /etc/group | grep $group);
  group_exist_sudoers=$(cat /etc/sudoers | grep $group);
  command_exist=$(which ${command[$i]});

#CRÉATION DES STRINGS DE CONFIGURATION
  if [[ $command_exist != "" ]];then
    if [[ ${execution[$i]} == "yes" ]];then
      #SI L'ÉXÉCUTION EST POSSIBLE ON PEUT ENLEVER LE MOT DE PASSE
      if [[ ${password[$i]} == "yes" ]];then
        string[$i]="$command_exist";
      else
        string[$i]="NOPASSWD:$command_exist";
      fi
    else
      string[$i]="!$command_exist";
    fi
  else
    echo "La commande n'existe pas.";
  fi
  echo ${string[$i]};
done

#CONCATÉNATION DES STRINGS
for (( i=0 ; i<4 ; i++ ));do
  if [ $i -eq 0 ];then
    final_string="ALL,"${string[$i]}
  else
    final_string=$final_string","${string[$i]}
  fi
done

#FORMATION DE LA LIGNE A AJOUTER DANS LE SUDOERS ET AJOUT
final="%$group  ALL=(ALL:ALL) $final_string";
echo $final >> /etc/sudoers
