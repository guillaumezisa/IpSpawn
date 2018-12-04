<main role="main"><center>
  <div class="container"><br>
  <h3><strong>Gestion du serveur samba</strong></h3>
    <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boite a outils</a>
    <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a>
  </div>
  <section class="jumbotron ">
    <div class="ml-2">
<?php
#-------------------------------------------------------------------------------
# GENERATION DU SCRIPT SAMBA
#-------------------------------------------------------------------------------

#GÉNÉRATION DES VARIABLES DE FICHIERS--------------------------------------------
$file_path="../script/server_samba/server_samba".session_id().".sh";
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

      #CRÉATION DE VARIABLES IMPORTANTES POUR ISOLER PHP & BASH-----------------
      $statut = '${statut}';
      $path = $_GET['path'];

      #GÉNÉRATION DU SCRIPT-----------------------------------------------------
      $firstline = "
      #!/bin/bash
      #-------------------------------------------------------------------------
      #SCRIPT D'INSTALATION D'UN SERVEUR SAMBA
      #-------------------------------------------------------------------------\n";

      $script="
      # Mise à jour

      sudo apt-get -y update
      sudo apt-get -y upgrade

      # Installation des paquets samba

      sudo apt-get -y install samba
      sudo apt-get -y install samba-common-bin

      cp /etc/samba/smb.conf /etc/samba/smb.conf_backup
      grep -v -E \"^#|^;\" /etc/samba/smb.conf_backup | grep . > /etc/samba/smb.conf
      systemctl restart smbd

      mkdir ".$path."
      mkdir ".$path."/commun
      chmod 744 ".$path."
      chmod 777 ".$path."/commun

      echo -e \"
      [commun]
      comment = public anonymous access
      path = ".$path."/commun
      browsable =yes
      create mask = 0660
      directory mask = 0771
      writable = yes
      guest ok = yes\"  >> /etc/samba/smb.conf

      systemctl restart smbd

      ";

      if(isset($username) && isset($_GET['psswrd'])){
        $nb = count($username);

        #CONCATENATION DE TABLEAUX BASH---------------------------------------------
        for( $i=0 ;$i<$nb ;$i++){
          if ($i === 0 ){
          $username = "user[$i]=".$_GET['username'][$i]."\n";
          $password = "psswrd[$i]=".$_GET['psswrd'][$i]."\n";
          $group = "group[$i]=".$_GET['group'][$i]."\n";
          } else {
            $username=$username."user[$i]=".$_GET['username'][$i]."\n";
            $password=$password."psswrd[$i]=".$_GET['psswrd'][$i]."\n";
            $group=$group."group[$i]=".$_GET['group'][$i]."\n";
          }
        }
      }
      $user ='${user[$y]}';
      $password ='${psswrd[$y]}';
      $group = '${group[$y]}';

    $script=$script."
    liste=($( ls -la ".$path." | awk -F\" \" '{print$9}'))
    for ((y=0;y<".$nb.";y++))
    do
      for ((i=0;i<".$nb.";i++))
      do
        if [ $user ==  $(liste[$i])];
        then
          echo'Utilisateur $user existe déjà'
          break
        else

        # Création Utilisateur
        useradd $user
        #AJOUTER UN VERIFY

        # Création groupe
        groupadd $group
        # AJOUTER UN VERIFY

        # Définition du Mot de passe
        smbpasswd -a $user $psswrd

        # Création du Répertoire partagé
        sudo mkdir -p $path/$group

        # Application des Droits au dossier
        chown -R root:$group $path/$group
        chmod -R 770 $path/$group

    "

  #RASSEMBLEMENT DES VARIABLES & CREATION DU SCRIPT-------------------------
  $new_script = $firstline . $username . $password . $script . $rm;
  $file = fopen($file_path, 'w+');
  fputs($file,$new_script);

  }
?>

</section>
</main> 
