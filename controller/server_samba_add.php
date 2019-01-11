<main role="main"><center>
  <div class="container"><br>
  <h3><strong>Ajout d'utilisateur(s) à des groupe(s)</strong></h3>
    <a href="../controller/redirection.php?enter=tools" class="btn btn-success my-2">Boite à outils</a>
    <a href="../controller/redirection.php?enter=servers" class="btn btn-primary my-2">Gestion de serveur(s) Debian 9</a>
  </div>
  <section class="jumbotron ">
    <div class="ml-2">
<?php
#-------------------------------------------------------------------------------
# GENERATION DU SCRIPT SAMBA
#-------------------------------------------------------------------------------

#GÉNÉRATION DES VARIABLES DE FICHIERS--------------------------------------------
$file_path="../script/server_samba/samba_add_user.sh".session_id().".sh";
$file_name="samba_add_user.sh";
#VÉRIFICATION DE L'OPTION D'AUTO-DESTRUCTION------------------------------------
if (isset( $_GET["auto_destruction"] )){ $rm = "rm ".$file_name; } else { $rm = ""; }
#AJOUT DU LIEN DE TÉLÉCHARGEMENT & GUIDE----------------------------------------
echo "<center><a class='btn btn-dark' href='".$file_path."'download='".$file_name."' target='_blank'>Télécharger le script </a></center><br>";
include("../view/guide_execution.php");

#-------------------------------------------------------------------------------
# GÉNÉRATION DU SCRIPT
#-------------------------------------------------------------------------------
  if(isset($_GET['action']) && isset($_GET['under_action'])){
      $nb = count($_GET['username']);

      #CONCATENATION DE TABLEAUX BASH---------------------------------------------
      for( $i=0 ;$i<$nb ;$i++){
        if ($i === 0 ){
          $group = "group[$i]=".$_GET['usergroup'][$i]."\n";
          $username = "user[$i]=".$_GET['username'][$i]."\n";
          $dossier = "dossier[$i]=".$_GET['dossier'][$i]."\n";
          $password = "psswrd[$i]=".$_GET['userpassword'][$i]."\n";
        } else {
          $group = "group[$i]=".$_GET['usergroup'][$i]."\n";
          $username=$username."user[$i]=".$_GET['username'][$i]."\n";
          $dossier=$dossier."dossier[$i]=".$_GET['dossier'][$i]."\n";
          $password=$password."psswrd[$i]=".$_GET['userpassword'][$i]."\n";
      }
    }
      #CRÉATION DE VARIABLES IMPORTANTES POUR ISOLER PHP & BASH-----------------
      $statut = '${statut}';
      $user ='${user[$y]}';
      $password ='${psswrd[$y]}';
      $group = '${group[$y]}';
      $path = $_GET['zone'];

      #GÉNÉRATION DU SCRIPT-----------------------------------------------------
      $firstline = "
      #!/bin/bash
      #-------------------------------------------------------------------------
      #SCRIPT D'INSTALATION D'UN SERVEUR SAMBA
      #V.1
      #Le : 2018/12/06
      #Script par Robin Cuvillier : rcvuillier@intechinfo.fr
      #-------------------------------------------------------------------------
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
function begin() {
  statut=$('whoami')
  # Vérification des droits de l'exécuteur du script
  if [ ".$statut." != root ]
    then
    echo \"Vous n'avez pas les droits nécéssaires, contactez votre administrateur ...\"
    sleep 1
    exit
  elif [ ".$statut." = root ]
  then
    apt-get -y update
    apt-get -y upgrade
  fi
}

begin

if [ ".$statut." = root ]
then
  for ((y=0;y<".$nb.";y++))
  do
    id ".$user."
    if [ $? == 0 ];
    then
      echo \"'".$user."' déjà existant.\"
    else
      useradd -m -d /home/".$user." -s /bin/bash ".$user."
      echo \"".$user.":".$password."\"| chpasswd
    fi

    cat /etc/group | awk -F\":\" '{print$1}' | grep -w ".$group."
    if [ $? == 0 ];
    then
      echo \"'".$group."' déjà existant.\"
    else
      groupadd ".$group."
    fi
    usermod -a -G ".$group." ".$user."

    # Création du Répertoire partagé
    mkdir -p ".$path."/".$dossier."

    # Application des Droits au dossier
    chown -R root:".$group." ".$path."/".$dossier."
    chmod -R 770 ".$path."/".$dossier."

    echo -e \"[".$dossier."]\n  comment = Dossier du group ".$group."\n path = ".$path."/".$dossier."\n log file = /var/log/samba/log.".$dossier."\n  max log size = 100\n  hide dot files = yes\n  guest ok = no\n guest only = no\n write list = @".$group."\n  read list = \n  valid users = @".$group."\n\"  >> /etc/samba/smb.conf
  done
  systemctl restart smbd
fi
      ";

      #RASSEMBLEMENT DES VARIABLES & CREATION DU SCRIPT-------------------------
      $new_script = $firstline . $username . $password . $script . $rm;
      $file = fopen($file_path, 'w+');
      fputs($file,$new_script);


  }
?>

</section>
</main>
