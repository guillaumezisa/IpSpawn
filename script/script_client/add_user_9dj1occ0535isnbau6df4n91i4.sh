#!/bin/bash

user[0]=didi
pass[0]=didi

        for ((y=0;y<1;y++))
        do
          id -u ${user[$y]}> /dev/null 2>&1
          if [ $? == 0 ];
          then
            echo Nom d\'utilisateur déjà utilisé .
          else
            useradd -m -d /home/${user[$y]} -s /bin/bash ${user[$y]}
            echo ${user[$y]}:${pass[$y]}| chpasswd
            groupdel -f  ${user[$y]}
          fi
        done
