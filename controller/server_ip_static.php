<main role="main"><center>
  <div class="container"><br>
    <h3><strong>Mettre l'ip d'une machine en statique</strong></h3>
    <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boîte à outils</a>
    <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a><br><br>
  </div>
  <section class="jumbotron ">
    <div class="ml-2">

<?php
#-------------------------------------------------------------------------------
# GENERATION DU SCRIPT D'IP STATIC
#-------------------------------------------------------------------------------

#GÉNÉRATION DES VARIABLES DE FICHIERS--------------------------------------------
$file_path="../script/script_client/get_static_".session_id().".sh";
$file_name="get_static.sh";
#GÉNÉRATION DES VARIABLE DE FICHIERS----------------------------------------
$file_path_reset="../script/script_client/get_static_reset".session_id().".sh";
$file_name_reset="get_static_reset.sh";

#VÉRIFICATION DE L'OPTION D'AUTO-DESTRUCTION------------------------------------
if (isset( $_GET["auto_destruction"] )){ $rm = "rm ".$file_name; } else { $rm = ""; }
#AJOUT DU LIEN DE TÉLÉCHARGEMENT & GUIDE----------------------------------------
include("../view/guide_execution_ip_static.php");
echo "<center><a class='btn btn-danger' href='".$file_path_reset."'download='".$file_name_reset."' target='_blank'>Télécharger le script de réinitialisation </a></center><br>";
echo "<center><a class='btn btn-dark' href='".$file_path."'download='".$file_name."' target='_blank'>Télécharger le script du fixage d'ip</a></center>";

