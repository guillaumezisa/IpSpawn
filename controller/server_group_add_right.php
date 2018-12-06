<main role="main"><center>
  <div class="container"><br>
  <h3><strong>Ajout de d'utilisateur(s) a des groupe(s)</strong></h3>
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
$file_path="../script/script_client/add_right_group_".session_id().".sh";
$file_name="add_right_group.sh";

#VÉRIFICATION DE L'OPTION D'AUTO-DESTRUCTION------------------------------------
if (isset( $_GET["auto_destruction"] )){ $rm = "rm ".$file_name; } else { $rm = ""; }

#AJOUT DU LIEN DE TÉLÉCHARGEMENT & GUIDE----------------------------------------
echo "<center><a class='btn btn-dark' href='".$file_path."'download='".$file_name."' target='_blank'>Télécharger le script </a></center><br>";
include("../view/guide_execution.php");

#-------------------------------------------------------------------------------
# GÉNÉRATION DU SCRIPT
#-------------------------------------------------------------------------------
if(isset($_GET['action']) && isset($_GET['under_action'])){
  if(isset($_GET['groupname'])){
    $nb = count($_GET['commands']);

    #CONCATENATION DE TABLEAUX BASH---------------------------------------------
    $groupname="group=".$_GET['groupname']."\n";
    for( $i=0 ;$i<$nb ;$i++){
      if ($i === 0 ){
        $commands="com[$i]=".$_GET['commands'][$i]."\n";
      } else {
        $commands=$commands."com[$i]=".$_GET['commands'][$i]."\n";
      }
    }

      #CRÉATION DE VARIABLES IMPORTANTES POUR ISOLER PHP & BASH-----------------
      $group ='$group';
      $group_new='$group_new';
      $com ='${com[$y]}';
      $comm='${com[$y]:1}';
      $which='$(which $neutre)';
      $which_simple='$which';
      $which_com='$(which ${com[$y]})';
      $path ='${path[$y]}';
      $y='$y';
      $string='$string';

      #GÉNÉRATION DU SCRIPT-----------------------------------------------------
      $firstline = "
      #!/bin/bash
      #-------------------------------------------------------------------------
      #SCRIPT DE MOFICATION DES DROITS DE GROUPE généré par IpSpawn.com
      #V.1.3
      #Le : 2018/12/06
      #Script par Guillaume Zisa : zisa@intechinfo.fr
      #-------------------------------------------------------------------------\n";

      $script="
      apt install sudo -y
      for ((y=0;y<".$nb.";y++))
      do
        #TRAITEMENT DES COMMANDES NEGATIVES-------------------------------------
        if [[ ".$com." =~ ^[!] ]];then
          if [ ".$y." -eq 0 ];then
            #OBTENTION DU PATH DES COMMANDES AVEC !-----------------------------
            neutre=".$comm."
            which=".$which.";
            path[$y]=!".$which_simple."
            echo -n ".$path." > tmp
          else
            #OBTENTION DU PATH DES COMMANDES AVEC ! & CONCATENATION-------------
            neutre=".$comm."
            which=".$which.";
            path[$y]=,!".$which_simple."
            echo -n ".$path." >> tmp
          fi
        else
        #TRAITEMENT DES COMMANDES POSITIVES-------------------------------------
          if [ ".$y." -eq 0 ];then
          #OBTENTION DU PATH DES COMMANDES--------------------------------------
            which=".$which_com.";
            path[$y]=".$which_simple."
            echo -n ".$path." > tmp
          else
          #OBTENTION DU PATH DES COMMANDES & CONCATENATION----------------------
            which=".$which_com.";
            path[$y]=,".$which_simple."
            echo -n ".$path." >> tmp
          fi
        fi
      done
      #CRÉATION DES DERNIERES VARIABLES NÉCÉSSAIRE & CONCATENATION FINAL--------
      group_new='%'".$group.";
      string=$(cat tmp)
      #INSERTION DE LA CONFIGURATION, EFFACEMENT DU FICHIER TMP & RESTART-------
      echo ".$group_new."'	ALL=(ALL)' ".$string." >> /etc/sudoers;
      rm tmp
      service sudo restart";

      #RASSEMBLEMENT DES VARIABLES & CREATION DU SCRIPT-------------------------
      $new_script = $firstline . $groupname . $commands . $script . $rm;
      $file = fopen($file_path, 'w+');
      fputs($file,$new_script);
    }
  }
?>
    </div>
  </section>
</main>
