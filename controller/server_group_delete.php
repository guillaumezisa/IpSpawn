<main role="main"><center>
  <div class="container"><br>
  <h3><strong>Suppression de groupe(s)</strong></h3>
    <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boite a outils</a>
    <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a>
  </div>
  <section class="jumbotron ">
    <div class="ml-2">
<?php
#-------------------------------------------------------------------------------
# GENERATION DU SCRIPT D'AJOUT DE DROITS AU GROUPE
#-------------------------------------------------------------------------------

#GÉNÉRATION DES VARIABLE DE FICHIERS--------------------------------------------
$file_path="../script/script_client/del_group_".session_id().".sh";
$file_name="del_group.sh";


#VÉRIFICATION DE L'OPTION D'AUTO-DESTRUCTION------------------------------------
if (isset( $_GET["auto_destruction"] )){ $rm = "rm addgroup.sh"; } else { $rm = ""; }

#AJOUT DU LIEN DE TÉLÉCHARGEMENT & GUIDE----------------------------------------
echo "<center><a class='btn btn-dark' href='".$file_path."'download='".$file_name."' target='_blank'>Télécharger le script </a></center><br>";
include("../view/guide_execution.php");

#-------------------------------------------------------------------------------
# GÉNÉRATION DU SCRIPT
#-------------------------------------------------------------------------------
if(isset($_GET['action']) && isset($_GET['under_action'])){
  if(isset($_GET['groupname'])){
    $nb = count($_GET['groupname']);

    #CONCATENATION DE TABLEAUX BASH---------------------------------------------
    for( $i=0 ;$i<$nb ;$i++){
      if ($i === 0 ){
        $groupname="group[$i]=".$_GET['groupname'][$i]."\n";
      } else {
        $groupname=$groupname."group[$i]=".$_GET['groupname'][$i]."\n";
      }
    }

    #CRÉATION DE VARIABLES IMPORTANTES POUR ISOLER PHP & BASH-----------------
    $group = '${group[$y]}';

    #GÉNÉRATION DU SCRIPT-----------------------------------------------------
    $firstline = "
    #!/bin/bash
    #---------------------------------------------------------------------------
    #SCRIPT DE SUPPRESSION DE GROUPE généré par IpSpawn.com
    #---------------------------------------------------------------------------\n";

    $script="
        for ((y=0;y<".$nb.";y++))
        do
          #VÉRIFICATION DE L'EXISTANCE DU GROUPE--------------------------------
          if grep \"^".$group.":\" /etc/group > /dev/null;
          then
            #SUPPRESSION DU GROUPE----------------------------------------------
            groupdel ".$group."\n
            echo Le groupe a bien été supprimé.
          else
            echo Le groupe n'existe pas.
          fi
        done\n";
      #RASSEMBLEMENT DES VARIABLES & CREATION DU SCRIPT-------------------------
      $new_script = $firstline . $groupname . $script . $rm;
      $file = fopen($file_path, 'w+');
      fputs($file,$new_script);
    }
  }
?>
    </div>
  </section>
</main>
