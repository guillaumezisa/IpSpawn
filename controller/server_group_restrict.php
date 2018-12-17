<main role="main"><center>
  <div class="container"><br>
  <h3><strong>Restriction de commande(s) a un groupe</strong></h3>
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
$file_path="../script/script_client/restrict_group".session_id().".sh";
$file_name="restrict_group.sh";

#VÉRIFICATION DE L'OPTION D'AUTO-DESTRUCTION------------------------------------
if (isset( $_GET["auto_destruction"] )){ $rm = "rm ".$file_name; } else { $rm = ""; }

#AJOUT DU LIEN DE TÉLÉCHARGEMENT & GUIDE----------------------------------------
echo "<center><a class='btn btn-dark' href='".$file_path."'download='".$file_name."' target='_blank'>Télécharger le script </a></center><br>";
include("../view/guide_execution.php");

#-------------------------------------------------------------------------------
# GÉNÉRATION DU SCRIPT
#-------------------------------------------------------------------------------
if(isset($_GET['action']) && isset($_GET['under_action'])){
  if(isset($_GET['group']) && isset($_GET['command']) && isset($_GET['password'])  && isset($_GET['executable'])){
    $nb = count($_GET['command']);
    $group="group=".$_GET['group']."\n";
    #CONCATENATION DE TABLEAUX BASH---------------------------------------------
    for( $i=0 ;$i<$nb ;$i++){
      if ($i === 0 ){
        $command="command[$i]=".$_GET['command'][$i]."\n";
        $password="password[$i]=".$_GET['password'][$i]."\n";
        $executable="execution[$i]=".$_GET['executable'][$i]."\n";
      } else {
        $command=$command."command[$i]=".$_GET['command'][$i]."\n";
        $password=$password."password[$i]=".$_GET['password'][$i]."\n";
        $executable="execution[$i]=".$_GET['executable'][$i]."\n";
      }
    }
    #CRÉATION DE VARIABLES IMPORTANTES POUR ISOLER PHP & BASH-------------------
    $com = '${com[$y]}';
    $pass = '${pass[$y]}';
    $exec = '${exec[$y]}';
    $whoiam = '"root"';

    #GÉNÉRATION DU SCRIPT-------------------------------------------------------
    $firstline = "#!/bin/bash
#-------------------------------------------------------------------------------
#SCRIPT DE GESTION DES COMMANDES D'UN GROUPES généré par IpSpawn.com
#V.1.0
#Le : 2018/12/16
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
#VARIABLES DE VERIFICATION
group_exist=\$(cat /etc/group | grep \$group\":\");
group_exist_sudoers=\$(cat /etc/sudoers | grep \"%\"\$group)

if [[ \$group_exist != \"\" ]];then
  if [[ \$group_exist_sudoers == \"\" ]];then
    for((i=0;i<4;i++));do
      command_exist=\$(which \${command[\$i]});

      #CRÉATION DES STRINGS DE CONFIGURATION
      if [[ \$command_exist != \"\" ]];then
        if [[ \${execution[\$i]} == \"yes\" ]];then
          #SI L'ÉXÉCUTION EST POSSIBLE ON PEUT ENLEVER LE MOT DE PASSE
          if [[ \${password[\$i]} == \"yes\" ]];then
            string[\$i]=\"\$command_exist\";
          else
            string[\$i]=\"NOPASSWD:\$command_exist\";
          fi
        else
          string[\$i]=\"!\$command_exist\";
        fi
      else
        echo \"La commande n'existe pas.\";
      fi
      echo \${string[\$i]};
    done

    #CONCATÉNATION DES STRINGS
    for (( i=0 ; i<4 ; i++ ));do
      if [ \$i -eq 0 ];then
        final_string=\"ALL,\"\${string[\$i]}
      else
        final_string=\$final_string\",\"\${string[\$i]}
      fi
    done

    #FORMATION DE LA LIGNE A AJOUTER DANS LE SUDOERS ET AJOUT
    final=\"%\$group  ALL=(ALL:ALL) \$final_string\";
    echo \$final >> /etc/sudoers

  else
    for((i=0;i<4;i++));do
      command_exist=\$(which \${command[\$i]});

      #CRÉATION DES STRINGS DE CONFIGURATION
      if [[ \$command_exist != \"\" ]];then
        if [[ \${execution[\$i]} == \"yes\" ]];then
          #SI L'ÉXÉCUTION EST POSSIBLE ON PEUT ENLEVER LE MOT DE PASSE
          if [[ \${password[\$i]} == \"yes\" ]];then
            string[\$i]=\",\$command_exist\";
          else
            string[\$i]=\"NOPASSWD:\$command_exist\";
          fi
        else
          string[\$i]=\"!\$command_exist\";
        fi
      else
        echo \"La commande n'existe pas.\";
      fi
    done

    #CONCATÉNATION DES STRINGS
    for (( i=0 ; i<4 ; i++ ));do
      if [ \$i -eq 0 ];then
        final_string=\$group_exist_sudoers\"\"\${string[\$i]}
      elif [ \$i -eq 3 ];then
        final_string=\$final_string\"\"\${string[\$i]}
      else
        final_string=\$final_string\",\"\${string[\$i]}
      fi
    done
    nb=\$(grep -n \"%\"\$group /etc/sudoers | cut -d\":\" -f1)
    sed \$nb\"d\" /etc/sudoers > tmp
    mv tmp /etc/sudoers
    echo \$final_string >> /etc/sudoers;
  fi
else
  echo \"Vous devez créer le groupe avant de lui donner les droits sudo.\";
fi
";

    #RASSEMBLEMENT DES VARIABLES & CREATION DU SCRIPT-------------------------
    $new_script = $firstline . $group . $executable . $password . $command . $script . $rm;
    $file = fopen($file_path, 'w+');
    fputs($file,$new_script);
  } else {
    echo "lol";
  }
} else {
  echo "lol2";
}

?>
    </div>
  </section>
</main>
