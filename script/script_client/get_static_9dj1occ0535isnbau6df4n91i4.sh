
    #!/bin/bash
    #---------------------------------------------------------------------------
    #SCRIPT MISE EN PLACE D'UNE IP FIXE généré par IpSpawn.com
    #---------------------------------------------------------------------------

    #VERIFICATION DE L'EXISTANCE DES PAQUETS---------------------------------
    if [ "dpkg -l | grep net-tools" = "" ];
    then
	   apt install net-tools -y
    fi
    if [ "dpkg -l | grep resolvconf" = "" ];
    then
	   apt install resolvconf -y
    fi

    #CRÉATION DES VARIABLES IMPORTANTES--------------------------------------
    card=$(ip route |grep default | awk '{print $5}');
    ip=ok;
    broadcast=$(ip a | grep $card| grep inet | awk '{print $4}');
    gateway=$(ip route | grep default | awk '{print $3}');
    mask=$(ifconfig | grep $ip | awk '{print $4}');
    dns=$(cat /etc/resolv.conf | grep name | awk '{print $2}' | sed -n '1p')

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
    echo "dns-nameservers dns " >> /etc/network/interfaces
    service networking restart
    
