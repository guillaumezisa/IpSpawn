<main role="main"><center>
  <div class="container"><br>
    <h3><strong>Ajout de droit(s) sur un fichier ou un repertoire</strong></h3>
    <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boite a outils</a>
    <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a>
    </p>
  </div>
  <section class="jumbotron ">
    <div class="ml-2">
<?php
#-------------------------------------------------------------------------------
# GENERATION DU SCRIPT DE MODIFICATION DU PROPRIÉTAIRE / REPERTOIRES
#-------------------------------------------------------------------------------

#GÉNÉRATION DES VARIABLE DE FICHIERS--------------------------------------------
$file_path="../script/script_client/add_group_change_owner_".session_id().".sh";
$file_name="add_group_change_owner.sh";

#VÉRIFICATION DE L'OPTION D'AUTO-DESTRUCTION ET DE RECURSION--------------------
if (isset( $_GET["auto_destruction"] )){ $rm = "rm ".$file_name; } else { $rm = ""; }
if (isset( $_GET["recursion"] )){ $R="-R";}else{ $R="";}

#AJOUT DU LIEN DE TÉLÉCHARGEMENT & GUIDE----------------------------------------
echo "<center><a class='btn btn-dark' href='".$file_path."'download='".$file_name."' target='_blank'>Télécharger le script </a></center><br>";
include("../view/guide_execution.php");

#-------------------------------------------------------------------------------
# GÉNÉRATION DU SCRIPT
#-------------------------------------------------------------------------------
if(isset($_GET['action']) && isset($_GET['under_action'])){
    if(isset($_GET['user']) && isset($_GET['group'])&& isset($_GET['path'])){
      $nb = count($_GET['user']);
      #CONCATENATION DE TABLEAUX BASH---------------------------------------------
      for( $i=0 ;$i<$nb ;$i++){
        if ($i === 0 ){
          $username="user[$i]=".$_GET['user'][$i]."\n";
          $groupname="group[$i]=".$_GET['group'][$i]."\n";
          $pathname="path[$i]=".$_GET['path'][$i]."\n";
        } else {
          $username=$user."user[$i]=".$_GET['user'][$i]."\n";
          $groupname=$group."group[$i]=".$_GET['group'][$i]."\n";
          $pathname=$path."path[$i]=".$_GET['path'][$i]."\n";
        }
      }

      #CRÉATION DE VARIABLES IMPORTANTES POUR ISOLER PHP & BASH-----------------
      $user = '${user[$y]}';
      $group = '${group[$y]}';
      $path = '${path[$y]}';
      $root = '"root"';

      #GÉNÉRATION DU SCRIPT-----------------------------------------------------
      $firstline = "#!/bin/bash
#-------------------------------------------------------------------------------
#SCRIPT DE MODIFICATION DE PROPRIETAIRES généré par IpSpawn.com
#V.1.4
#Le : 2018/12/06
#Script par Guillaume Zisa : zisa@intechinfo.fr
#-------------------------------------------------------------------------------
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
#ROOT OBLIGATOIRE POUR L'EXECUTION----------------------------------------------
if [ $(whoami) == ".$root." ];then
  for ((y=0;y<".$nb.";y++))
  do
    if [ [\"-f ".$path." || -d ".$path." \"] ];
    then
      chown ".$R." ".$user.":".$group." ".$path."
    else
      echo Le fichier ou le dossier est introuvable
    fi
  done
else
  echo Vous devez être root pour executer ce script
fi";

      #RASSEMBLEMENT DES VARIABLES & CREATION DU SCRIPT-------------------------
      $new_script = $firstline . $username . $groupname . $pathname . $script . $rm;
      $file = fopen($file_path, 'w+');
      fputs($file,$new_script);

    }
  }

?>

</section>
</main>
