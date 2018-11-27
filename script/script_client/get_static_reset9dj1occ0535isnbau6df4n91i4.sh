
    #!/bin/bash
    #---------------------------------------------------------------------------
    #SCRIPT DE MISE EN PLACE D'IP DHCP généré par IpSpawn.com
    #---------------------------------------------------------------------------

    echo "source /etc/network/interface.d/*" > /etc/network/interfaces
    echo "" >> /etc/network/interfaces
    echo "#LOCALHOST" >> /etc/network/interfaces
    echo "" >> /etc/network/interfaces
    echo "auto lo " >> /etc/network/interfaces
    echo "iface lo inet loopback" >> /etc/network/interfaces
    echo "" >> /etc/network/interfaces