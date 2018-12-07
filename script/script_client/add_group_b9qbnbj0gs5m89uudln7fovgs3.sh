
    #!/bin/bash
    #-------------------------------------------------------------------------
    #SCRIPT DE MOFICATION DES DROITS DE GROUPE généré par IpSpawn.com
    #V.1.4
    #Le : 2018/12/06
    #Script par Guillaume Zisa : zisa@intechinfo.fr
    #-------------------------------------------------------------------------
user[0]=dada

    #ROOT OBLIGATOIRE POUR L'EXECUTION------------------------------------------
    if [ $(whoami) == "root" ];then
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

    else
      echo Vous devez être root pour executer ce script
    fi