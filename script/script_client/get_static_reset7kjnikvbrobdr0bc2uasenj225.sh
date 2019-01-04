
  #!/bin/bash
  #---------------------------------------------------------------------------
  #SCRIPT DE MISE EN PLACE D'IP DHCP généré par IpSpawn.com
    #V.1.1
    #Le : 2018/12/06
    #Script par Guillaume Zisa : zisa@intechinfo.fr
    #---------------------------------------------------------------------------

    #ROOT OBLIGATOIRE POUR L'EXECUTION------------------------------------------
    if [ $(whoami) == "root" ];then
      #RÉÉCRITURE DES PARAMETRES PAR DEFAULTS D'INTERFACES ( DHCP )-------------
      echo "source /etc/network/interface.d/*" > /etc/network/interfaces
      echo "" >> /etc/network/interfaces
      echo "#LOCALHOST" >> /etc/network/interfaces
      echo "" >> /etc/network/interfaces
      echo "auto lo " >> /etc/network/interfaces
      echo "iface lo inet loopback" >> /etc/network/interfaces
      echo "" >> /etc/network/interfaces
    else
      echo Vous devez être root pour executer ce script
    fi