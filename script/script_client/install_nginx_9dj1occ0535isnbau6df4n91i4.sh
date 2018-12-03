
    #!/bin/bash
    #---------------------------------------------------------------------------
    #SCRIPT D'INSTALLATION D'NGINX généré par IpSpawn.com
    #---------------------------------------------------------------------------

    if [ "dpkg -l | grep nginx" = '' ];
    then
    apt install nginx -y
    apt install php-fpm -y
    apt install php -y
    apt install mariadb-server -y

    sed -i -r 's/.*index index.html index.htm index.nginx-debian.html;*/index index.html index.htm index.php index.nginx-debian.html;/g' /etc/nginx/sites-available/default
    sed -i -r 's/.*#location ~ \.php$ {*/location ~ \.php$ {/g' /etc/nginx/sites-available/default
    sed -i -r 's/.*#include snippets/fastcgi-php.conf;*/include snippets/fastcgi-php.conf;/g' /etc/nginx/sites-available/default
    sed -i -r 's/.*#fastcgi_pass unix:/var/run/php/php7.0-fpm.sock;*/fastcgi_pass unix:/var/run/php/php7.0-fpm.sock;}/g' /etc/nginx/sites-available/default
    else
      echo Nginx est déjà installer.
    fi
    