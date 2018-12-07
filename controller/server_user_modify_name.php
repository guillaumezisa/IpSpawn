<main role="main"><center>
  <div class="container"><br>
  <h3><strong>Modification d'utilisateur(s)</strong></h3>
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
$file_name="mod_name.sh";
$file_path="../script/script_client/mod_name_".session_id().".sh";

#VÉRIFICATION DE L'OPTION D'AUTO-DESTRUCTION------------------------------------
if (isset( $_GET["auto_destruction"] )){ $rm = "rm ".$file_name; } else { $rm = ""; }

#AJOUT DU LIEN DE TÉLÉCHARGEMENT & GUIDE----------------------------------------
echo "<center><a class='btn btn-dark' href='".$file_path."'download='".$file_name."' target='_blank'>Télécharger le script </a></center><br>";
include("../view/guide_execution.php");

#-------------------------------------------------------------------------------
# GÉNÉRATION DU SCRIPT
#-------------------------------------------------------------------------------
if(isset($_GET['action']) && isset($_GET['under_action'])){
  if(isset($_GET['username1']) && isset($_GET['username2'])){
    $nb = count($_GET['username1']);

    #CONCATENATION DE TABLEAUX BASH---------------------------------------------
    for( $i=0 ;$i<$nb ;$i++){
      if ($i === 0 ){
        $username1="user1[$i]=".$_GET['username1'][$i]."\n";
        $username2="user2[$i]=".$_GET['username2'][$i]."\n";
      } else {
        $username1=$username1."user1[$i]=".$_GET['username1'][$i]."\n";
        $username2=$username2."user2[$i]=".$_GET['username2'][$i]."\n";
      }
    }

    #CRÉATION DE VARIABLES IMPORTANTES POUR ISOLER PHP & BASH-----------------
    $user1 = '${user1[$y]}';
    $user2 = '${user2[$y]}';
    $root='"root"';

    #GÉNÉRATION DU SCRIPT-------------------------------------------------------
    $firstline = "#!/bin/bash
#-------------------------------------------------------------------------------
#SCRIPT DE MOFICATION D'UTILISATEURS généré par IpSpawn.com
#V.1.3
#Le : 2018/12/06
#Script par Guillaume Zisa : zisa@intechinfo.fr
#---------------------------------------------------------------------------\n";

    $script="
#ROOT OBLIGATOIRE POUR L'EXECUTION----------------------------------------------
if [ $(whoami) == ".$root." ];then
  for ((y=0;y<".$nb.";y++))
  do
    #MODIFICATION D'UTILISATEUR-------------------------------------------------
    usermod --login $user2 --home /home/\"$user2\" --move-home $user1
  done\n
else
  echo Vous devez être root pour executer ce script
fi";

    #RASSEMBLEMENT DES VARIABLES & CREATION DU SCRIPT---------------------------
    $new_script = $firstline . $username1 . $username2 . $script . $rm;
    $file = fopen($file_path, 'w+');
    fputs($file,$new_script);
  }
}
?>
    </div>
  </section>
</main>
