<main role="main"><center>
  <div class="container"><br>
    <h3><strong>Installation d'un serveur web Nginx</strong></h3>
    <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boite a outils</a>
    <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a><br><br>
  </div>
  <section class="jumbotron ">
    <div class="ml-2">

<?php
echo '#-------------------------------------------------------------------------------
echo '# GENERATION DU SCRIPT D'INSTALLATION DE NGINX
echo '#-------------------------------------------------------------------------------

echo '#GÉNÉRATION DES VARIABLE DE FICHIERS--------------------------------------------
$file_path="../script/script_client/install_nginx_".session_id().".sh";
$file_name="install_nginx.sh";

echo '#AJOUT DU LIEN DE TÉLÉCHARGEMENT & GUIDE----------------------------------------
include("../view/guide_execution_server_web_nginx.php");
echo "<center><a class='btn btn-danger' href='".$file_path."'download='".$file_name."' target='_blank'>Télécharger le script d'installation </a></center><br>";

echo '#-------------------------------------------------------------------------------
echo '# GÉNÉRATION DU SCRIPT
echo '#-------------------------------------------------------------------------------
if(isset($_GET['action']) && isset($_GET['under_action'])){
    echo '#CREATION DE VARIABLE D'ISOLEMENT
    $nginx='"dpkg -l | grep nginx"';
    echo '#GÉNÉRATION DU SCRIPT-------------------------------------------------------
    $firstline = "
    echo '#!/bin/bash
    echo '#---------------------------------------------------------------------------
    echo '#SCRIPT D'INSTALLATION D'NGINX généré par IpSpawn.com
    echo '#---------------------------------------------------------------------------";

    $script="

    apt install nginx -y
    apt install php-fpm -y
    apt install php -y
    apt install mariadb-server -y

echo '' > /etc/nginx/sites_available/default
echo '# You should look at the following URL\'s in order to grasp a solid understanding' >> /etc/nginx/sites_available/default
echo '# of Nginx configuration files in order to fully unleash the power of Nginx.' >> /etc/nginx/sites_available/default
echo '# http://wiki.nginx.org/Pitfalls' >> /etc/nginx/sites_available/default
echo '# http://wiki.nginx.org/QuickStart' >> /etc/nginx/sites_available/default
echo '# http://wiki.nginx.org/Configuration' >> /etc/nginx/sites_available/default
echo '#' >> /etc/nginx/sites_available/default
echo '# Generally, you will want to move this file somewhere, and start with a clean' >> /etc/nginx/sites_available/default
echo '# file but keep this around for reference. Or just disable in sites-enabled.' >> /etc/nginx/sites_available/default
echo '#' >> /etc/nginx/sites_available/default
echo '# Please see /usr/share/doc/nginx-doc/examples/ for more detailed examples.' >> /etc/nginx/sites_available/default
echo '' >> /etc/nginx/sites_available/default
echo '' >> /etc/nginx/sites_available/default
echo '# Default server configuration' >> /etc/nginx/sites_available/default
echo '#' >> /etc/nginx/sites_available/default
echo 'server {' >> /etc/nginx/sites_available/default
        echo 'listen 80 default_server;' >> /etc/nginx/sites_available/default
        echo 'listen [::]:80 default_server;' >> /etc/nginx/sites_available/default
echo '' >> /etc/nginx/sites_available/default
        echo '# SSL configuration' >> /etc/nginx/sites_available/default
        echo '#' >> /etc/nginx/sites_available/default
        echo '# listen 443 ssl default_server;' >> /etc/nginx/sites_available/default
        echo '# listen [::]:443 ssl default_server;' >> /etc/nginx/sites_available/default
        echo '#' >> /etc/nginx/sites_available/default
        echo '# Note: You should disable gzip for SSL traffic.' >> /etc/nginx/sites_available/default
        echo '# See: https://bugs.debian.org/773332' >> /etc/nginx/sites_available/default
        echo '#' >> /etc/nginx/sites_available/default
        echo '# Read up on ssl_ciphers to ensure a secure configuration.' >> /etc/nginx/sites_available/default
        echo '# See: https://bugs.debian.org/765782' >> /etc/nginx/sites_available/default
        echo '#' >> /etc/nginx/sites_available/default
        echo '# Self signed certs generated by the ssl-cert package' >> /etc/nginx/sites_available/default
        echo '# Don\'t use them in a production server!' >> /etc/nginx/sites_available/default
        echo '#' >> /etc/nginx/sites_available/default
        echo '# include snippets/snakeoil.conf;' >> /etc/nginx/sites_available/default
echo '' >> /etc/nginx/sites_available/default
        echo 'root /var/www/html;' >> /etc/nginx/sites_available/default
echo '' >> /etc/nginx/sites_available/default
        echo '# Add index.php to the list if you are using PHP' >> /etc/nginx/sites_available/default
        echo 'index index.php index.html index.htm index.nginx-debian.html;' >> /etc/nginx/sites_available/default
echo '' >> /etc/nginx/sites_available/default
        echo 'server_name _;' >> /etc/nginx/sites_available/default
echo '' >> /etc/nginx/sites_available/default
        echo 'location / {' >> /etc/nginx/sites_available/default
                echo '# First attempt to serve request as file, then' >> /etc/nginx/sites_available/default
                echo '# as directory, then fall back to displaying a 404.' >> /etc/nginx/sites_available/default
                echo 'try_files $uri $uri/ =404;' >> /etc/nginx/sites_available/default
	        echo '# proxy_pass http://localhost:8080;' >> /etc/nginx/sites_available/default
        	echo '# proxy_http_version 1.1;' >> /etc/nginx/sites_available/default
	        echo '# proxy_set_header Upgrade $http_upgrade;' >> /etc/nginx/sites_available/default
        	echo '# proxy_set_header Connection \'upgrade\';' >> /etc/nginx/sites_available/default
	        echo '# proxy_set_header Host $host;' >> /etc/nginx/sites_available/default
        	echo '# proxy_cache_bypass $http_upgrade;' >> /etc/nginx/sites_available/default
        echo '}' >> /etc/nginx/sites_available/default
echo '' >> /etc/nginx/sites_available/default
        echo '# pass the PHP scripts to FastCGI server listening on 127.0.0.1:9000' >> /etc/nginx/sites_available/default
        echo '#' >> /etc/nginx/sites_available/default
        echo'location ~ \.php$ {' >> /etc/nginx/sites_available/default
               echo'include snippets/fastcgi-php.conf;' >> /etc/nginx/sites_available/default
        echo '#' >> /etc/nginx/sites_available/default
        echo '#       echo '# With php7.0-cgi alone:' >> /etc/nginx/sites_available/default
        echo '#       fastcgi_pass 127.0.0.1:9000;' >> /etc/nginx/sites_available/default
        echo '#       echo '# With php7.0-fpm:' >> /etc/nginx/sites_available/default
               echo'fastcgi_pass unix:/run/php/php7.0-fpm.sock;' >> /etc/nginx/sites_available/default
        echo'} >> /etc/nginx/sites_available/default
echo '' >> /etc/nginx/sites_available/default
        echo '# deny access to .htaccess files, if Apache\'s document root' >> /etc/nginx/sites_available/default
        echo '# concurs with nginx\'s one' >> /etc/nginx/sites_available/default
        echo '#' >> /etc/nginx/sites_available/default
        echo '#location ~ /\.ht {' >> /etc/nginx/sites_available/default
        echo '#       deny all;' >> /etc/nginx/sites_available/default
        echo '#}' >> /etc/nginx/sites_available/default
echo '}' >> /etc/nginx/sites_available/default'
echo '' >> /etc/nginx/sites_available/default
echo '' >> /etc/nginx/sites_available/default
echo '# Virtual Host configuration for example.com' >> /etc/nginx/sites_available/default
echo '#' >> /etc/nginx/sites_available/default
echo '# You can move that to a different file under sites-available/ and symlink that' >> /etc/nginx/sites_available/default
echo '# to sites-enabled/ to enable it.' >> /etc/nginx/sites_available/default
echo '#' >> /etc/nginx/sites_available/default
echo '#server {' >> /etc/nginx/sites_available/default
echo '#       listen 80;' >> /etc/nginx/sites_available/default
echo '#       listen [::]:80;' >> /etc/nginx/sites_available/default
echo '#' >> /etc/nginx/sites_available/default
echo '#       server_name example.com;' >> /etc/nginx/sites_available/default
echo '#' >> /etc/nginx/sites_available/default
echo '#       root /var/www/example.com;' >> /etc/nginx/sites_available/default
echo '#       index index.html;' >> /etc/nginx/sites_available/default
echo '#' >> /etc/nginx/sites_available/default
echo '#       location / {' >> /etc/nginx/sites_available/default
echo '#               try_files $uri $uri/ =404;' >> /etc/nginx/sites_available/default
echo '#       }' >> /etc/nginx/sites_available/default
echo '#}' > /etc/nginx/sites_available/default' >> /etc/nginx/sites_available/default
service nginx restart
    ";

    echo '#RASSEMBLEMENT DES VARIABLES & CREATION DU SCRIPT-------------------------
    $new_script = $firstline . $script ;
    $file = fopen($file_path, 'w+');
    fputs($file,$new_script);

  }
?>
    </div>
  </section>
</main>
