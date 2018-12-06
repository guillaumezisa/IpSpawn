<main role="main"><center>
  <div class="container"><br>
    <h3><strong>Mettre l'ip d'une machine en statique</strong></h3>
    <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boite a outils</a>
    <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a><br><br>
  </div>
  <section class="jumbotron ">
    <div class="ml-2">

<?php
#-------------------------------------------------------------------------------
# GENERATION DU SCRIPT D'IP STATIC
#-------------------------------------------------------------------------------

#GÉNÉRATION DES VARIABLE DE FICHIERS--------------------------------------------
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

    #CRÉATION DE VARIABLES IMPORTANTES POUR ISOLER PHP & BASH-------------------
    $find_package_net='"dpkg -l | grep net-tools"';
    $find_package_res='"dpkg -l | grep resolvconf"';
    $card='$card';
    $mask='$mask';
    $gateway='$gateway';
    $dns='$dns';
    $old_ip='$old_ip';
    $ip='$ip';

    #GÉNÉRATION DU SCRIPT-------------------------------------------------------
    $firstline = "
    #!/bin/bash
    #---------------------------------------------------------------------------
    #SCRIPT MISE EN PLACE D'UNE IP FIXE généré par IpSpawn.com
    V.1
    Le : 2018/12/06
    Script par Guillaume Zisa : zisa@intechinfo.fr
    #---------------------------------------------------------------------------\n";

    $script="
	   apt install net-tools -y
	   apt install resolvconf -y


    #CRÉATION DES VARIABLES IMPORTANTES--------------------------------------
    card=$(ip route |grep default | awk '{print $5}');
    ip=".$_GET['ip'].";
    broadcast=$(ip a | grep ".$card."| grep inet | awk '{print $4}');
    gateway=$(ip route | grep default | awk '{print $3}');
    old_ip=$(ip route | grep ".$card." | grep src | awk '{print $9}');
    mask=$(ifconfig | grep ".$old_ip." | awk '{print $4}');
    dns=$(cat /etc/resolv.conf | grep name | awk '{print $2}' | sed -n '1p');

    echo \"source /etc/network/interface.d/*\" > /etc/network/interfaces
    echo \"\" >> /etc/network/interfaces
    echo \"#LOCALHOST\" >> /etc/network/interfaces
    echo \"\" >> /etc/network/interfaces
    echo \"auto lo \" >> /etc/network/interfaces
    echo \"iface lo inet loopback\" >> /etc/network/interfaces
    echo \"\" >> /etc/network/interfaces
    echo \"#STATIC\" >> /etc/network/interfaces
    echo \"auto ".$card."\" >> /etc/network/interfaces
    echo \"iface ".$card." inet static\" >> /etc/network/interfaces
    echo \"address ".$ip." \" >> /etc/network/interfaces
    echo \"netmask ".$mask." \" >> /etc/network/interfaces
    echo \"gateway ".$gateway." \" >> /etc/network/interfaces
    echo \"\" >> /etc/network/interfaces
    echo \"dns-nameservers ".$dns." \" >> /etc/network/interfaces
    echo \"dns-nameservers 8.8.8.8 \" >> /etc/network/interfaces
    service networking restart
    \n";

    #RASSEMBLEMENT DES VARIABLES & CREATION DU SCRIPT-------------------------
    $new_script = $firstline . $script . $rm;
    $file = fopen($file_path, 'w+');
    fputs($file,$new_script);

    #CREATION D'UN SCRIPT DE RECUPERATION---------------------------------------
    $firstline_reset = "
    #!/bin/bash
    #---------------------------------------------------------------------------
    #SCRIPT DE MISE EN PLACE D'IP DHCP généré par IpSpawn.com
    #---------------------------------------------------------------------------\n";
    #GÉNÉRATION DU SCRIPT-------------------------------------------------------
    $script_reset="
    echo \"source /etc/network/interface.d/*\" > /etc/network/interfaces
    echo \"\" >> /etc/network/interfaces
    echo \"#LOCALHOST\" >> /etc/network/interfaces
    echo \"\" >> /etc/network/interfaces
    echo \"auto lo \" >> /etc/network/interfaces
    echo \"iface lo inet loopback\" >> /etc/network/interfaces
    echo \"\" >> /etc/network/interfaces";

    $new_script_reset = $firstline_reset . $script_reset ;
    $file_reset = fopen($file_path_reset, 'w+');
    fputs($file_reset,$new_script_reset);
    }
  }
?>
    </div>
  </section>
</main>
