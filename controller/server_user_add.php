<main role="main"><center>
  <div class="container"><br>
  <h3><strong>Ajout d'utilisateur(s) à des groupe(s)</strong></h3>
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
$file_path="../script/script_client/add_user_".session_id().".sh";
$file_name="add_user.sh";
#VÉRIFICATION DE L'OPTION D'AUTO-DESTRUCTION------------------------------------
if (isset( $_GET["auto_destruction"] )){ $rm = "rm ".$file_name; } else { $rm = ""; }
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

      #GÉNÉRATION DU SCRIPT-----------------------------------------------------
      $firstline = "
      #!/bin/bash
      #-------------------------------------------------------------------------
      #SCRIPT D'AJOUT D'UTILISATEUR généré par IpSpawn.com
      V.1
      Le : 2018/12/06
      Script par Guillaume Zisa : zisa@intechinfo.fr
      #-------------------------------------------------------------------------\n";

      $script="
        for ((y=0;y<".$nb.";y++))
        do
          #VERIFICATION DE L'EXISTENCE DE L'UTILISATEUR-------------------------
          id -u ".$user."> /dev/null 2>&1
          if [ $? == 0 ];
          then
            echo Nom d\'utilisateur déjà utilisé.
          else
            #CRÉATION D'UN UTILISATEUR------------------------------------------
            useradd -m -d /home/".$user." -s /bin/bash ".$user."
            echo ".$user.":".$pass."| chpasswd
            groupdel -f  ".$user."
          fi
        done\n";
      #RASSEMBLEMENT DES VARIABLES & CREATION DU SCRIPT-------------------------
      $new_script = $firstline . $username . $password . $script . $rm;
      $file = fopen($file_path, 'w+');
      fputs($file,$new_script);

    }
  }
?>

</section>
</main>
