<main role="main"><center>
  <div class="container"><br>
  <h3><strong>Ajout de groupe(s) aux sudoers</strong></h3>
    <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boîte à outils</a>
    <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a>
  </div>
  <section class="jumbotron ">
    <div class="ml-2">
<?php
#-------------------------------------------------------------------------------
# GENERATION DU SCRIPT D'AJOUT DE DROITS AU GROUPE
#-------------------------------------------------------------------------------

#GÉNÉRATION DES VARIABLES DE FICHIERS--------------------------------------------
$file_path="../script/script_client/add_right_group_sudoers_".session_id().".sh";
$file_name="add_right_group_sudoers.sh";

#VÉRIFICATION DE L'OPTION D'AUTO-DESTRUCTION------------------------------------
if (isset( $_GET["auto_destruction"] )){ $rm = "rm ".$file_name; } else { $rm = ""; }

#AJOUT DU LIEN DE TÉLÉCHARGEMENT & GUIDE----------------------------------------
echo "<center><a class='btn btn-dark' href='".$file_path."'download='".$file_name."' target='_blank'>Télécharger le script </a></center><br>";
include("../view/guide_execution.php");

#-------------------------------------------------------------------------------
# GÉNÉRATION DU SCRIPT
#-------------------------------------------------------------------------------

if(isset($_GET['action']) && isset($_GET['under_action'])){
  if(isset($_GET['group'])){
    $nb = count($_GET['group']);

    #CONCATENATION DE TABLEAUX BASH---------------------------------------------

    for( $i=0 ;$i<$nb ;$i++){
      if ($i === 0 ){
        $groups="group[$i]=".$_GET['group'][$i]."\n";
      } else {
        $groups=$groups."group[$i]=".$_GET['group'][$i]."\n";
      }
    }

    #CRÉATION DE VARIABLES IMPORTANTES POUR ISOLER PHP & BASH-------------------
    $group = '${group[$y]}';
    $root='"root"';

    #GÉNÉRATION DU SCRIPT-------------------------------------------------------
    $firstline = "#!/bin/bash
#-------------------------------------------------------------------------------
#SCRIPT DE MODIFICATION DES DROITS DE GROUPE généré par IpSpawn.com
#V.1.4
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
echo \"\"\n";

      $script="
#ROOT OBLIGATOIRE POUR L'EXECUTION----------------------------------------------
if [ $(whoami) == ".$root." ];then
  for ((y=0;y<".$nb.";y++))
  do
    #VÉRIFICATION DE L'EXISTENCE DU GROUPE--------------------------------------
    if grep \"^".$group.":\" /etc/group > /dev/null;
    then
      echo \"%".$group."  ALL=(ALL:ALL) ALL \" >> /etc/sudoers
      echo Le groupe ".$group." a été ajouté aux sudoers
    else
      echo Le groupe ".$group." est introuvable
    fi
  done\n
  service sudo restart
else
    echo Vous devez être root pour exécuter ce script
fi";

      #RASSEMBLEMENT DES VARIABLES & CREATION DU SCRIPT-------------------------
      $new_script = $firstline . $groups . $script . $rm;
      $file = fopen($file_path, 'w+');
      fputs($file,$new_script);
    }
  }
?>
    </div>
  </section>
</main>
