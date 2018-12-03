<main role="main"><center>
  <div class="container"><br>
    <h3><strong>Installation d'un serveur web Nginx</strong></h3>
    <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boite a outils</a>
    <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a><br><br>
  </div>
  <section class="jumbotron ">
    <div class="ml-2">

<?php
#-------------------------------------------------------------------------------
# GENERATION DU SCRIPT D'INSTALLATION DE NGINX
#-------------------------------------------------------------------------------

#GÉNÉRATION DES VARIABLE DE FICHIERS--------------------------------------------
$file_path="../script/script_client/install_nginx_".session_id().".sh";
$file_name="install_nginx.sh";

#AJOUT DU LIEN DE TÉLÉCHARGEMENT & GUIDE----------------------------------------
include("../view/guide_execution_server_web_nginx.php");
echo "<center><a class='btn btn-danger' href='".$file_path."'download='".$file_name."' target='_blank'>Télécharger le script d'installation </a></center><br>";

#-------------------------------------------------------------------------------
# GÉNÉRATION DU SCRIPT
#-------------------------------------------------------------------------------
if(isset($_GET['action']) && isset($_GET['under_action'])){
    #CREATION DE VARIABLE D'ISOLEMENT
    $nginx='"dpkg -l | grep nginx"';
    #GÉNÉRATION DU SCRIPT-------------------------------------------------------
    $firstline = "
    #!/bin/bash
    #---------------------------------------------------------------------------
    #SCRIPT D'INSTALLATION D'NGINX généré par IpSpawn.com
    #---------------------------------------------------------------------------\n";

    $script="
    if [ ".$nginx." = '' ];
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
    ";

    #RASSEMBLEMENT DES VARIABLES & CREATION DU SCRIPT-------------------------
    $new_script = $firstline . $script ;
    $file = fopen($file_path, 'w+');
    fputs($file,$new_script);

  }
?>
    </div>
  </section>
</main>
