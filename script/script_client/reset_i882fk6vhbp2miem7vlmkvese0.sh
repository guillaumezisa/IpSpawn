#!/bin/bash
#-------------------------------------------------------------------------------
#SCRIPT DE REINITIALISATION généré par IpSpawn.com
#V.1.2
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

#ROOT OBLIGATOIRE POUR L'EXECUTION------------------------------------------
if [ $(whoami) == "root" ];then
  #CLEARING THE SUDOER
  echo 'Defaults	env_reset' > /etc/sudoers
  echo 'Defaults	mail_badpass' >> /etc/sudoers
  echo 'Defaults	secure_path="/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin"' >> /etc/sudoers
  echo 'root	ALL=(ALL:ALL) ALL' >> /etc/sudoers
else
  echo Vous devez être root pour executer ce script
fi
