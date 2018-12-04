<main role="main"><center>
  <div class="container"><br>
  <h3><strong>Gestion du serveur mail</strong></h3>
    <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boite a outils</a>
    <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a>
  </div>
  <section class="jumbotron ">
    <div class="ml-2">
<?php
#-------------------------------------------------------------------------------
# GENERATION DU SCRIPT MAIL
#-------------------------------------------------------------------------------

#GÉNÉRATION DES VARIABLE DE FICHIERS--------------------------------------------
$file_path="../script/server_mail/server_samba".session_id().".sh";
$file_name="server_samba.sh";
#VÉRIFICATION DE L'OPTION D'AUTO-DESTRUCTION------------------------------------
if (isset( $_GET["auto_destruction"] )){ $rm = "rm ".$file_name; } else { $rm = ""; }
#AJOUT DU LIEN DE TÉLÉCHARGEMENT & GUIDE----------------------------------------
echo "<center><a class='btn btn-dark' href='".$file_path."'download='".$file_name."' target='_blank'>Télécharger le script </a></center><br>";
include("../view/guide_execution.php");

#-------------------------------------------------------------------------------
# GÉNÉRATION DU SCRIPT
#-------------------------------------------------------------------------------
  if(isset($_GET['action']) && isset($_GET['under_action'])){
    if(isset($username) && isset($_GET['psswrd'])){
      $nb = count($username);

      #CONCATENATION DE TABLEAUX BASH---------------------------------------------
      for( $i=0 ;$i<$nb ;$i++){
        if ($i === 0 ){
        $username = "user[$i]=".$_GET['username'][$i]."\n";
        $password = "psswrd[$i]=".$_GET['psswrd'][$i]."\n";
        } else {
          $username=$username."user[$i]=".$_GET['username'][$i]."\n";
          $password=$password."psswrd[$i]=".$_GET['psswrd'][$i]."\n";
      }
    }
      #CRÉATION DE VARIABLES IMPORTANTES POUR ISOLER PHP & BASH-----------------
      $statut = '${statut}';
      $user ='${user[$y]}';
      $password ='${psswrd[$y]}';

      #GÉNÉRATION DU SCRIPT-----------------------------------------------------
      $firstline = "
      #!/bin/bash
      #-------------------------------------------------------------------------
      #SCRIPT D'INSTALATION D'UN SERVEUR SAMBA
      #-------------------------------------------------------------------------\n";

      $script="
      liste=($( ls -la ".$path." | awk -F\" \" '{print$9}'))
      for ((y=0;y<".$nb.";y++))
      do
        for ((i=0;i<".$nb.";i++))
        do
          if [ $user == $(liste[$i])];
          then
            echo'Utilisateur $user existe déjà'
            break
          else

          # Création Utilisateur
          useradd $user
          #AJOUTER UN VERIFY

          # Définition du Mot de passe
          smbpasswd -a $user $psswrd

      ";

      #RASSEMBLEMENT DES VARIABLES & CREATION DU SCRIPT-------------------------
      $new_script = $firstline . $username . $password . $script . $rm;
      $file = fopen($file_path, 'w+');
      fputs($file,$new_script);

    }
  }
?>

</section>
</main>
