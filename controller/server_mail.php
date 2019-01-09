<main role="main"><center>
  <div class="container"><br>
  <h3><strong>Gestion du serveur mail</strong></h3>
    <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boite à outils</a>
    <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a>
  </div>
  <section class="jumbotron ">
    <div class="ml-2">
<?php
#-------------------------------------------------------------------------------
# GENERATION DU SCRIPT MAIL
#-------------------------------------------------------------------------------

#GÉNÉRATION DES VARIABLES DE FICHIERS--------------------------------------------
$file_path="../script/server_mail/server_mail".session_id().".sh";
$file_name="server_mail.sh";
#VÉRIFICATION DE L'OPTION D'AUTO-DESTRUCTION------------------------------------
if (isset( $_GET["auto_destruction"] )){ $rm = "rm ".$file_name; } else { $rm = ""; }
#AJOUT DU LIEN DE TÉLÉCHARGEMENT & GUIDE----------------------------------------
echo "<center><a class='btn btn-dark' href='".$file_path."'download='".$file_name."' target='_blank'>Télécharger le script </a></center><br>";
include("../view/guide_execution.php");

#-------------------------------------------------------------------------------
# GÉNÉRATION DU SCRIPT
#-------------------------------------------------------------------------------
  if(isset($_GET['action']) && isset($_GET['under_action'])){
    if(isset($_GET['username']) && isset($_GET['psswrd'])){
      $nb = count($_GET['username']);

      #CONCATENATION DE TABLEAUX BASH---------------------------------------------
      for( $i=0 ;$i<$nb ;$i++){
        if ($i === 0 ){
          $username = $_GET['username'][$i];
          $psswrd = $_GET['psswrd'][$i];
          #$username = "username[$i]=".$_GET['username'][$i]."\n";
          #$psswrd = "psswrd[$i]=".$_GET['psswrd'][$i]."\n";
        } else {
          $username=$username." ".$_GET['username'][$i];
          $psswrd=$psswrd." ".$_GET['psswrd'][$i];
          #$username=$username."username[$i]=".$_GET['username'][$i]."\n";
          #$psswrd=$psswrd."psswrd[$i]=".$_GET['psswrd'][$i]."\n";
        }
      }
    $username="username=(".$username.")\n";
    $psswrd="psswrd=(".$psswrd.")\n";
      #CRÉATION DE VARIABLES IMPORTANTES POUR ISOLER PHP & BASH-----------------
      $statut = '${statut}';
      $verify_sql = '${verify_sql}';

      $hostname = $_GET['hostname'];
      $domain = $_GET['domain'];
      $name_admin = $_GET['name_admin'];
      $passwrd_admin = $_GET['passwrd_admin'];

      $user ='${username[$y]}';
      $password ='${psswrd[$y]}';
      $tmp ='$tmp';

    echo $username;

      #GÉNÉRATION DU SCRIPT-----------------------------------------------------
      $firstline = "
      #!/bin/bash
      #-------------------------------------------------------------------------
      #SCRIPT D'INSTALATION D'UN SERVEUR MAIL
      #V.1.4
      #Le : 2018/12/06
      #Script par Joran Prigent: prigent@intechinfo.fr
      #Script par Robin Cuvillier : rcuvillier@intechinfo.fr
      #-------------------------------------------------------------------------
      clear
      echo \"========================================================================\"
      echo \"\"
      echo \"
            ██╗██████╗ ███████╗██████╗  █████╗ ██╗    ██╗███╗   ██╗
            ██║██╔══██╗██╔════╝██╔══██╗██╔══██╗██║    ██║████╗  ██║
            ██║██████╔╝███████╗██████╔╝███████║██║ █╗ ██║██╔██╗ ██║
            ██║██╔═══╝ ╚════██║██╔═══╝ ██╔══██║██║███╗██║██║╚██╗██║
            ██║██║     ███████║██║     ██║  ██║╚███╔███╔╝██║ ╚████║
            ╚═╝╚═╝     ╚══════╝╚═╝     ╚═╝  ╚═╝ ╚══╝╚══╝ ╚═╝  ╚═══╝ \"
      echo \"\"\n";

      $script="
function verify() {
  if [ $? -eq 0 ]
  then
    echo 'Success'
  else
    echo 'Error, script exit'
    exit
  fi
}

function begin() {
  statut=$('whoami')
  # Vérification des droits de l'exécuteur du script
  if [ ".$statut." != root ]
  then
    echo \"Vous n'avez pas les droits nécéssaires, contactez votre administrateur ...\"
    sleep 1
  exit

  elif [ ".$statut." = root ]
  then
    apt-get -y update
    apt-get -y upgrade
  fi
}

begin

if [ ".$statut." = root ]
then
  # Lancement de l'installation des différents paquets
  debconf-set-selections <<< 'postfix postfix/mailname string ".$hostname.".".$domain."'
  verify
  debconf-set-selections <<< \"postfix postfix/main_mailer_type string 'Internet Site'\"
  verify
  apt-get install -y postfix
  verify
  apt-get install -y dovecot-core dovecot-imapd dovecot-mysql
  verify
  apt-get install -y mariadb-server
  verify
  apt-get install -y postfix-mysql
  verify
  apt-get install -y telnet
  verify
  apt-get install -y mailutils
  verify

  echo \"---------- Fin de l'installation ---------\"
  sleep 1
  # Début de configuration de POSTFIX
  # Installation d'une base de donnée MYSQL pour gérer les utilisateurs
  echo '---------- Début configuration MYSQL ----------'

  # Création du nouvel utilisateur et attribution des droits
  sudo mysql -u root  -e \"CREATE USER '".$name_admin."' IDENTIFIED BY '".$passwrd_admin."';\"
  sudo mysql -u root  -e \"GRANT ALL PRIVILEGES ON messagerie.* to '".$name_admin."'@'localhost' IDENTIFIED BY '".$passwrd_admin."';\"

  # On vérifie si la base de donnée n'existe pas déjà
  verify_sql=$(sudo mysql -u root -e 'SHOW DATABASES' | grep messagerie)

  if [ \"".$verify_sql."\" == 'messagerie' ]
  then
    echo 'Erreur : Vous avez déjà une base de donnée nommée messagerie'
  elif [ \"".$verify_sql."\" != 'messagerie' ]
  then
    # Création de la base de donnée à exploiter
    sudo mysql -u root << EOF
    CREATE DATABASE messagerie;
    EOF

    # Création des différentes tables
    sudo mysql -u root messagerie << EOF
    CREATE TABLE domains (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    PRIMARY KEY (id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    EOF

    sudo mysql -u root messagerie << EOF
    CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT,
    domain_id INT NOT NULL,
    password VARCHAR(106) NOT NULL,
    email VARCHAR(120) NOT NULL,
    maildir VARCHAR(150) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY email  (email),
    FOREIGN KEY (domain_id) REFERENCES domains(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    EOF
  fi

  # Récupération des informations des nouveaux utilisateurs du service de messagerie
  sudo mysql -u root messagerie << EOF
  INSERT INTO domains VALUES ('', '".$domain."');
  EOF

  touch /etc/postfix/generic

  for ((y=0;y<".$nb.";y++))
  do
    #VÉRIFIE L'EXISTENCE D'UTILISATEURS
    sudo mysql -u root 'messagerie' -e \"SELECT email FROM users\" >> tmp.txt
    tmp=$(cat tmp.txt | grep ".$user.")
    if [ \"".$tmp."\" != \"\" ];
    then
      echo \"L'utilisateur existe déjà\"
    else
      #AJOUT DES UTILISATEURS NON-EXISTANT
      sudo mysql -u root messagerie -e \"INSERT INTO users VALUES ('', 1, PASSWORD('".$password."'), '".$user."@".$domain."', '".$domain."/".$user."');\"
      echo -e \"".$user."@".$hostname.".".$domain."  ".$user."@".$domain."\\n\" >> /etc/postfix/generic
      echo \"L'utilisateur ".$user." a bien été ajouté.\"
    fi
    rm tmp.txt
  done\n

  # Création des INSERT
  echo '---------- Fin de configuration MYSQL ----------'
  sleep 1
  echo '---------- Début de configuration arborescence --------'

  chmod 666 /etc/postfix/main.cf

  # Ajout des lignes dans main.cf

  echo -e '# Ajout configuration\nvirtual_mailbox_domains = mysql:/etc/postfix/mysql-virtual-mailbox-domains.cf\nvirtual_mailbox_base = /var/mail/vhosts\nvirtual_mailbox_maps = mysql:/etc/postfix/mysql-virtual-mailbox-domains.cf\nvirtual_minimum_uid = 100\nvirtual_uid_maps = static:5000\nvirtual_gid_maps = static:5000\n' >> /etc/postfix/main.cf

  touch /etc/postfix/mysql-virtual-mailbox-domains.cf
  echo -e \"user = ".$name_admin." \npassword = ".$passwrd_admin." \nhosts = 127.0.0.1 \ndbname = messagerie \nquery = SELECT 1 FROM domains WHERE name='%s'\" >> /etc/postfix/mysql-virtual-mailbox-domains.cf
  systemctl restart postfix
  postmap -q ".$domain." mysql:/etc/postfix/mysql-virtual-mailbox-domains.cf

  touch /etc/postfix/mysql-virtual-mailbox-maps.cf
  echo -e \"user = ".$name_admin." \npassword = ".$passwrd_admin." \nhosts = 127.0.0.1 \ndbname = messagerie \nquery = SELECT  maildir FROM users WHERE email='%s'\" >> /etc/postfix/mysql-virtual-mailbox-maps.cf
  systemctl restart postfix
  postmap -q ".$name_admin."@".$domain." mysql:/etc/postfix/mysql-virtual-mailbox-maps.cf

  echo 'smtp_generic_maps = hash:/etc/postfix/generic' >> /etc/postfix/main.cf
  postmap /etc/postfix/generic

  systemctl restart postfix
  for ((y=0;y<".$nb.";y++))
  do
    touch /var/mail/".$user."
    chmod 777 /var/mail/".$user."
  done

  #Demander le nom de la machine et remplir le fichier generic
  echo ---------- Installation Dovecot ----------

  sed -i -r '30s#mail_location = mbox:~/mail:INBOX=/var/mail/%u#mail_location = maildir:/var/mail/vhosts/%d/%n#g' /etc/dovecot/conf.d/10-mail.conf
  sed -i -r '114s/#mail_privileged_group =/mail_privileged_group = mail/g' /etc/dovecot/conf.d/10-mail.conf
  sed -i -r '10s/#disable_plaintext_auth = yes/disable_plaintext_auth = yes/g' /etc/dovecot/conf.d/10-auth.conf
  sed -i -r '122s/!include auth-system.conf.ext/#!include auth-system.conf.ext/g' /etc/dovecot/conf.d/10-auth.conf
  sed -i -r '123s/#!include auth-sql.conf.ext/!include auth-sql.conf.ext/g' /etc/dovecot/conf.d/10-auth.conf
  sed -i -r '20s/ driver = sql/ driver = static/g' /etc/dovecot/conf.d/auth-sql.conf.ext
  sed -i -r '21s# args = /etc/dovecot/dovecot-sql.conf.ext# args = uid=vhosts gid=vhosts home=/var/mail/vhosts/%d/%n#g' /etc/dovecot/conf.d/auth-sql.conf.ext
  sed -i -r '32s/#driver =/driver = sql/g' /etc/dovecot/dovecot-sql.conf.ext
  sed -i -r '71s/#connect =/connect = host=127.0.0.1 dbname=messagerie user=".$name_admin." password=".$passwrd_admin."/g' /etc/dovecot/dovecot-sql.conf.ext
  sed -i -r '78s/#default_pass_scheme = MD5/default_pass_scheme = SHA512-CRYPT/g' /etc/dovecot/dovecot-sql.conf.ext
  sed -i -r \"107s/password_query = \ /password_query = SELECT email as user, password FROM virtual_users WHERE email='%u'/g\"   /etc/dovecot/dovecot-sql.conf.ext

  systemctl restart dovecot
fi\n";

      #RASSEMBLEMENT DES VARIABLES & CREATION DU SCRIPT-------------------------
      $new_script = $firstline . $username . $psswrd . $script . $rm;
      $file = fopen($file_path, 'w+');
      fputs($file,$new_script);

    }
  }
?>

</section>
</main>
