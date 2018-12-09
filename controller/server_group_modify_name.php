<main role="main"><center>
  <div class="container"><br>
  <h3><strong>Modification de nom(s) de groupe(s)</strong></h3>
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
$file_name="mod_group_name.sh";
$file_path="../script/script_client/mod_group_name_".session_id().".sh";

#VÉRIFICATION DE L'OPTION D'AUTO-DESTRUCTION------------------------------------
if (isset( $_GET["auto_destruction"] )){ $rm = "rm ".$file_name; } else { $rm = ""; }

#AJOUT DU LIEN DE TÉLÉCHARGEMENT & GUIDE----------------------------------------
echo "<center><a class='btn btn-dark' href='".$file_path."'download='".$file_name."' target='_blank'>Télécharger le script </a></center><br>";
include("../view/guide_execution.php");

#-------------------------------------------------------------------------------
# GÉNÉRATION DU SCRIPT
#-------------------------------------------------------------------------------
if(isset($_GET['action']) && isset($_GET['under_action'])){
  if(isset($_GET['groupname1']) && isset($_GET['groupname2'])){
    $nb = count($_GET['groupname1']);

    #CONCATENATION DE TABLEAUX BASH---------------------------------------------
    for( $i=0 ;$i<$nb ;$i++){
      if ($i === 0 ){
        $groupname1="group1[$i]=".$_GET['groupname1'][$i]."\n";
        $groupname2="group2[$i]=".$_GET['groupname2'][$i]."\n";
      } else {
        $groupname1=$groupname1."group1[$i]=".$_GET['groupname1'][$i]."\n";
        $groupname2=$groupname2."group2[$i]=".$_GET['groupname2'][$i]."\n";
      }
    }

    #CRÉATION DE VARIABLES IMPORTANTES POUR ISOLER PHP & BASH-------------------
    $group1 = '${group1[$y]}';
    $group2 = '${group2[$y]}';
    $root = '"root"';
    #GÉNÉRATION DU SCRIPT-------------------------------------------------------
    $firstline = "#!/bin/bash
#-------------------------------------------------------------------------------
#SCRIPT DE MOFICATION D'UTILISATEURS généré par IpSpawn.com
#V.1.3
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
    #MODIFICATION DU GROUPE-----------------------------------------------------
    groupmod --new-name $group2 $group1
  done\n
else
  echo Vous devez être root pour executer ce script
fi";

    #RASSEMBLEMENT DES VARIABLES & CREATION DU SCRIPT---------------------------
    $new_script = $firstline . $groupname1 . $groupname2 . $script . $rm;
    $file = fopen($file_path, 'w+');
    fputs($file,$new_script);
  }
}
?>
    </div>
  </section>
</main>
