<main role="main"><center>
  <div class="container"><br>
  <h3><strong>Gestion du serveur DNS</strong></h3>
    <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boîte a outils</a>
    <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a>
  </div>
  <section class="jumbotron ">
    <div class="ml-2">
<?php
#-------------------------------------------------------------------------------
# GENERATION DU SCRIPT DNS
#-------------------------------------------------------------------------------

#GÉNÉRATION DES VARIABLE DE FICHIERS--------------------------------------------
$file_path="../script/script_client/server_dns_".session_id().".sh";
$file_name="server_dns.sh";
#VÉRIFICATION DE L'OPTION D'AUTO-DESTRUCTION------------------------------------
if (isset( $_GET["auto_destruction"] )){ $rm = "rm ".$file_name; } else { $rm = ""; }
#AJOUT DU LIEN DE TÉLÉCHARGEMENT & GUIDE----------------------------------------
echo "<center><a class='btn btn-dark' href='".$file_path."'download='".$file_name."' target='_blank'>Télécharger le script </a></center><br>";
include("../view/guide_execution.php");

#-------------------------------------------------------------------------------
# GÉNÉRATION DU SCRIPT
#-------------------------------------------------------------------------------
  if(isset($_GET['action']) && isset($_GET['under_action'])){
    if(isset($_GET['master']) && isset($_GET['domain'])){
      $nb = count($username);
      $master="master=".$_GET['master']."\n";
      $domain="domain=".$_GET['domain'].".\n";
      #CONCATENATION DE TABLEAUX BASH---------------------------------------------
      for( $i=0 ;$i<$nb ;$i++){
        if ($i === 0 ){
          $hostname = "user[$i]=".$_GET['username'][$i]."\n";
          $type_name= "type_name[$i]=".$_GET['type_name'][$i]."\n";
          $private_ip = "private_ip[$i]=".$_GET['private_ip'][$i]."\n";
        } else {
          $hostname = $hostname."user[$i]=".$_GET['username'][$i]."\n";
          $type_name= $type_name."type_name[$i]=".$_GET['type_name'][$i]."\n";
          $private_ip = $private_ip."private_ip[$i]=".$_GET['private_ip'][$i]."\n";
      }
    }
      #CRÉATION DE VARIABLES IMPORTANTES POUR ISOLER PHP & BASH-----------------

      #GÉNÉRATION DU SCRIPT-----------------------------------------------------
      $firstline = "
      #!/bin/bash
      #-------------------------------------------------------------------------
      #SCRIPT D'INSTALATION D'UN SERVEUR DNS
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
      statut=\$(\'whoami\')

      # Variables à changer en fonction des besoins et de la machine
      hostname=\`hostname\`
      ip=\"192.168.70.134\"
      domain=\$domain
      num_columns=12
      test_resolution=(\"\" \"NS\" \"\$domain\" \"ns1\" \"A\" \"192.168.70.134\" \"mail\" \"A\" \"192.168.70.134\" \"@\" \"MX\" \"10 mail\")
      test_reverse=(\"\" \"NS\" \"\$domain\" \"192.168.70.134\" \"PTR\" \"\$domain\")

      # Réglage du DNS en Master
      option=\"master\"
      # Récupère la date de création pour générer le fichier Bind
      date_creation=\`date +%Y%d\`


      # Vérification du statut de l\'utilisateur qui lance le script
      if [ \$statut != root ]
      then
      	echo \"\"
      	echo \"Vous n\'avez pas les droits n\'écéssaires, contactez votre administrateur ..\"
      	echo \"\"
      	sleep 1
      	exit

      elif [ \$statut = root ]
      then

      # Mise à jour

      apt-get -y update
      apt-get -y upgrade

      # Installation des paquets nécéssaires

      apt-get -y install bind9
      apt-get -y install dnsutils

      echo \"\"
      echo \"---------- Fin de l\'installation ----------\"
      echo \"\"
      sleep 2
      echo \"---------- Début de la configuration ---------\"
      sleep 2

      # Mise en place des variables de configuration
      exist=\"\$(grep search /etc/resolv.conf)\"
      ipexist=\"\$(grep \$ip /etc/resolv.conf)\"
      reverse=\"\$(echo \$ip | awk -F. \'{print \$3\".\"\$2\".\"\$1}\')\"
      zonexist=\"\$(grep \$domain /etc/bind/named.conf.local)\"
      reversexist=\"\$(grep \$reverse /etc/bind/named.conf.local)\"
      conf_exist=\"\$(grep \"listen-on { any; };\" /etc/bind/named.conf.options)\"


      # Ajout du FQDN dans le fichier hostname
      \`sudo hostnamectl set-hostname \$hostname.\$domain\`
      # Modification du fichier hosts
      sed -i -r \"2s/.*/\$ip	\$hostname.\$domain/g\" /etc/hosts

      # Modifications du fichier resolv.conf
      sed -i -r \"s/search.*/search \$domain/g\" /etc/resolv.conf

      # Je vérifie si la section domain exite, sinon je l\'ajoute
      if [ ! -z \"\$exist\" ]
      then
      	sed -i -r \"s/domain.*/domain \$domain/g\" /etc/resolv.conf
      else
      	sed -i -r \"/search.*/a \domain \$domain\" /etc/resolv.conf
      fi

      # Je vérifie que le nameserver n\'ai pas déjà été rentré
      if [ -z \"\$ipexist\" ]
      then
      	sed -i -r \"/search.*/a \nameserver \$ip\" /etc/resolv.conf
      else
      	: ne fais rien
      fi
      # Je vérifier que les zones n\'aient pas déjà été créers
      if [ -z \"\$zonexist\" ]
      then
      echo \"
      zone \"\$domain\" {
      	type \$option;
      	file \"/etc/bind/db.\$domain\ \";
      };\" >>/etc/bind/named.conf.local
      else
      	: ne fais rien
      fi
      # Je fais la même vérification pour la zone reverse
      if [ -z \"\$reversexist\" ]
      then
      echo \"
zone \"\$reverse.in-addr.arpa\" {
type \$option;
file \"/etc/bind/db.\$reverse.in-addr.arpa \";
};\" >>/etc/bind/named.conf.local
      else
      	: ne fais rien
      fi

      # Vérification de la configuration du fichier named.conf.options

      #PROBLÈME DE TABULATION---------------------------------------------------
      if [ -z \"\$conf_exist\" ]
      then
      	sed -i \'25d\' /etc/bind/named.conf.options
      	echo -e \"	listen-on { any; };\n};\" >> /etc/bind/named.conf.options
      else
      	: ne fais rien
      fi

      # Création des fichiers des enregistrements
      touch /etc/bind/db.\$domain
      touch /etc/bind/db.\$reverse.in-addr.arpa

      #CONTENUS DU FICHIER D'ENREGISTREMENTS------------------------------------

      echo \"
\$TTL 86400
@	IN	SOA	\$domain. root.\$domain. (
				\$date_creation
				21600
				3600
				64800
				86400 )
      \" >>/etc/bind/db.\$domain

      #BOUCLE QUI PERMET L'AJOUT D'ENREGISTREMENTS------------------------------
      for (( i=0; i<\$num_columns; i+=3 ))
      do
      	echo -e \"\${test_resolution[\$i]}		IN		\${test_resolution[\$i+1]}		\${test_resolution[\$i+2]} \">>/etc/bind/db.\$domain
      done

      #LA PARTIE DES ENREGISTREMENTS EN REVERSE---------------------------------
      echo \"
      \$TTL 86400
@	IN	SOA	\$domain. root.\$domain. (
				\$date_creation
				21600
				3600
				64800
				86400 )
  \" >>/etc/bind/db.\$reverse.in-addr.arpa

  #BOUCLE D'ENREGISTREMENT DE ZONE REVERSE--------------------------------------
  for (( i=0; i<\$num_columns; i+=3 ))
  do
  	cuted_ip=\"\$(echo \"\${test_reverse[\$i]}\" | awk -F. \'{print \$4}\')\"
  	echo -e \"\$cuted_ip		IN		\${test_reverse[\$i+1]}		\${test_reverse[\$i+2]}\" >>/etc/bind/db.\$reverse.in-addr.arpa
  done

  # REDÉMARAGE DES SERVICES-----------------------------------------------------
  \`sudo service bind9 restart\`
  \`sudo service networking restart\`
  echo \"\"
  echo \"---------- Fin de la configuration ----------\"
  sleep 2
fi



      ";

      #RASSEMBLEMENT DES VARIABLES & CREATION DU SCRIPT-------------------------
      $new_script = $firstline  . $master . $hostname . $type_name . $private_ip . $domain. $username . $password . $script . $rm;
      $file = fopen($file_path, 'w+');
      fputs($file,$new_script);

    }
  }
?>

</section>
</main>
