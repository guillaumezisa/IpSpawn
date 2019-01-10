<main role="main"><center>
  <div class="container"><br>
    <h3><strong>Gestion du serveur DNS</strong></h3>
    <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boîte à outils</a>
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
  if(isset($_GET['master_name']) && isset($_GET['domain_name'])  && isset($_GET['master_ip']) && isset($_GET['ttl'])){
    $nb = count($_GET['type_name']);
    $domain_name="domain_name=".$_GET['domain_name'].".\n";
    $master_name="master_name=".$_GET['master_name']."\n";
    $master_ip="master_ip=".$_GET["master_ip"]."\n";
    $num_columns="num_columns=".$nb."\n";
	$ttl="ttl=".$_GET['ttl']."\n";

    #CONCATENATION DE TABLEAUX BASH---------------------------------------------
    $count=0;
    $y=0;
    if(isset($_GET['hostname'])){
      for($i=0;$i<$nb;$i++){
        if($i === 0){
          if($_GET['type_name'][$i] === "NS"){
            $count;
            $zone = "\" \" \"".$_GET['type_name'][$i]."\" \"".$_GET['hostname'][$y]."\" ";
            $y=$y+1;
          }elseif($_GET['type_name'][$i] === "MX"){
            $count=$count+1;
            $zone = "\"".$_GET['hostname'][$y]."\" \"".$_GET['type_name'][$i]."\" \"".$_GET['hostname'][$y+1]."\" ";
            $y=$y+2;
          }elseif($_GET['type_name'][$i] === "A"){
            $count=$count+1;
            $zone = "\"".$_GET['hostname'][$y]."\" \"".$_GET['type_name'][$i]."\" \"".$_GET['hostname'][$y+1]."\" ";
            $y=$y+2;
          }elseif($_GET['type_name'][$i] === "CNAME"){
            $count=$count+1;
            $zone = "\"".$_GET['hostname'][$y]."\" \"".$_GET['type_name'][$i]."\" \"".$_GET['hostname'][$y+1]."\" ";
            $y=$y+2;
          }
        } else {
          if($_GET['type_name'][$i] === "NS"){
            $count=$count+1;
            $zone = $zone."\" \" \"".$_GET['type_name'][$i]."\" \"".$_GET['hostname'][$y]."\" ";
            $y=$y+1;
          }elseif($_GET['type_name'][$i] === "MX"){
            $count=$count+2;
            $zone = $zone." \"".$_GET['hostname'][$y]."\" \"".$_GET['type_name'][$i]."\" \"".$_GET['hostname'][$y+1]."\" ";
            $y=$y+2;
          }elseif($_GET['type_name'][$i] === "A"){
            $count=$count+2;
            $zone = $zone." \"".$_GET['hostname'][$y]."\" \"".$_GET['type_name'][$i]."\" \"".$_GET['hostname'][$y+1]."\" ";
            $y=$y+2;
          }elseif($_GET['type_name'][$i] === "CNAME"){
            $count=$count+2;
            $zone = $zone." \"".$_GET['hostname'][$y]."\" \"".$_GET['type_name'][$i]."\" \"".$_GET['hostname'][$y+1]."\" ";
            $y=$y+2;
          }
        }
      }
      $zone ="test_resolution = (".$zone.")\n";
    } else {
      $zone = NULL;
    }
    
    echo $zone;

      /*for( $i=0 ;$i<$nb ;$i++){
      if ($i === 0 ){
        $zone = "\"".$_GET['hostname'][$i]."\" \"".$_GET['type_name'][$i]."\" \"".$_GET['private_ip'][$i]."\" ";
      } else {
        $zone = $zone." \"".$_GET['hostname'][$i]."\" \"".$_GET['type_name'][$i]."\" ".$_GET['private_ip'][$i];
      }
    }
    $zone ="test_resolution = (".$zone.")\n";
  } else {
    $zone = NULL;
  }*/
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
██╗██████╗ ███████╗██████� █████╗ ██�   ██╗███�  ██�
██║██╔══██╗██╔════╝██╔══██╗██╔══██╗██║    ██║████╗  ██�
██║██████╔╝███████╗██████╔╝███████║██║ █╗ ██║██╔██�██�
██║██╔═══╝ ╚════██║██╔═══�██╔══██║██║███╗██║██║╚██╗██║
██║██║     ███████║██�    ██� ██║╚███╔███╔╝██║ ╚████║
╚═╝╚═╝     ╚══════╝╚═�    ╚═� ╚═�╚══╝╚══╝ ╚═� ╚═══�\"
echo \"\"\n";

$script="
#Réglage du DNS en Master
option=\"master\"

# Vérification du statut de l\'utilisateur qui lance le script
if [ \$statut != root ]
then
 	echo \"\"
 	echo \"Vous n\'avez pas les droits nécéssaires, contactez votre administrateur ..\"
 	echo \"\"
 	sleep 1
 	exit
elif [ \$statut = root ]
then
  # Mise � jour
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

  # Modification du fichier hosts
  sed -i -r \"2s/.*/\$ip	\$hostname/g\" /etc/hosts

  # Modifications du fichier resolv.conf
  sed -i -r \"s/search.*/search \$domain/g\" /etc/resolv.conf

  # Je vérifie si la section domain exite, sinon je l\'ajoute
  if [ ! -z \"\$exist\" ]
  then
    sed -i -r \"s/domain.*/domain \$domain/g\" /etc/resolv.conf
  else
    sed -i -r \"/search.*/a \domain \$domain\" /etc/resolv.conf
  fi

  # Je vérifie que le nameserver n\'ai pas déj� été rentré
  if [ -z \"\$ipexist\" ]
  then
    sed -i -r \"/search.*/a \\nameserver \$ip\" /etc/resolv.conf
  else
   	: ne fais rien
  fi
  # Je vérifie que les zones n\'aient pas déj� été créées
  if [ -z \"\$zonexist\" ]
  then
echo \"
zone \"\$domain\" {
type \$option;
file \"/etc/bind/db.\$domain\";
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
file \"/etc/bind/db.\$reverse.in-addr.arpa\";
};\" >>/etc/bind/named.conf.local
  else
    : ne fais rien
  fi

  # Vérification de la configuration du fichier named.conf.options
  # problème de tabulation
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

  # Contenu du fichier d\'enregistrement

   echo \"
     \$TTL 86400
     @	IN	SOA	\$domain. root.\$domain. (
     				\$ttl
     				21600
     				3600
     				64800
     				84600 )

     \" >>/etc/bind/db.\$domain

     # La partie des enregistrements en reverse
     echo \"
     \$TTL 86400
     @	IN	SOA	\$domain. root.\$domain. (
     				\$ttl
     				21600
     				3600
     				64800
     				84600 )

     \" >>/etc/bind/db.\$reverse.in-addr.arpa

     # Boucle qui permet de rajouter les enregistrements

     for (( i=0; i<\$num_columns; i+=3 ))
     do
      cuted_ip=\"\$(echo \"\${test_resolution[\$i+2]}\" | awk -F. \'{print \$4}\')\"
     	value=\"\${test_resolution[\$i+1]}\"

     	if [ \"\$value\" == \"NS\" ]
     	then
     		echo -e \"@	IN	\${test_resolution[\$i+1]}	\${test_resolution[\$i+2]} \">>/etc/bind/db.\$domain
     		echo -e \"@	IN	\${test_resolution[\$i+1]}	\${test_resolution[\$i+2]} \">>/etc/bind/db.\$reverse.in-addr.arpa
     	elif [ \"\$value\" == \"MX\" ]
     	then
     		echo -e \"@	IN	\${test_resolution[\$i+1]}	\${test_resolution[\$i+2]} \">>/etc/bind/db.\$domain
     	elif [ \"\$value\" == \"CNAME\" ]
     	then
     		echo -e \"\${test_resolution[\$i]}	IN	CNAME	\${test_resolution[\$i+2]} \">>/etc/bind/db.\$domain
     	else
     		echo -e \"\${test_resolution[\$i]}		IN	\${test_resolution[\$i+1]}	\${test_resolution[\$i+2]} \">>/etc/bind/db.\$domain
     		echo -e \"\$cuted_ip	IN	PTR	\${test_resolution[\$i+2]} \">>/etc/bind/db.\$reverse.in-addr.arpa
     	fi
     done
     # Redémarage des services
     `sudo service bind9 restart`
     `sudo service networking restart`
     echo \"\"
     echo \"---------- Fin de la configuration ----------\\\"
     sleep 2
      ";

      #RASSEMBLEMENT DES VARIABLES & CREATION DU SCRIPT-------------------------
      $new_script = $firstline  . $domain_name . $master_name . $master_ip . $num_columns . $zone . $script . $rm;
      $file = fopen($file_path, 'w+');
      fputs($file,$new_script);

    }
  }
?>

</section>
</main>
