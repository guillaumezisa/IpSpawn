<main role="main"><center>
  <div class="container"><br>
  <h3><strong>Mettre l\'ip d'une machine static</strong></h3>
    <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boite a outils</a>
    <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a>
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

#VÉRIFICATION DE L'OPTION D'AUTO-DESTRUCTION------------------------------------
if (isset( $_GET["auto_destruction"] )){ $rm = "rm ".$file_name; } else { $rm = ""; }
echo "lol";
#AJOUT DU LIEN DE TÉLÉCHARGEMENT & GUIDE----------------------------------------
echo "<center><a class='btn btn-dark' href='".$file_path."'download='".$file_name."' target='_blank'>Télécharger le script </a></center><br>";
include("../view/guide_execution.php");

#-------------------------------------------------------------------------------
# GÉNÉRATION DU SCRIPT
#-------------------------------------------------------------------------------
if(isset($_GET['action']) && isset($_GET['under_action'])){
  if(isset($_GET['ip'])){
    $nb = count($_GET['ip']);

    #CRÉATION DE VARIABLES IMPORTANTES POUR ISOLER PHP & BASH-------------------

    echo $ID;
    echo "lol";
    #GÉNÉRATION DU SCRIPT-------------------------------------------------------
    $firstline = "
    #!/bin/bash
    #---------------------------------------------------------------------------
    #SCRIPT DE MOFICATION DES DROITS DE IDE généré par IpSpawn.com
    #---------------------------------------------------------------------------\n";

    $script="
    #VERIFICATION DE L'EXISTANCE DES PAQUETS---------------------------------
    if [ \"dpkg -l | grep net-tools\" = \"\" ];
    then
	   apt install net-tools -y
    fi
    if [ \"dpkg -l | grep resolvconf\" = \"\" ];
    then
	   apt install resolvconf -y
    fi

    #CRÉATION DES VARIABLES IMPORTANTES--------------------------------------
    card=$(ip route |grep default | awk '{print $5}');
    ip=".$_GET['ip'].";
    broadcast=$(ip a | grep $card| grep inet | awk '{print $4}');
    gateway=$(ip route | grep default | awk '{print $3}');
    mask=$(ifconfig | grep $ip | awk '{print $4}');
    dns=$(cat /etc/resolv.conf | grep name | awk '{print $2}' | sed -n '1p')

    echo \"source /etc/network/interface.d/*\" > /etc/network/interfaces
    echo \"\" >> /etc/network/interfaces
    echo \"#LOCALHOST\" >> /etc/network/interfaces
    echo \"\" >> /etc/network/interfaces
    echo \"auto lo \" >> /etc/network/interfaces
    echo \"iface lo inet loopback\" >> /etc/network/interfaces
    echo \"\" >> /etc/network/interfaces
    echo \"#STATIC\" >> /etc/network/interfaces
    echo \"auto $card\" >> /etc/network/interfaces
    echo \"iface $card inet static\" >> /etc/network/interfaces
    echo \"address $ip\" >> /etc/network/interfaces
    echo \"netmask $mask\" >> /etc/network/interfaces
    echo \"gateway $gateway\" >> /etc/network/interfaces
    echo \"\" >> /etc/network/interfaces
    echo \"dns-nameservers $dns\" >> /etc/network/interfaces
    service networking restart
    \n";
    echo "lol";
      #RASSEMBLEMENT DES VARIABLES & CREATION DU SCRIPT-------------------------
      $new_script = $firstline . $script . $rm;
      echo $new_script;
      $file = fopen($file_path, 'w+');
      fputs($file,$new_script);
    }
  }
?>
    </div>
  </section>
</main>
