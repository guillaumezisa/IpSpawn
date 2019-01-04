#!/bin/bash
#---------------------------------------------------------------------------
#SCRIPT MISE EN PLACE D'UNE IP FIXE généré par IpSpawn.com
#V.1.1
#Le : 2018/12/06
#Script par Guillaume Zisa : zisa@intechinfo.fr
#---------------------------------------------------------------------------

#ROOT OBLIGATOIRE POUR L'EXECUTION----------------------------------------------
if [ $(whoami) == "root" ];then
  apt install net-tools -y
	apt install resolvconf -y

  #CRÉATION DES VARIABLES IMPORTANTES-------------------------------------------
  card=$(ip route |grep default | awk '{print $5}');
  ip=192.168.245.150;
  broadcast=$(ip a | grep $card| grep inet | awk '{print $4}');
  gateway=$(ip route | grep default | awk '{print $3}');
  old_ip=$(ip route | grep $card | grep src | awk '{print $9}');
  mask=$(ifconfig | grep $old_ip | awk '{print $4}');
  dns=$(cat /etc/resolv.conf | grep name | awk '{print $2}' | sed -n '1p');

  #INSERTION DE LA NOUVELLE INTERFACE STATIC------------------------------------
  echo "source /etc/network/interface.d/*" > /etc/network/interfaces
  echo "" >> /etc/network/interfaces
  echo "#LOCALHOST" >> /etc/network/interfaces
  echo "" >> /etc/network/interfaces
  echo "auto lo " >> /etc/network/interfaces
  echo "iface lo inet loopback" >> /etc/network/interfaces
  echo "" >> /etc/network/interfaces
  echo "#STATIC" >> /etc/network/interfaces
  echo "auto $card" >> /etc/network/interfaces
  echo "iface $card inet static" >> /etc/network/interfaces
  echo "address $ip " >> /etc/network/interfaces
  echo "netmask $mask " >> /etc/network/interfaces
  echo "gateway $gateway " >> /etc/network/interfaces
  echo "" >> /etc/network/interfaces
  echo "dns-nameservers $dns " >> /etc/network/interfaces
  echo "dns-nameservers 8.8.8.8 " >> /etc/network/interfaces
  service networking restart
else
  echo Vous devez être root pour executer ce script
fi 