#-------------------------------------------------------------------------------
# GÉNÉRATION DU SCRIPT
#-------------------------------------------------------------------------------
if(isset($_GET['action']) && isset($_GET['under_action'])){
  if(isset($_GET['ip'])){
    $nb = count($_GET['ip']);

    #GÉNÉRATION DU SCRIPT-------------------------------------------------------
    $firstline = "#!/bin/bash
#SCRIPT MISE EN PLACE D'UNE IP FIXE généré par IpSpawn.com
#V.2.0
#Le : 2018/12/06
#Script par Guillaume Zisa : zisa@intechinfo.fr
#-------------------------------------------------------------------------------
clear
echo \"========================================================================\"
echo \"\"
echo \"
        ██ ██████  ██████ ██████  ██████  ██    ██ ██     ██
        ██ ██   ██ ██     ██   ██ ██   ██ ██    ██ ████   ██
        ██ ██████  ██████ ██████  ███████ ██    ██ ██ ██  ██
        ██ ██          ██ ██      ██   ██ ██ ██ ██ ██  ██ ██
        ██ ██      ██████ ██      ██   ██  ██  ██  ██   ████
\"
echo \"\"
echo \"========================================================================\"
echo \"\"
\n";
    $script="
if [ \$(whoami) == \"root\" ];then
  echo \"========================================================================\";
  echo \"  INSTALLATION DE RESOLVCONF \";
  echo \"========================================================================\";
  apt install resolvconf -y >/dev/null
  echo \"========================================================================\";
  echo \"  GÉNÉRATION DES VARIABLES DE DÉPART \";

  ip=".$_GET['ip']."
  card=\$(ip route | grep default | awk '{ print \$5}');
  broadcast=\$(ip a | grep \$card| grep inet | awk '{print \$4}');
  gateway=\$(ip route | grep default | awk '{print \$3}');
  dns=\$(cat /etc/resolv.conf | grep name | awk '{print \$2}' | sed -n '1p');
  old_ip=\$(ip a | grep \$card | grep inet | awk '{ print \$2}' | cut -d '/' -f1);
  old_ip_full=\$(ip a | grep \$card | grep inet | awk '{ print \$2}');

  echo \"========================================================================\";
  echo \"  TRANSFORMATION D'UN MASK CIDR EN UN MASQUE COMPLET \";
  full_mask=\$(ip a| grep \$card | grep inet | awk '{print \$2}');
  ip address del \$old_ip_full dev \$card

  mask=\${full_mask: -2};
  cidr=( 0 1 2 3 4 5 6 7 8 9 10 11 12 13 14 15 16 17 18 19 20 21 22 23 24 25 26 27 28 29 30 31 32 );
  format_mask=( 0.0.0.0 128.0.0.0 192.0.0.0 224.0.0.0 240.0.0.0 248.0.0.0 252.0.0.0 254.0.0.0 255.0.0.0 255.128.0.0 255.192.0.0 255.224.0.0 255.240.0.0 255.248.0.0 255.252.0.0 255.254.0.0 255.255.0.0 255.255.128.0 255.255.192.0 255.255.224.0 255.255.240.0 255.255.248.0 255.255.252.0 255.255.254.0 255.255.255.0 255.255.255.128 255.255.255.192 255.255.255.224 255.255.255.240 255.255.255.248 255.255.255.252 255.255.255.254 255.255.255.255);
  lenght=\${#cidr[*]};

  for (( i=0;i<\$lenght;i++));
  do
    if [ \$mask -eq \${cidr[\$i]} ];
    then
      final_mask=\${format_mask[\$i]};
    fi
  done;

  echo \"========================================================================\";
  echo \"  INSERTION DE LA NOUVELLE INTERFACE STATIC \";
  echo \"source /etc/network/interface.d/*\" > /etc/network/interfaces
  echo \"\" >> /etc/network/interfaces
  echo \"#LOCALHOST\" >> /etc/network/interfaces
  echo \"\" >> /etc/network/interfaces
  echo \"auto lo \" >> /etc/network/interfaces
  echo \"iface lo inet loopback\" >> /etc/network/interfaces
  echo \"\" >> /etc/network/interfaces
  echo \"#STATIC\" >> /etc/network/interfaces
  echo \"auto \$card\" >> /etc/network/interfaces
  echo \"iface \$card inet static\" >> /etc/network/interfaces
  echo \"address \$ip \" >> /etc/network/interfaces
  echo \"netmask \$mask \" >> /etc/network/interfaces
  echo \"gateway \$gateway \" >> /etc/network/interfaces
  echo \"\" >> /etc/network/interfaces
  echo \"dns-nameservers \$dns \" >> /etc/network/interfaces
  echo \"dns-nameservers 8.8.8.8 \" >> /etc/network/interfaces
  service networking restart

  echo \"========================================================================\"
  echo \"   NOUVELLE CONFIGURATION DE VOTRE INTERFACE RÉSEAU\"
  echo \"     Votre nouvelle adresse ip : \$ip\"
  echo \"     Le nom de votre carte réseau : \$card\"
  echo \"     Votre passerelle vers internet : \$gateway\"
  echo \"========================================================================\"
else
  echo Vous devez être root pour exécuter ce script
fi
";

  #RASSEMBLEMENT DES VARIABLES & CREATION DU SCRIPT-------------------------
  $new_script = $firstline . $script . $rm;
  $file = fopen($file_path, 'w+');
  fputs($file,$new_script);

  #CREATION D'UN SCRIPT DE RECUPERATION---------------------------------------
  $firstline_reset = "
#!/bin/bash
---------------------------------------------------------------------------
#SCRIPT DE MISE EN PLACE D'IP DHCP généré par IpSpawn.com
#V.1.1
#Le : 2018/12/06
#Script par Guillaume Zisa : zisa@intechinfo.fr
#---------------------------------------------------------------------------\n";
#GÉNÉRATION DU SCRIPT-------------------------------------------------------
  $script_reset="
#ROOT OBLIGATOIRE POUR L'EXECUTION------------------------------------------
if [ $(whoami) == \"root\" ];then
  #RÉÉCRITURE DES PARAMETRES PAR DEFAUT D'INTERFACES ( DHCP )-------------
  echo \"source /etc/network/interface.d/*\" > /etc/network/interfaces
  echo \"\" >> /etc/network/interfaces
  echo \"#LOCALHOST\" >> /etc/network/interfaces
  echo \"\" >> /etc/network/interfaces
  echo \"auto lo \" >> /etc/network/interfaces
  echo \"iface lo inet loopback\" >> /etc/network/interfaces
  echo \"\" >> /etc/network/interfaces
  echo Votre fichier d'interface a été reinitialiser
else
  echo Vous devez être root pour exécuter ce script
fi";
    $new_script_reset = $firstline_reset . $script_reset ;
    $file_reset = fopen($file_path_reset, 'w+');
    fputs($file_reset,$new_script_reset);
    }
  }
?>
    </div>
  </section>
</main>
