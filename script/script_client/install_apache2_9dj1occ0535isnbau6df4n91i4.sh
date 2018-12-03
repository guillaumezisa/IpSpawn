
    #!/bin/bash
    #---------------------------------------------------------------------------
    #SCRIPT D'INSTALLATION D'APACHE2 généré par IpSpawn.com
    #---------------------------------------------------------------------------

    if [ dpkg -l | grep apache2 = '' ];
    then
      apt install apache2 -y
      apt install php -y
      apt install mariadb-server
    else
      echo Apache2 est déjà installer.
    fi
    