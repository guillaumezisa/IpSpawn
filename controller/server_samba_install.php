<main role="main"><center>
  <div class="container"><br>
  <h3><strong>Gestion du serveur samba</strong></h3>
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
      $path = $_GET['zone'];

      #GÉNÉRATION DU SCRIPT-----------------------------------------------------
      $firstline = "
#!/bin/bash
#-------------------------------------------------------------------------
#SCRIPT D'INSTALATION D'UN SERVEUR SAMBA
#V.1.3
#Le : 2018/12/06
#Script par Rodney Nguengue : nguengueogoula@intechinfo.fr
#Script par Robin Cuvillier : rcvuillier@intechinfo.fr
#-------------------------------------------------------------------------
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
  # Installation des paquets samba
  apt-get -y install samba
  apt-get -y install samba-common-bin
  cd /etc/samba
  cp /etc/samba/smb.conf /etc/samba/smb.conf.save
  grep -v -E \"^#|^;\" /etc/samba/smb.conf.save | grep . > /etc/samba/smb.conf
  systemctl restart smbd
  mkdir ".$path."
  mkdir ".$path."/commun
  chmod 755 ".$path."
  chmod 777 ".$path."/commun
  echo -e \"\n[commun]\n  comment = Dossier commun à tous\n path = ".$path."/commun\n log file = /var/log/samba/log.commun\n  max log size = 100\nbrowseable = yes\n  hide dot files = yes\n  read only = no\n  public = yes\n  writable = yes\n  create mode = 0775\n  printable = no\n\"  >> /etc/samba/smb.conf
  systemctl restart smbd
      ";

      if(isset($_GET['dossier']) && isset($_GET['group']) && isset($_GET['password'])){
        $nb = count($_GET['dossier']);

        #CONCATENATION DE TABLEAUX BASH---------------------------------------------
        for( $i=0 ;$i<$nb ;$i++){
          if ($i === 0 ){
            $dossiers = $_GET['dossier'][$i];
            $passwords = $_GET['password'][$i];
            $groups= $_GET['group'][$i];
          } else {
            $dossiers=$dossiers." ".$_GET['dossier'][$i];
            $passwords=$passwords." ".$_GET['password'][$i];
            $groups=$groups." ".$_GET['group'][$i];
          }
        }
      $dossiers="dossier=(".$dossiers.")\n";
      $groups="group=(".$groups.")\n";
      $passwords="password=(".$passwords.")\n";

      $password ='${password[$y]}';
      $group = '${group[$y]}';
      $dossier = '${dossier[$y]}';

  $script2="
  for ((y=0;y<".$nb.";y++))
  do
    cat /etc/group | awk -F\":\" '{print$1}' | grep -w ".$group."
    if [ $? == 0 ];
    then
      echo \"'".$group."' déjà existant.\"
    else
      groupadd ".$group."
    fi

    # Création du Répertoire partagé
    mkdir -p ".$path."/".$dossier."

    # Application des Droits au dossier
    chown -R root:".$group." ".$path."/".$dossier."
    chmod -R 770 ".$path."/".$dossier."
    echo -e \"[".$dossier."]\n  comment = Dossier du group ".$group."\n path = ".$path."/".$dossier."\n log file = /var/log/samba/log.".$dossier."\n  max log size = 100\n  hide dot files = yes\n  guest ok = no\n guest only = no\n write list = @".$group."\n  read list = \n  valid users = @".$group."\n\"  >> /etc/samba/smb.conf
  done
  systemctl restart samba
fi
";
      }
  #RASSEMBLEMENT DES VARIABLES & CREATION DU SCRIPT-------------------------

  if(isset($dossiers) || isset($groups) || isset($passwords)){
    $new_script = $firstline . $dossiers . $groups . $passwords . $script . $script2 . $rm;
  } else {
    $new_script = $firstline . $script . $rm;
  }

  $file = fopen($file_path, 'w+');
  fputs($file,$new_script);

  }
?>

</section>
</main>
