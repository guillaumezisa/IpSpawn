
      #!/bin/bash
      #-------------------------------------------------------------------------
      #SCRIPT D'AJOUT D'UTILISATEURS généré par IpSpawn.com
      #V.1.3
      #Le : 2018/12/06
      #Script par Guillaume Zisa : zisa@intechinfo.fr
      #-------------------------------------------------------------------------
user[0]=didi
group[0]=didi

      #ROOT OBLIGATOIRE POUR L'EXECUTION------------------------------------------
      if [ $(whoami) == "root" ];then
        for ((y=0;y<1;y++))
        do
          #VÉRIFIE L'EXISTANCE DES L'UTILISATEURS-------------------------------
          id -u ${user[$y]}> /dev/null 2>&1
          if [ $? == 0 ];
          then
            #AJOUT DES UTILISATEURS NON-EXISTANT--------------------------------
            usermod -G ${group[$y]} ${user[$y]} > /dev/null
            echo "L'utilisateur a bien été ajouté."
          fi
        done
      else
        echo Vous devez être root pour executer ce script
      fi