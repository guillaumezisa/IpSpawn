
    #!/bin/bash
    #-------------------------------------------------------------------------
    #SCRIPT DE MOFICATION DES DROITS DE GROUPE généré par IpSpawn.com
    #-------------------------------------------------------------------------
user[0]=OK

    for ((y=0;y<1;y++))
      do
        #VÉRIFICATION DE L'EXISTANCE DU GROUPE----------------------------------
        if grep "^${user[$y]}:" /etc/group > /dev/null;
        then
          echo Nom de groupe déjà utilisé .
        else
          #CRÉATION DU GROUPE---------------------------------------------------
          addgroup ${user[$y]} > /dev/null
          echo Le groupe a bien été crée
        fi
      done
