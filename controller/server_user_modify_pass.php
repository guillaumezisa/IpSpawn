<main role="main"><center>
  <div class="container"><br>
  <h3><strong>Modification de mot(s) de passe(s) d'utilisateur(s)</strong></h3>
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
$file_path="../script/script_client/mod_user_pass_".session_id().".sh";
$file_name="mod_user_pass.sh";

#VÉRIFICATION DE L'OPTION D'AUTO-DESTRUCTION------------------------------------
if (isset( $_GET["auto_destruction"] )){ $rm = "rm adduser.sh"; } else { $rm = ""; }

#AJOUT DU LIEN DE TÉLÉCHARGEMENT & GUIDE----------------------------------------
echo "<center><a class='btn btn-dark' href='".$file_path."'download='".$file_name."' target='_blank'>Télécharger le script </a></center><br>";
include("../view/guide_execution.php");

#-------------------------------------------------------------------------------
# GÉNÉRATION DU SCRIPT
#-------------------------------------------------------------------------------

if(isset($_GET['action']) && isset($_GET['under_action'])){
  if(isset($_GET['username']) && isset($_GET['password'])){
    $nb = count($_GET['username']);

    #CONCATENATION DE TABLEAUX BASH---------------------------------------------
    for( $i=0 ;$i<$nb ;$i++){
      if ($i === 0 ){
        $username="user[$i]=".$_GET['username'][$i]."\n";
        $password="pass[$i]=".$_GET['password'][$i]."\n";
      } else {
        $username=$username."user[$i]=".$_GET['username'][$i]."\n";
        $password=$password."pass[$i]=".$_GET['password'][$i]."\n";
      }
    }

    #CRÉATION DE VARIABLES IMPORTANTES POUR ISOLER PHP & BASH-----------------
    $user = '${user[$y]}';
    $pass = '${pass[$y]}';
    $root='"root"';
    $hum='\n';

    #GÉNÉRATION DU SCRIPT-------------------------------------------------------
    $firstline = "#!/bin/bash
#-------------------------------------------------------------------------------
#SCRIPT DE MOFICATION DE MDP UTILISATEURS généré par IpSpawn.com
#V.1.2
#Le : 2018/12/06
#Script par Guillaume Zisa : zisa@intechinfo.fr
#---------------------------------------------------------------------------\n";

$script="
#ROOT OBLIGATOIRE POUR L'EXECUTION----------------------------------------------
if [ $(whoami) == ".$root." ];then
  for ((y=0;y<".$nb.";y++))
  do
    #MODIFICATION DU MOT DE PASSE D'UTILISATEURS--------------------------------
    echo -e \"$pass$hum$pass\" | passwd ".$user."
  done\n
else
  echo Vous devez être root pour executer ce script
fi";

    #RASSEMBLEMENT DES VARIABLES & CREATION DU SCRIPT---------------------------
    $new_script = $firstline . $username . $password . $script . $rm;
    $file = fopen($file_path, 'w+');
    fputs($file,$new_script);

    }
  }
?>
    </div>
  </section>
</main>
