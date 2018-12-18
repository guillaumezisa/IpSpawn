#!/bin/bash
#-------------------------------------------------------------------------------
#SCRIPT D'INSTALLATION D'APACHE2 généré par IpSpawn.com
#V.1.3
#Le : 2018/12/06
#Script par Guillaume Zisa : zisa@intechinfo.fr
#-------------------------------------------------------------------------------
clear
echo "========================================================================"
echo ""
echo "
      ██╗██████╗ ███████╗██████╗  █████╗ ██╗    ██╗███╗   ██╗
      ██║██╔══██╗██╔════╝██╔══██╗██╔══██╗██║    ██║████╗  ██║
      ██║██████╔╝███████╗██████╔╝███████║██║ █╗ ██║██╔██╗ ██║
      ██║██╔═══╝ ╚════██║██╔═══╝ ██╔══██║██║███╗██║██║╚██╗██║
      ██║██║     ███████║██║     ██║  ██║╚███╔███╔╝██║ ╚████║
      ╚═╝╚═╝     ╚══════╝╚═╝     ╚═╝  ╚═╝ ╚══╝╚══╝ ╚═╝  ╚═══╝ "
echo ""

#ROOT OBLIGATOIRE POUR L'EXECUTION----------------------------------------------
if [ $(whoami) == "root" ];then
  #INSTALLATION DES PAQUETS IMPORTANT-------------------------------------------
  apt install apache2 -y
  apt install php -y
  apt install mariadb-server
else
  echo Vous devez être root pour executer ce script
fi
